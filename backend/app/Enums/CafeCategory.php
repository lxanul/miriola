<?php

namespace App\Enums;

/**
 * Kategorie pozycji menu kawiarni.
 *
 * Lista jest sumą wartości używanych przez seeder (`kawy`, `ciasta`) i tych,
 * które oferował panel (`desery`, `przekaski`) — rozjazd sprawiał, że pozycji
 * z kategorią `ciasta` nie dało się zapisać. Patrz REVIEW.md H-11.
 */
enum CafeCategory: string
{
    case Kawy = 'kawy';
    case Ciasta = 'ciasta';
    case Desery = 'desery';
    case Przekaski = 'przekaski';

    public function label(): string
    {
        return match ($this) {
            self::Kawy => '☕ Kawy i Napoje Gorące',
            self::Ciasta => '🍰 Ciasta i Wypieki',
            self::Desery => '🍮 Desery',
            self::Przekaski => '🥨 Przekąski i Rzemiosło',
        };
    }

    /** @return array<string, string> wartość => etykieta dla pól Select */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
