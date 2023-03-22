<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFollow\Traits\Followable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Channel extends Model
{
    use HasFactory, SoftDeletes, HasSlug, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_private',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'is_private' => 'boolean',
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
}
