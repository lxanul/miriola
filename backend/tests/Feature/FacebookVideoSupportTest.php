<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FacebookVideoSupportTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_with_facebook_video_renders_embed_on_article_page(): void
    {
        $article = News::create([
            'title' => 'Wielkie Otwarcie Sezonu - Relacja Wideo',
            'slug' => 'wielkie-otwarcie-sezonu-relacja-wideo',
            'branch' => 'resort',
            'content' => 'Zapraszamy do obejrzenia oficjalnej relacji wideo z otwarcia sezonu.',
            'media_type' => 'video',
            'video_url' => 'https://www.facebook.com/watch/?v=10153231379946729',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/aktualnosci/' . $article->slug);
        $response->assertStatus(200);
        $response->assertSee('facebook.com/plugins/video.php', false);
        $response->assertSee('Otwórz w aplikacji Facebook', false);
    }

    public function test_news_with_facebook_reel_renders_vertical_embed(): void
    {
        $article = News::create([
            'title' => 'Poranek nad Basenem - Rolka',
            'slug' => 'poranek-nad-basenem-rolka',
            'branch' => 'resort',
            'content' => 'Zobacz najnowszą rolkę z naszego ośrodka.',
            'media_type' => 'video',
            'video_url' => 'https://www.facebook.com/reel/1234567890123456',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/aktualnosci/' . $article->slug);
        $response->assertStatus(200);
        $response->assertSee('facebook.com/plugins/video.php', false);
        $response->assertSee('Otwórz w aplikacji Facebook', false);
    }

    public function test_news_with_long_facebook_url_saves_and_persists(): void
    {
        $longUrl = 'https://www.facebook.com/watch/?v=123456789&mibextid=' . str_repeat('a', 300);
        $article = News::create([
            'title' => 'Długi Link Facebook Wideo',
            'slug' => 'dlugi-link-facebook-wideo',
            'branch' => 'resort',
            'content' => 'Treść z długim linkiem do FB',
            'media_type' => 'video',
            'video_url' => $longUrl,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->assertDatabaseHas('news', [
            'id' => $article->id,
            'video_url' => $longUrl,
        ]);
    }

    public function test_aktualnosci_grid_passes_facebook_video_url(): void
    {
        $article = News::create([
            'title' => 'Wideo z Pikniku Rodzinnego',
            'slug' => 'wideo-z-pikniku-rodzinnego',
            'branch' => 'jarmark',
            'content' => 'Relacja z pikniku.',
            'media_type' => 'video',
            'video_url' => 'https://fb.watch/sampleVideo123/',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/aktualnosci');
        $response->assertStatus(200);
        $response->assertSee('fb.watch', false);
        $response->assertSee('sampleVideo123', false);
        $response->assertSee('Obejrzyj wideo', false);
    }
}
