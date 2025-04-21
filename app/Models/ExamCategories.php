<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ExamCategories extends Model
{
    protected $table = 'exam_categories';

    protected $guarded = ['id_exam_category'];

    protected $primaryKey = 'id_exam_category';

    // Fungsi membuat relasi tabel
    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class, 'id_exam_category', 'id_exam_category');
    }
}
