<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // Bez RefreshDatabase test uderzał w niezmigrowaną bazę i zwracał 500 —
    // jedyny test funkcjonalny w projekcie był niesprawny. REVIEW.md H-15.
    use RefreshDatabase;

    /**
     * @return list<array{string}>
     */
    public static function publicRoutes(): array
    {
        return [
            ['/'],
            ['/osrodek'],
            ['/jarmark'],
            ['/gospodarstwo'],
            ['/aktualnosci'],
            ['/polityka-prywatnosci'],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('publicRoutes')]
    public function test_publiczne_trasy_odpowiadaja_poprawnie(string $uri): void
    {
        $this->get($uri)->assertStatus(200);
    }

    public function test_panel_admina_wymaga_zalogowania(): void
    {
        $this->get('/admin')->assertRedirect();
    }
}
