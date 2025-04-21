<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    protected $table = 'room';

    protected $guarded = ['id_room'];

    protected $primaryKey = 'id_room';

    // Fungsi membuat relasi tabel
    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class, 'id_room', 'id_room');
    }
}
