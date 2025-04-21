<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocumentCategories extends Model
{
    protected $table = 'document_category';

    protected $guarded = ['id_category'];

    protected $primaryKey = 'id_category';

    // Fungsi membuat relasi tabel
    public function e_document_staff(): HasOne
    {
        return $this->hasOne(EDocumentStaff::class, 'id_category', 'id_category');
    }

    public function e_document_student(): HasOne
    {
        return $this->hasOne(EDocumentStudent::class, 'id_category', 'id_category');
    }
}
