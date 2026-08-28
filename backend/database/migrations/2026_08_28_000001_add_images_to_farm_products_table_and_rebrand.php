<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('farm_products', 'images')) {
            Schema::table('farm_products', function (Blueprint $table) {
                $table->json('images')->nullable()->after('image');
            });
        }

        // Przeniesienie istniejących pojedynczych zdjęć do nowej kolumny images
        $products = DB::table('farm_products')->get();
        foreach ($products as $product) {
            $updates = [];

            if (! empty($product->image) && empty($product->images)) {
                $updates['images'] = json_encode([$product->image]);
            }

            if (str_contains($product->name, 'Ekologiczny')) {
                $updates['name'] = str_replace('Ekologiczny', 'Naturalny', $product->name);
            }

            if (! empty($updates)) {
                DB::table('farm_products')->where('id', $product->id)->update($updates);
            }
        }

        // Aktualizacja rekordów CMS pod kątem rebrandingu oraz Sanepidu
        DB::table('cms_contents')
            ->where('key', 'jarmark_hero_title')
            ->update(['value' => 'Jarmark & Kawiarnia Plenerowa']);

        DB::table('cms_contents')
            ->where('key', 'jarmark_hero_description')
            ->update(['value' => 'Wyjątkowe miejsce w Dolinie Skawy łączące plenerową kawiarnię, lokalne wypieki oraz klimatyczną strefę spotkań.']);

        DB::table('cms_contents')
            ->where('key', 'gospodarstwo_hero_description')
            ->update(['value' => 'Tradycyjna uprawa i naturalne plony w czystym mikroklimacie Doliny Skawy. Prosto z naszych pól i pasieki oferujemy 3 rodzaje naturalnego czosnku, świeże borówki, naturalne miody oraz domowe przetwory i nie tylko.']);
    }

    public function down(): void
    {
        if (Schema::hasColumn('farm_products', 'images')) {
            Schema::table('farm_products', function (Blueprint $table) {
                $table->dropColumn('images');
            });
        }
    }
};
