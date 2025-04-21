<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $guarded = ['id_class'];

    protected $primaryKey = 'id_class';


    // Fungsi membuat relasi tabel
    public function student_note(): HasOne
    {
        return $this->hasOne(StudentNote::class, 'id_class', 'id_class');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'id_class', 'id_class');
    }

    // Fungsi membuat inverse relasi tabel
    public function skill(): BelongsTo
    {
        return $this->belongsTo(SkillProgram::class, 'id_skill', 'id_skill');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'id_year', 'id_year');
    }
}
