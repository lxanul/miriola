<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Zastąp stary opis hero dla gospodarstwa w cms_contents
        DB::table('cms_contents')
            ->where('key', 'gospodarstwo_hero_description')
            ->update([
                'value' => 'Tradycyjne uprawy, 3 rodzaje czosnku, świeże borówki oraz naturalny miód prosto z naszego gospodarstwa w Dolinie Skawy.',
            ]);

        // 2. Wyczyść stare produkty rolne i wstaw aktualną ofertę klienta (Czosnek, Borówka, Miód) z lokalnymi plikami zdjęć
        DB::table('farm_products')->truncate();

        DB::table('farm_products')->insert([
            [
                'name' => 'Czosnek Ekologiczny (3 Rodzaje)',
                'description' => '',
                'unit_price' => 25.00,
                'unit_name' => 'kg / pęczek',
                'image' => 'assets/img/czosnek.webp',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Borówka Amerykańska',
                'description' => '',
                'unit_price' => 25.00,
                'unit_name' => 'kg',
                'image' => 'assets/img/borowka.webp',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Miód Naturalny z Pasieki MIRiOLA',
                'description' => '',
                'unit_price' => 45.00,
                'unit_name' => 'słoik 1kg',
                'image' => 'assets/img/miod.webp',
                'is_available' => true,
                'phone_contact' => '+48608103119',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void {}
};
