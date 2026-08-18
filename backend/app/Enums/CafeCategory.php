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
    case KawyNapoje = 'kawy_napoje';
    case Desery = 'desery';
    case Zapiekanki = 'zapiekanki';
    case Gofry = 'gofry';
    case Lody = 'lody';

    // Legacy fallbacks
    case Kawy = 'kawy';
    case Ciasta = 'ciasta';
    case Przekaski = 'przekaski';

    public function label(): string
    {
        return match ($this) {
            self::KawyNapoje, self::Kawy => '☕ Kawy i Napoje',
            self::Desery, self::Ciasta => '🍰 Desery',
            self::Zapiekanki, self::Przekaski => '🥖 Zapiekanki',
            self::Gofry => '🧇 Gofry',
            self::Lody => '🍦 Lody',
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
