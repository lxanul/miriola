<?php

namespace Tests\Feature;

use App\Models\FarmProduct;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RebrandingAndFarmGalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_farm_product_handles_multiple_images_and_urls(): void
    {
        $product = FarmProduct::create([
            'name' => 'Czosnek Naturalny',
            'description' => 'Testowy opis',
            'images' => [
                'farm-products/test1.webp',
                'https://images.unsplash.com/photo-test',
                'assets/img/czosnek.webp',
            ],
            'is_available' => true,
            'phone_contact' => '+48608103119',
            'sort_order' => 1,
        ]);

        $this->assertCount(3, $product->images_urls);
        $this->assertStringContainsString('storage/farm-products/test1.webp', $product->images_urls[0]);
        $this->assertEquals('https://images.unsplash.com/photo-test', $product->images_urls[1]);
        $this->assertStringContainsString('assets/img/czosnek.webp', $product->images_urls[2]);

        // getImageUrlAttribute should fallback to the first image in images array
        $this->assertStringContainsString('storage/farm-products/test1.webp', $product->image_url);
    }

    public function test_farm_product_gallery_renders_on_gospodarstwo_page(): void
    {
        FarmProduct::create([
            'name' => 'Borówka Amerykańska',
            'images' => [
                'assets/img/czosnek.webp',
                'assets/img/hero.webp',
            ],
            'is_available' => true,
            'phone_contact' => '+48608103119',
            'sort_order' => 1,
        ]);

        $response = $this->get('/gospodarstwo');
        $response->assertStatus(200);
        $response->assertSee('Borówka Amerykańska');
        $response->assertSee('product-lightbox-modal');
        $response->assertSee('openProductLightbox');
        $response->assertSee('slideProductCard');
        $response->assertDontSee('ekologicznego czosnku');
        $response->assertSee('naturalnego czosnku');
    }

    public function test_news_page_and_hub_render_gospodarstwo_rolne_category_badge(): void
    {
        News::create([
            'title' => 'Wpis testowy Gospodarstwa',
            'slug' => 'wpis-testowy-gospodarstwo',
            'branch' => 'farm',
            'excerpt' => 'Krótki opis',
            'content' => 'Treść aktualności gospodarstwa.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        // Sprawdzenie na podstronie aktualności
        $aktualnosciResponse = $this->get('/aktualnosci');
        $aktualnosciResponse->assertStatus(200);
        $aktualnosciResponse->assertSee('🌿 Gospodarstwo');

        // Sprawdzenie na stronie głównej (hub)
        $hubResponse = $this->get('/');
        $hubResponse->assertStatus(200);
        $hubResponse->assertSee('🌿 Gospodarstwo');
    }

    public function test_rebranding_kawiarnia_plenerowa_on_all_relevant_pages(): void
    {
        // Jarmark page
        $jarmarkResponse = $this->get('/jarmark');
        $jarmarkResponse->assertStatus(200);
        $jarmarkResponse->assertSee('Kawiarnia Plenerowa');
        $jarmarkResponse->assertDontSee('Kawiarnia Rzemieślnicza');

        // Hub page
        $hubResponse = $this->get('/');
        $hubResponse->assertStatus(200);
        $hubResponse->assertSee('Kawiarnia plenerowa');
        $hubResponse->assertDontSee('Kawiarnia Rzemieślnicza');

        // Privacy Policy page
        $policyResponse = $this->get('/polityka-prywatnosci');
        $policyResponse->assertStatus(200);
        $policyResponse->assertSee('Jarmark & Kawiarnia Plenerowa', false);
        $policyResponse->assertDontSee('Kawiarnia Rzemieślnicza');
    }
}
