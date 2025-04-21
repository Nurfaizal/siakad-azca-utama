<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $guarded = ['id_student'];

    protected $primaryKey = 'id_student';

    // Fungsi membuat Relasi Tabel
    public function religion(): HasOne
    {
        return $this->hasOne(Religion::class, 'id_religion', 'id_religion');
    }

    public function classes(): HasOne
    {
        return $this->hasOne(Classes::class, 'id_class', 'id_class');
    }

    public function student_note(): HasOne
    {
        return $this->hasOne(StudentNote::class, 'id_student', 'id_student');
    }

    public function e_document_student(): HasOne
    {
        return $this->hasOne(EDocumentStudent::class, 'id_student', 'id_student');
    }

    // Fungsi membuat inverse Relasi Tabel
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Parents::class, 'id_student', 'id_student');
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class, 'id_student', 'id_student');
    }
}
