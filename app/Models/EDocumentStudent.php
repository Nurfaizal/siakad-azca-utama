<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EDocumentStudent extends Model
{
    protected $table = 'e_document_student';

    protected $guarded = ['id_e_document_student'];

    protected $primaryKey = 'id_e_document_student';

    // Fungsi membuat inverse relasi tabel 
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id_student', 'id_student');
    }

    public function document_category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategories::class, 'id_category', 'id_category');
    }
}
