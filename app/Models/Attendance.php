<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attendance extends Model
{
    protected $guarded = ['created_at'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

    public function gpsLocation(): HasOne
    {
        return $this->hasOne(GpsLocation::class, 'id', 'id_gps_location');
    }
}
