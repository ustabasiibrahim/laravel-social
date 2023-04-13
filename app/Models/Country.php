<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
