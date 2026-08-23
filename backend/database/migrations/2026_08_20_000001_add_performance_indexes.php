<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Dodaje złożone indeksy DB dla poprawy wydajności zapytań:
     * 1. news(is_published, branch, published_at) — filtrowanie po dziale + data
     * 2. news(slug) już istnieje jako UNIQUE, ale dla pewności go pomijamy
     * 3. reservations(room_id, status, check_in_date, check_out_date) — overlapsExisting()
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Filtr dla stron: where(is_published, true)->where(branch, x)->latest(published_at)
            $table->index(['is_published', 'branch', 'published_at'], 'news_published_branch_date_idx');
        });

        Schema::table('reservations', function (Blueprint $table) {
            // overlapsExisting() query: room_id + status + date range overlap
            $table->index(['room_id', 'status', 'check_in_date', 'check_out_date'], 'reservations_availability_idx');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex('news_published_branch_date_idx');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex('reservations_availability_idx');
        });
    }
};
