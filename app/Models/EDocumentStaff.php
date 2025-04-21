<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EDocumentStaff extends Model
{
    protected $table = 'e_document_staff';

    protected $guarded = ['id_e_document_staff'];

    protected $primaryKey = 'id_e_document_staff';

    // Fungsi membuat inverse relasi tabel
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

    public function document_category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategories::class, 'id_category', 'id_category');
    }
}
