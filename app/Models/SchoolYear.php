<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolYear extends Model
{
    protected $table = 'school_year';

    protected $guarded = ['id_year'];

    protected $primaryKey = 'id_year';

    // Fungsi membuat relasi tabel
    public function classes(): HasOne
    {
        return $this->hasOne(Classes::class, 'id_year', 'id_year');
    }

    public function general(): HasOne
    {
        return $this->hasOne(GeneralSetting::class, 'id_year', 'id_year');
    }
}
