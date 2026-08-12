<?php

namespace App\Enums;

/**
 * Jedyne źródło prawdy dla kategorii obiektów noclegowych.
 *
 * Wartości muszą odpowiadać temu, co leży w kolumnie `rooms.room_type` —
 * wcześniej panel oferował trzy kategorie, a seeder zapisywał siedem innych,
 * przez co 9 z 10 pokoi otwierało się w panelu z pustym wymaganym polem
 * i nie dawało się zapisać. Patrz REVIEW.md H-11.
 *
 * Kolumna celowo zostaje typu string (nie rzutujemy na enum), bo widoki
 * wypisują `{{ $room->room_type }}` wprost.
 */
enum RoomType: string
{
    case Pokoj5Osobowy = 'Pokój 5-osobowy';
    case Pokoj6Osobowy = 'Pokój 6-osobowy';
    case Apartament2Pokojowy = 'Apartament 2-pokojowy';
    case Apartament2Poziomowy = 'Apartament 2-poziomowy';
    case DomekLetniskowy = 'Domek Letniskowy';
    case Domek2Pokojowy = 'Domek 2-pokojowy';
    case DomekZAneksem = 'Domek z aneksem';

    /** @return array<string, string> wartość => etykieta dla pól Select */
    public static function options(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_column(self::cases(), 'value'),
        );
    }

    /** Kolor plakietki w tabeli panelu. */
    public function color(): string
    {
        return match ($this) {
            self::Pokoj5Osobowy, self::Pokoj6Osobowy => 'info',
            self::Apartament2Pokojowy, self::Apartament2Poziomowy => 'warning',
            default => 'success',
        };
    }
}
