<?php

namespace App\Livewire;

use App\Models\Staff;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class StaffSalary extends Component
{
    use WithPagination;
    public $month = null;
    public $year = null;
    public $staff = [];

    public function mount()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->staff = Staff::with(['salaries' => function ($query) {
            $query->where('month', $this->month)
                ->where('year', $this->year);
        }, 'division'])->get();
    }

    public function render()
    {
        return view('livewire.staff-salary');
    }

    #[On('setMonth')]
    public function setMonth($month = null)
    {
        $this->month = $month;
        $this->staff = Staff::with(['salaries' => function ($query) {
            $query->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year);
        }, 'division'])->get();
        $this->dispatch('refreshTable');
    }

    #[On('setYear')]
    public function setYear($year = null)
    {
        $this->year = $year;
        $this->staff = Staff::with(['salaries' => function ($query) {
            $query->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year);
        }, 'division'])->get();
        $this->dispatch('refreshTable');
    }
}
