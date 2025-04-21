<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneralSetting extends Model
{
    protected $table = 'general_setting';

    protected $guarded = ['id_general_setting'];

    protected $primaryKey = 'id_general_setting';

    // Fungsi membuat inverse relasi tabel
    public function school_year(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'id_year', 'id_year');
    }
}
