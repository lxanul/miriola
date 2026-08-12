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
        'is_available',
        'description',
        'image',
        'images',
        'amenities',
        'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
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

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getIsCurrentlyOccupiedAttribute(): bool
    {
        $today = now()->format('Y-m-d');
        return $this->reservations()
            ->where('status', 'confirmed')
            ->whereDate('check_in_date', '<=', $today)
            ->whereDate('check_out_date', '>=', $today)
            ->exists();
    }

    public function getIsAvailableNowAttribute(): bool
    {
        return !$this->is_currently_occupied;
    }

    public function getBookedRangesAttribute(): array
    {
        return $this->reservations()
            ->where('status', 'confirmed')
            ->get(['check_in_date', 'check_out_date'])
            ->map(fn ($r) => [
                'from' => $r->check_in_date->format('Y-m-d'),
                'to' => $r->check_out_date->format('Y-m-d'),
            ])
            ->toArray();
    }
}
