<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Semester extends Model
{
    protected $table = 'semester';

    protected $guarded = ['id_semester'];

    protected $primaryKey = 'id_semester';

    // Fungsi membuat inverse relasi tabel
    public function semester_type(): BelongsTo
    {
        return $this->belongsTo(SemesterType::class, 'id_semester_type', 'id_semester_type');
    }
}
