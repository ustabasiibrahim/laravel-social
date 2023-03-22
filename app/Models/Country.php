<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $iso_code
 * @property string $name
 * @property bool $published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Country withoutTrashed()
 * @mixin \Eloquent
 */
class Country extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'iso_code',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    // relations
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
