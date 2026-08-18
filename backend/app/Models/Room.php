<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'room_type',
        'capacity',
        'price_per_night',
        'price_unit',
        'description',
        'image',
        'images',
        'amenities',
        'sort_order',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'capacity' => 'integer',
        'sort_order' => 'integer',
        'images' => 'array',
        'amenities' => 'array',
    ];

    protected $appends = [
        'is_currently_occupied',
        'is_available_now',
        'booked_ranges',
    ];

    /**
     * Widok /osrodek serializuje kolekcję pokoi przez @json($rooms). Bez tego
     * dołączona relacja wysłałaby na publiczną stronę nazwiska, telefony
     * i adresy e-mail gości.
     */
    protected $hidden = ['reservations'];

    /**
     * @return HasMany<Reservation, $this>
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Akcesory czytają z ZAŁADOWANEJ relacji, nie odpalają własnych zapytań.
     * Przy `Room::with('reservations')` cała lista pokoi kosztuje 2 zapytania
     * zamiast ~30. Patrz REVIEW.md H-14.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Reservation>
     */
    protected function confirmedReservations()
    {
        return $this->reservations->where('status', 'confirmed');
    }

    public function getIsCurrentlyOccupiedAttribute(): bool
    {
        $today = now()->startOfDay();

        return $this->confirmedReservations()->contains(
            fn (Reservation $r) => $r->check_in_date <= $today && $r->check_out_date >= $today
        );
    }

    public function getIsAvailableNowAttribute(): bool
    {
        return ! $this->is_currently_occupied;
    }

    public function getBookedRangesAttribute(): array
    {
        return $this->confirmedReservations()
            ->map(fn (Reservation $r) => [
                'from' => $r->check_in_date->format('Y-m-d'),
                'to' => $r->check_out_date->format('Y-m-d'),
            ])
            ->values()
            ->toArray();
    }
}
