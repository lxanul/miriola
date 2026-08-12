<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

/**
 * Logika rezerwacji to sedno systemu, a miała zerowe pokrycie testami.
 * Reguły są pilnowane w modelu (Reservation::booted), więc obowiązują
 * tak samo dla panelu, seedera i tinkera.
 */
class ReservationTest extends TestCase
{
    use RefreshDatabase;

    private function room(string $name = 'Pokój testowy'): Room
    {
        return Room::create([
            'name' => $name,
            'room_type' => 'Pokój 5-osobowy',
            'capacity' => 5,
            'price_per_night' => 250,
            'sort_order' => 1,
        ]);
    }

    private function reserve(Room $room, string $from, string $to, string $status = 'confirmed'): Reservation
    {
        return Reservation::create([
            'room_id' => $room->id,
            'guest_name' => 'Jan Testowy',
            'guest_phone' => '600 100 200',
            'check_in_date' => $from,
            'check_out_date' => $to,
            'status' => $status,
        ]);
    }

    public function test_data_wyjazdu_musi_byc_pozniejsza_niz_przyjazdu(): void
    {
        $room = $this->room();

        $this->expectException(ValidationException::class);
        $this->reserve($room, '2026-09-10', '2026-09-08');
    }

    public function test_pobyt_zerodniowy_jest_odrzucany(): void
    {
        $room = $this->room();

        $this->expectException(ValidationException::class);
        $this->reserve($room, '2026-09-10', '2026-09-10');
    }

    public function test_nachodzace_terminy_w_tym_samym_pokoju_sa_odrzucane(): void
    {
        $room = $this->room();
        $this->reserve($room, '2026-09-01', '2026-09-08');

        $this->expectException(ValidationException::class);
        $this->reserve($room, '2026-09-05', '2026-09-12');
    }

    public function test_doba_wyjazdu_moze_byc_doba_przyjazdu_kolejnego_goscia(): void
    {
        $room = $this->room();
        $this->reserve($room, '2026-09-01', '2026-09-08');

        $next = $this->reserve($room, '2026-09-08', '2026-09-12');

        $this->assertTrue($next->exists);
    }

    public function test_ten_sam_termin_w_innym_pokoju_jest_dozwolony(): void
    {
        $first = $this->room('Pokój A');
        $second = $this->room('Pokój B');
        $this->reserve($first, '2026-09-01', '2026-09-08');

        $this->assertTrue($this->reserve($second, '2026-09-01', '2026-09-08')->exists);
    }

    public function test_anulowana_rezerwacja_nie_blokuje_terminu(): void
    {
        $room = $this->room();
        $this->reserve($room, '2026-09-01', '2026-09-08', 'cancelled');

        $this->assertTrue($this->reserve($room, '2026-09-01', '2026-09-08')->exists);
    }

    public function test_edycja_wlasnej_rezerwacji_nie_koliduje_sama_ze_soba(): void
    {
        $room = $this->room();
        $reservation = $this->reserve($room, '2026-09-01', '2026-09-08');

        $reservation->update(['guest_name' => 'Anna Testowa']);

        $this->assertSame('Anna Testowa', $reservation->fresh()->guest_name);
    }

    public function test_booked_ranges_zwraca_tylko_potwierdzone_terminy(): void
    {
        $room = $this->room();
        $this->reserve($room, '2026-09-01', '2026-09-08');
        $this->reserve($room, '2026-10-01', '2026-10-05', 'cancelled');

        $ranges = $room->fresh()->booked_ranges;

        $this->assertCount(1, $ranges);
        $this->assertSame(['from' => '2026-09-01', 'to' => '2026-09-08'], $ranges[0]);
    }

    public function test_is_available_now_odzwierciedla_trwajacy_pobyt(): void
    {
        $room = $this->room();
        $this->reserve($room, now()->subDay()->toDateString(), now()->addDay()->toDateString());

        $this->assertFalse($room->fresh()->is_available_now);
    }
}
