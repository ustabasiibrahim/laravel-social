<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\Favorite\Favoriteable;

class Post extends Model
{
    use Favoriteable, SoftDeletes, HasSlug, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'user_id',
        'channel_id',
        'title',
        'slug',
        'content',
        'is_nsfw',
        'is_spoiler',
        'is_locked',
        'is_pinned',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'is_nsfw' => 'boolean',
        'is_spoiler' => 'boolean',
        'is_locked' => 'boolean',
        'is_pinned' => 'boolean',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the most popular posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular(Builder $query): Builder
    {
        return $query->orderBy(function($query) {
            return $query->from('favorites')->whereColumn('favoriteable_id', 'posts.id')->selectRaw('count(*)');
        }, 'desc')
            ->orderBy('updated_at', 'desc');
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}
