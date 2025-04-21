<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubjectContent extends Model
{
    protected $table = 'subject_content';

    protected $guarded = ['id_subcontent'];

    protected $primaryKey = 'id_subcontent';

    // Fungsi Membuat Relasi
    public function subject(): HasOne
    {
        return $this->hasOne(Subject::class, 'id_subject', 'id_subject');
    }
}
