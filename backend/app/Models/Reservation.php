<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class Reservation extends Model
{
    protected $fillable = [
        'room_id',
        'guest_name',
        'guest_phone',
        'guest_email',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Reguły terminów pilnujemy w modelu, a nie w formularzu panelu, bo zapis
     * idzie też z seedera i z tinkera. Jedno miejsce obsługuje wszystkie drogi.
     */
    protected static function booted(): void
    {
        static::saving(function (self $reservation): void {
            if ($reservation->check_out_date <= $reservation->check_in_date) {
                throw ValidationException::withMessages([
                    'check_out_date' => 'Data wyjazdu musi być późniejsza niż data przyjazdu.',
                ]);
            }

            if ($reservation->status !== 'cancelled' && $reservation->overlapsExisting()) {
                throw ValidationException::withMessages([
                    'check_in_date' => 'Ten obiekt jest już zarezerwowany w wybranym terminie.',
                ]);
            }
        });
    }

    /**
     * Doba wyjazdu jest jednocześnie dobą przyjazdu kolejnego gościa, dlatego
     * porównania są ostre (<, >), a nie <=/>=.
     */
    public function overlapsExisting(): bool
    {
        return static::query()
            ->where('room_id', $this->room_id)
            ->whereKeyNot($this->getKey() ?? 0)
            ->where('status', '!=', 'cancelled')
            ->whereDate('check_in_date', '<', $this->check_out_date)
            ->whereDate('check_out_date', '>', $this->check_in_date)
            ->exists();
    }
}
