<?php

namespace App\Livewire;

use App\Models\SchoolYear;
use App\Models\SkillProgram;
use App\Models\Staff;
use Livewire\Component;
use Livewire\Attributes\On;


class AddClass extends Component
{
    public $skill = [];
    public $staff = [];
    public $year = [];

    public function mount()
    {
        $role = null;
        $this->skill = SkillProgram::where('status', 'Aktif')->get();
        $this->staff = Staff::whereHas('user.levels', function ($query) use ($role) {
            $query->where('level', $role);
        })->whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->get();
        $this->year = SchoolYear::where('status', 'Aktif')->get();
    }

    public function render()
    {
        return view('livewire.add-class');
    }

    // tingkat
    #[On('setLevel')]
    public function setLevel($level)
    {
        if ($level === 'TK') {
            $role = 'guru tk';
        } elseif ($level === 'SD') {
            $role = 'guru sd';
        } elseif ($level === "SMP") {
            $role = 'guru smp';
        } elseif ($level === "SMA") {
            $role = 'guru sma';
        } else {
            $role = null;
        }


        $this->staff = Staff::whereHas('user.levels', function ($query) use ($role) {
            $query->where('level', $role);
        })->whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->get();
        $this->dispatch('refreshData');
    }
}
