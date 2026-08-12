<?php

namespace App\Enums;

/**
 * Działy firmy. Kolumna `branch` występuje w tabelach news, faqs, attractions,
 * gallery_images i cms_contents — dotąd każdy zasób panelu miał własną,
 * rozjeżdżającą się listę opcji.
 */
enum Branch: string
{
    case Resort = 'resort';
    case Jarmark = 'jarmark';
    case Farm = 'farm';

    public function label(): string
    {
        return match ($this) {
            self::Resort => '🏡 Ośrodek Wypoczynkowy',
            self::Jarmark => '☕ Jarmark Centrum Edukacyjno-Handlowe',
            self::Farm => '🥒 Gospodarstwo Ogrodniczo-Pszczelarskie',
        };
    }

    /** Krótka etykieta do kolumn tabeli. */
    public function shortLabel(): string
    {
        return match ($this) {
            self::Resort => '🏡 Ośrodek',
            self::Jarmark => '☕ Jarmark',
            self::Farm => '🥒 Gospodarstwo',
        };
    }

    /**
     * @param  list<self>|null  $only  ogranicza listę (np. galeria nie ma działu farm)
     * @return array<string, string>
     */
    public static function options(?array $only = null): array
    {
        $options = [];

        foreach ($only ?? self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
