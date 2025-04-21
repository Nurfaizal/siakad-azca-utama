<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guardian extends Model
{
    protected $table = 'guardian';

    protected $guarded = ['id_guardian'];

    protected $primaryKey = 'id_guardian';

    // Fungsi membuat inverse Relasi Tabel
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id_student', 'id_student');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
