<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttendanceStudent extends Model
{
    protected $primaryKey = "id_attendance_student";
    //
    protected $guarded = ['created_at'];


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id_student', 'id_student');
    }

    public function schedule(): HasOne
    {
        return $this->hasOne(ScheduleSubject::class, 'id_schedule', 'id_schedule');
    }

    public function attendence_details(): HasMany
    {
        return $this->hasMany(AttendanceStudentDetail::class, 'id_attendance_student', 'id_attendance_student');
    }
}
