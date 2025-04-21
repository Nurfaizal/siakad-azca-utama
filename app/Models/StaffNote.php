<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffNote extends Model
{
    protected $table = 'staff_note';

    protected $guarded = ['id_staff_note'];

    protected $primaryKey = 'id_staff_note';

    // Fungsi membuat inverse relasi tabel
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }
}
