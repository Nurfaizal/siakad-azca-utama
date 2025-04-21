<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{

    protected $guarded = ['id_exam'];

    protected $primaryKey = 'id_exam';

    // Fungsi membuat inverse relasi tabel
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'id_subject', 'id_subject');
    }

    public function exam_category(): BelongsTo
    {
        return $this->belongsTo(ExamCategories::class, 'id_exam_category', 'id_exam_category');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'id_room', 'id_room');
    }
}
