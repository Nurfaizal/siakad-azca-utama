<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SemesterType extends Model
{
    protected $table = 'semester_type';

    protected $guarded = ['id_semester_type'];

    protected $primaryKey = 'id_semester_type';

    // Fungsi membuat relasi tabel
    public function semester(): HasOne
    {
        return $this->hasOne(Semester::class, 'id_semester_type', 'id_semester_type');
    }
}
