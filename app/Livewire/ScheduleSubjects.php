<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Staff;
use App\Models\Subject;
use Livewire\Component;
use Livewire\Attributes\On;


class ScheduleSubjects extends Component
{
    public $classes = [];
    public $staff = [];
    public $subjects = [];

    public function mount()
    {
        $this->classes = Classes::get();
    }

    public function render()
    {
        return view('livewire.schedule-subjects');
    }

    // tingkat
    #[On('setLevel')]
    public function setLevel($id_class)
    {
        $class = Classes::where('id_class', $id_class)->first();

        $this->subjects = Subject::where('level', $class->level)->get();

        if ($class->level === 'TK') {
            $role = 'guru tk';
        } elseif ($class->level === 'SD') {
            $role = 'guru sd';
        } elseif ($class->level === "SMP") {
            $role = 'guru smp';
        } elseif ($class->level === "SMA") {
            $role = 'guru sma';
        } else {
            $role = null;
        }


        $this->staff = Staff::whereHas('user.levels', function ($query) use ($role) {
            $query->where('level', $role);
        })->where('staff_status', 'Aktif')->get();
        $this->dispatch('refreshData');
    }
}
