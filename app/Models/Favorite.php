<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property \Illuminate\Database\Eloquent\Model $user
 * @property \Illuminate\Database\Eloquent\Model $favoriter
 * @property \Illuminate\Database\Eloquent\Model $favoriteable
 */
class Favorite extends Model
{
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        $this->table = 'favorites';

        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($favorite) {
            $userForeignKey = 'user_id';
            $favorite->{$userForeignKey} = $favorite->{$userForeignKey} ?: auth()->id();
        });
    }

    public function favoriteable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favoriter(): BelongsTo
    {
        return $this->user();
    }

    public function scopeWithType(Builder $query, string $type): Builder
    {
        return $query->where('favoriteable_type', app($type)->getMorphClass());
    }
}
