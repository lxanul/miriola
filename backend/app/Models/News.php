<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'branch',
        'excerpt',
        'content',
        'image',
        'media_type',
        'video_url',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (News $news) {
            if (! empty($news->content)) {
                $news->excerpt = \Illuminate\Support\Str::limit(strip_tags($news->content), 160);
            } else {
                $news->excerpt = null;
            }
        });
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $clean = ltrim(preg_replace('#^/?storage/#', '', $this->image), '/');
        return '/storage/' . $clean;
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (! empty($this->image)) {
            return $this->image_url;
        }

        if (! empty($this->video_url)) {
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/', $this->video_url, $matches)) {
                return 'https://img.youtube.com/vi/'.$matches[1].'/hqdefault.jpg';
            }
        }

        return match ($this->branch) {
            'jarmark' => asset('assets/img/jarmark-hero.webp'),
            'farm' => asset('assets/img/gospodarstwo-hero.webp'),
            default => asset('assets/img/hero.webp'),
        };
    }
}
