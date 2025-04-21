<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\SchoolYear;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\On;



class ClassMutation extends Component
{
    public $classes = [];
    public $schoolYears = [];
    public $students = [];
    public $toStudents = [];
    public $id_class = null;
    public $ta = null;
    public $from_id_student = [];
    public $to_id_class = null;

    public function mount()
    {

        // $this->classes = Classes::where('status', 'Aktif')->get();
        $this->schoolYears = SchoolYear::all();
    }

    #[On('setFromIdYear')]
    public function setFromIdYear($id_year = null)
    {
        $this->classes = Classes::where([['status', 'Aktif'], ['id_year', $id_year]])->get();
        $this->students = Student::where('id_class', null)
            ->whereHas('user', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
        $this->dispatch('refreshData');
    }

    #[On('setFromIdClass')]
    public function setFromIdClass($id_class = null)
    {
        $this->id_class = $id_class;
        $this->students = Student::where('id_class', $id_class)
            ->whereHas('user', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
        $this->dispatch('refreshData');
    }

    #[On('searchByFromName')]
    public function searchByFromName($name = null)
    {
        $this->students = Student::where([['id_class', $this->id_class], ['name', 'like', "%{$name}%"]])
            ->whereHas('user', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
    }


    #[On('setToIdYear')]
    public function setToIdYear($id_year = null)
    {
        $this->classes = Classes::where([['status', 'Aktif'], ['id_year', $id_year]])->get();
        $this->toStudents = Student::where('id_class', null)
            ->whereHas('user', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
        $this->dispatch('refreshData');
    }

    #[On('setToIdClass')]
    public function setToIdClass($id_class = null)
    {
        $this->id_class = $id_class;
        $this->toStudents = Student::where('id_class', $id_class)
            ->whereHas('user', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
        $this->dispatch('refreshData');
    }

    #[On('searchByToName')]
    public function searchByToName($name = null)
    {
        $this->toStudents = Student::where([['id_class', $this->id_class], ['name', 'like', "%{$name}%"]])
            ->whereHas('user', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
    }

    public function updateClass()
    {
        // Debugging (cek apakah checkbox bekerja)
        if (empty($this->from_id_student)) {
            dump(1);
            session()->flash('error', 'Tidak ada siswa yang dipilih.');
            return;
        }

        $this->validate([
            'from_id_student' => 'required|array',
            'to_id_class' => 'required|exists:classes,id_class',
        ]);

        // Perbarui kelas siswa yang dipilih
        Student::whereIn('id_student', $this->from_id_student)
            ->update(['id_class' => $this->to_id_class]);

        // Bersihkan pilihan setelah pemindahan berhasil
        $this->from_id_student = [];

        session()->flash('success', 'Siswa berhasil dipindahkan.');
    }


    public function render()
    {
        return view('livewire.class-mutation');
    }
}
