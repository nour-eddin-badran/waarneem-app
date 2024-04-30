<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class Company extends Model
{
    protected $fillable = [
        'external_id', 'name', 'started_at'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getYearsExistenceAttribute(): int
    {
        return Carbon::createFromDate($this->started_at)->age;
    }
}
