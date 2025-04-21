<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Salary extends Model
{
    protected $guarded = ['created_at'];

    public function salaryDeduction(): MorphMany
    {
        return $this->morphMany(SalaryDeduction::class, 'salaryDeduction');
    }

    public function salaryBonus(): MorphMany
    {
        return $this->morphMany(SalaryBonus::class, 'salaryBonus');
    }
}
