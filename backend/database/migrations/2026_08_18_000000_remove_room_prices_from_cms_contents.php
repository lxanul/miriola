<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('cms_contents')
            ->where('key', 'like', 'room%_price')
            ->delete();
    }

    public function down(): void
    {
        // Brak akcji wycofania: właściwe ceny znajdują się w tabeli rooms.price_per_night
    }
};
