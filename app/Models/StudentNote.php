<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentNote extends Model
{
    protected $table = 'student_note';

    protected $guarded = ['id_student_note'];

    protected $primaryKey = 'id_student_note';

    // Fungsi membuat inverse relasi tabel
    public function classes(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'id_class', 'id_class');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id_student', 'id_student');
    }
}
