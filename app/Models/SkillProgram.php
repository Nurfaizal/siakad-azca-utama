<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SkillProgram extends Model
{
    protected $table = 'skill_program';

    protected $guarded = ['id_skill'];

    protected $primaryKey = 'id_skill';

    // Fungsi membuat relasi tabel
    public function classes(): HasOne
    {
        return $this->hasOne(Classes::class, 'id_skill', 'id_skill');
    }
}
