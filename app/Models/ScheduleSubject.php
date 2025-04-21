<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScheduleSubject extends Model
{
    protected $primaryKey = 'id_schedule';
    protected $guarded = ['id_schedule', 'created_at'];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'id_class', 'id_class');
    }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'id_subject', 'id_subject');
    }

    public function attendance_students(): HasMany
    {
        return $this->hasMany(AttendanceStudent::class, 'id_schedule', 'id_schedule');
    }
}
