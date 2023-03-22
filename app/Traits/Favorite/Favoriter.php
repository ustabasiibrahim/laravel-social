<?php

namespace App\Traits\Favorite;

use App\Models\Favorite;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

/**
 * @property \Illuminate\Database\Eloquent\Collection $favorites
 */
trait Favoriter
{
    public function favorite(Model $object): void
    {
        /* @var Favoriteable|Model $object */
        if (! $this->hasFavorited($object)) {
            $favorite = app(Favorite::class);
            $favorite->{'user_id'} = $this->getKey();

            $object->favorites()->save($favorite);
        }
    }

    public function unfavorite(Model $object): void
    {
        /* @var Favoriteable $object */
        $relation = $object->favorites()
            ->where('favoriteable_id', $object->getKey())
            ->where('favoriteable_type', $object->getMorphClass())
            ->where(config('favorite.user_foreign_key'), $this->getKey())
            ->first();

        $relation?->delete();
    }

    public function toggleFavorite(Model $object): void
    {
        $this->hasFavorited($object) ? $this->unfavorite($object) : $this->favorite($object);
    }

    public function hasFavorited(Model $object): bool
    {
        return ($this->relationLoaded('favorites') ? $this->favorites : $this->favorites())
                ->where('favoriteable_id', $object->getKey())
                ->where('favoriteable_type', $object->getMorphClass())
                ->count() > 0;
    }

    public function favorites(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Favorite::class, 'user_id', $this->getKeyName());
    }

    public function attachFavoriteStatus(&$favoriteables, callable $resolver = null)
    {
        $favorites = $this->favorites()->get()->keyBy(function ($item) {
            return \sprintf('%s-%s', $item->favoriteable_type, $item->favoriteable_id);
        });

        $attachStatus = function ($favoriteable) use ($favorites, $resolver) {
            $resolver = $resolver ?? fn ($m) => $m;
            $favoriteable = $resolver($favoriteable);

            if (\in_array(Favoriteable::class, \class_uses($favoriteable))) {
                $key = \sprintf('%s-%s', $favoriteable->getMorphClass(), $favoriteable->getKey());
                $favoriteable->setAttribute('has_favorited', $favorites->has($key));
            }

            return $favoriteable;
        };

        switch (true) {
            case $favoriteables instanceof Model:
                return $attachStatus($favoriteables);
            case $favoriteables instanceof Collection:
                return $favoriteables->each($attachStatus);
            case $favoriteables instanceof LazyCollection:
                return $favoriteables = $favoriteables->map($attachStatus);
            case $favoriteables instanceof AbstractPaginator:
            case $favoriteables instanceof AbstractCursorPaginator:
                return $favoriteables->through($attachStatus);
            case $favoriteables instanceof Paginator:
                // custom paginator will return a collection
                return collect($favoriteables->items())->transform($attachStatus);
            case \is_array($favoriteables):
                return \collect($favoriteables)->transform($attachStatus);
            default:
                throw new \InvalidArgumentException('Invalid argument type.');
        }
    }

    public function getFavoriteItems(string $model)
    {
        return app($model)->whereHas(
            'favoriters',
            function ($q) {
                return $q->where('user_id', $this->getKey());
            }
        );
    }
}
