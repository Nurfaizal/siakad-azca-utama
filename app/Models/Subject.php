<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subject extends Model
{
    protected $table = 'subject';

    protected $guarded = ['id_subject'];

    protected $primaryKey = 'id_subject';

    // Fungsi membuat relasi tabel
    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class, 'id_subject', 'id_subject');
    }

    // Fungsi membuat inverse relasi
    public function subject_content(): BelongsTo
    {
        return $this->belongsTo(SubjectContent::class, 'id_subcontent', 'id_subcontent');
    }
}
