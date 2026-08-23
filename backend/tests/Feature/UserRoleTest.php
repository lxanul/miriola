<?php

namespace Tests\Feature;

use App\Filament\Resources\NewsResource;
use App\Filament\Resources\ReservationResource;
use App\Filament\Resources\RoomResource;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_has_admin_role(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'role' => 'admin',
        ]);

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isNewsEditor());
    }

    public function test_news_editor_has_editor_role(): void
    {
        $editor = User::factory()->create([
            'is_admin' => true,
            'role' => 'news_editor',
        ]);

        $this->assertFalse($editor->isAdmin());
        $this->assertTrue($editor->isNewsEditor());
    }

    public function test_news_editor_can_view_news_resource_only(): void
    {
        $editor = User::factory()->create([
            'is_admin' => true,
            'role' => 'news_editor',
        ]);

        $this->actingAs($editor);

        $this->assertTrue(NewsResource::canViewAny());
        $this->assertFalse(UserResource::canViewAny());
        $this->assertFalse(RoomResource::canViewAny());
        $this->assertFalse(ReservationResource::canViewAny());
    }

    public function test_admin_can_view_all_resources(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $this->assertTrue(NewsResource::canViewAny());
        $this->assertTrue(UserResource::canViewAny());
        $this->assertTrue(RoomResource::canViewAny());
        $this->assertTrue(ReservationResource::canViewAny());
    }
}
