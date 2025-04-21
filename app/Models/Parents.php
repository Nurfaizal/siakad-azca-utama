<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parents extends Model
{
    protected $table = 'parent';

    protected $guarded = ['id_parent'];

    protected $primaryKey = 'id_parent';

    // Fungsi membuat inverse Relasi Tabel
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id_student', 'id_student');
    }
}
