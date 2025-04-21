<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GpsLocation extends Model
{
    protected $guarded = ["created_at"];

    public function days(): HasMany
    {
        return $this->hasMany(GpsLocationDay::class);
    }
}
