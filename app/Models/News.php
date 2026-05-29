<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'category', 'title', 'slug', 'description',
        'image_path', 'published_at', 'link', 'sort_order',
    ];

    /**
     * Auto-generate a unique slug whenever the title is set.
     */
    public static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;
        while (self::where('slug', $slug)->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    /**
     * Route-model binding via slug.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
