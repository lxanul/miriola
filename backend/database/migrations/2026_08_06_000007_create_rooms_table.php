<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room_type'); // Pokój 2-osobowy, Apartament Rodzinny, Domek Letniskowy
            $table->integer('capacity')->default(2);
            $table->decimal('price_per_night', 8, 2)->default(250.00);
            $table->string('price_unit')->default('zł / noc');
            $table->boolean('is_available')->default(true); // Wolny vs Zarezerwowany
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
