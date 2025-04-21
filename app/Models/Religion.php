<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table = 'religion';

    protected $guarded = ['id_religion'];

    protected $primaryKey = 'id_religion';
}
