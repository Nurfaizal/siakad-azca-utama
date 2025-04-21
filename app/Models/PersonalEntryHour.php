<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalEntryHour extends Model
{
    protected $table = 'personal_entry_hour';

    protected $guarded = ['id_personal'];

    protected $primaryKey = 'id_personal';


    // Fungsi Inverse Relasi Tabel
    public function division(): BelongsTo
    {
        return $this->belongsTo(StaffDivision::class, 'id_division', 'id_division');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }
}
