<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuesGroup extends Model
{
    protected $table = 'dues_group';

    protected $guarded = ['id_dues_group'];

    protected $primaryKey = 'id_dues_group';
}
