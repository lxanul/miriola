<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * `rooms.is_available` był drugim źródłem prawdy obok akcesora
 * `is_available_now`, który liczy zajętość z potwierdzonych rezerwacji.
 * Kolumna nie była używana w żadnym widoku ani w panelu. REVIEW.md H-19.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('is_available');
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->boolean('is_available')->default(true);
        });
    }
};
