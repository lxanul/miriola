<?php

namespace Tests\Feature;

use App\Models\CafeMenuItem;
use App\Models\CmsContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CafeHoursAndFeaturedBadgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_jarmark_displays_dzisiaj_polecamy_badge(): void
    {
        CafeMenuItem::create([
            'name' => 'Kawa Cappuccino Specjalne',
            'category' => 'kawy_napoje',
            'is_available' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        CafeMenuItem::create([
            'name' => 'Zwykła Herbata',
            'category' => 'kawy_napoje',
            'is_available' => true,
            'is_featured' => false,
            'sort_order' => 2,
        ]);

        $response = $this->get('/jarmark');

        $response->assertStatus(200);
        $response->assertSee('Dzisiaj polecamy');
        $response->assertDontSee('>Hit<');
    }

    public function test_jarmark_hides_dzisiaj_otwieramy_when_disabled(): void
    {
        CmsContent::create([
            'key' => 'cafe_open_today',
            'label' => 'Kawiarnia - Dzisiaj otwieramy',
            'value' => '0',
            'type' => 'text',
            'group' => 'jarmark',
        ]);

        $response = $this->get('/jarmark');

        $response->assertStatus(200);
        $response->assertDontSee('Dzisiaj Otwieramy!');
    }

    public function test_jarmark_shows_dzisiaj_otwieramy_when_enabled(): void
    {
        CmsContent::create([
            'key' => 'cafe_open_today',
            'label' => 'Kawiarnia - Dzisiaj otwieramy',
            'value' => '1',
            'type' => 'text',
            'group' => 'jarmark',
        ]);

        CmsContent::create([
            'key' => 'cafe_today_hours',
            'label' => 'Godziny na dziś',
            'value' => '14:00 – 21:00',
            'type' => 'text',
            'group' => 'jarmark',
        ]);

        CmsContent::create([
            'key' => 'cafe_today_notice',
            'label' => 'Komunikat na dziś',
            'value' => 'Świeże ciasto jagodowe prosto z pieca!',
            'type' => 'text',
            'group' => 'jarmark',
        ]);

        $response = $this->get('/jarmark');

        $response->assertStatus(200);
        $response->assertSee('Dzisiaj Otwieramy!');
        $response->assertSee('14:00 – 21:00');
        $response->assertSee('Świeże ciasto jagodowe prosto z pieca!');
    }

    public function test_jarmark_displays_weekly_schedule_from_monday_to_sunday(): void
    {
        CmsContent::create([
            'key' => 'cafe_hours_mon',
            'label' => 'Poniedziałek',
            'value' => 'Zamknięte',
            'type' => 'text',
            'group' => 'jarmark',
        ]);

        CmsContent::create([
            'key' => 'cafe_hours_sun',
            'label' => 'Niedziela',
            'value' => '11:00 – 21:00',
            'type' => 'text',
            'group' => 'jarmark',
        ]);

        $response = $this->get('/jarmark');

        $response->assertStatus(200);
        $response->assertSee('Harmonogram tygodniowy (Poniedziałek – Niedziela)');
        $response->assertSee('Pon');
        $response->assertSee('Niedz');
        $response->assertSee('Zamknięte');
        $response->assertSee('11:00 – 21:00');
    }
}
