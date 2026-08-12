<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farm_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('unit_price', 8, 2)->nullable();
            $table->string('unit_name')->default('kg'); // kg, słoik, szt, litr
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('phone_contact')->default('+48608103119');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farm_products');
    }
};
