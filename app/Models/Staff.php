<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    use HasFactory;


    protected $table = 'staff';

    protected $guarded = ['id_staff'];

    protected $primaryKey = 'id_staff';


    // Fungsi Membuat Relasi Tabel
    public function personal_entry_hour(): HasOne
    {
        return $this->hasOne(PersonalEntryHour::class, 'id_staff', 'id_staff');
    }

    public function classes(): HasOne
    {
        return $this->hasOne(Classes::class, 'id_staff', 'id_staff');
    }

    public function staff_note(): HasOne
    {
        return $this->hasOne(StaffNote::class, 'id_staff', 'id_staff');
    }

    public function e_document_staff(): HasOne
    {
        return $this->hasOne(EDocumentStaff::class, 'id_staff', 'id_staff');
    }

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class, 'id_staff', 'id_staff');
    }

    // Fungsi Untuk Inverse Relasi Database
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(StaffDivision::class, 'id_division', 'id_division');
    }

    public function salaries(): HasOne
    {
        return $this->hasOne(Salary::class, 'staff_id', 'id_staff');
    }
}
