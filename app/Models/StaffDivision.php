<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffDivision extends Model
{
    protected $table = 'staff_division';

    protected $guarded = ['id_division'];

    protected $primaryKey = 'id_division';


    // Fungsi membuat relasi tabel
    public function personal_entry_hour(): HasOne
    {
        return $this->hasOne(PersonalEntryHour::class, 'id_division', 'id_division');
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'id_division', 'id_division');
    }
}
