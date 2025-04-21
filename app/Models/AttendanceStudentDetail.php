<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttendanceStudentDetail extends Model
{
    protected $guarded = ['created_at'];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id_student', 'id_student');
    }
}
