<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\SchoolYear;
use App\Models\SkillProgram;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $activeMenu = "academic";


    // 1. Fungsi menampilkan semua data kelas
    public function index()
    {
        $title = "Daftar Kelas";
        $activeMenu = $this->activeMenu;

        $sy = SchoolYear::firstWhere('status', 'Aktif');

        $classes = $sy !== null ? Classes::where('id_year', $sy->id_year)->get() : [];

        return view('admin.academic.class.index', compact('title', 'activeMenu', 'classes'));
    }



    // 2. Fungsi menampilkan halaman tambah kelas
    public function create()
    {
        $title = "Tambah Kelas";
        $activeMenu = $this->activeMenu;

        $skill = SkillProgram::where('status', 'Aktif')->get();
        $staff = Staff::whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->get();
        $year = SchoolYear::where('status', 'Aktif')->get();

        return view('admin.academic.class.create', compact('title', 'activeMenu', 'skill', 'staff', 'year'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama kelas tidak boleh kosong.',
            'level.required' => 'Maaf, Tingkat tidak boleh kosong.',
            'time_in.required' => 'Maaf, Jam masuk tidak boleh kosong.',
            'time_out.required' => 'Maaf, Jam keluar tidak boleh kosong.',
            'id_staff.required' => 'Maaf, Wali kelas tidak boleh kosong.',
            'id_year.required' => 'Maaf, Tahun ajaran tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_classes = $request->validate([
            'name' => 'required',
            'level' => 'required',
            'id_skill' => 'nullable',
            'time_in' => 'required',
            'time_out' => 'required',
            'id_staff' => 'required',
            'status' => 'required',
        ], $messages);

        $sy = SchoolYear::firstWhere('status', 'Aktif');
        $validate_classes['id_year'] = $sy->id_year;

        Classes::create($validate_classes);

        return redirect('/kelas')->with('success', 'Data Kelas Berhasil Di Tambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Edit Kelas";
        $activeMenu = $this->activeMenu;

        $skill = SkillProgram::where('status', 'Aktif')->get();
        $staff = Staff::whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->get();
        $year = SchoolYear::where('status', 'Aktif')->get();

        $classes = Classes::find(Crypt::decrypt($id));

        if ($classes->id_skill != null) {
            $skill_name = $classes->skill->name;
        } else {
            $skill_name = "Tidak Ada";
        }

        return view('admin.academic.class.edit', compact('title', 'activeMenu', 'skill', 'staff', 'year', 'classes', 'skill_name'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Maaf, Nama kelas tidak boleh kosong.',
            'level.required' => 'Maaf, Tingkat tidak boleh kosong.',
            'time_in.required' => 'Maaf, Jam masuk tidak boleh kosong.',
            'time_out.required' => 'Maaf, Jam keluar tidak boleh kosong.',
            'id_staff.required' => 'Maaf, Wali kelas tidak boleh kosong.',
            'id_year.required' => 'Maaf, Tahun ajaran tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_classes = $request->validate([
            'name' => 'required',
            'level' => 'required',
            'id_skill' => 'nullable',
            'time_in' => 'required',
            'time_out' => 'required',
            'id_staff' => 'required',
            'status' => 'required',
        ], $messages);

        $sy = SchoolYear::firstWhere('status', 'Aktif');
        $validate_classes['id_year'] = $sy->id_year;

        $classes = Classes::find(Crypt::decrypt($id));
        $classes->update($validate_classes);

        return redirect('/kelas')->with('success', 'Data Kelas Berhasil Di Tambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function delete($id)
    {
        $title = "Hapus Kelas";
        $activeMenu = $this->activeMenu;

        $classes = Classes::find(Crypt::decrypt($id));

        return view('admin.academic.class.delete', compact('title', 'activeMenu', 'classes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classes = Classes::find(Crypt::decrypt($id));
        $classes->delete();

        return redirect('/kelas')->with('success', 'Data Kelas Berhasil Di Hapus.');
    }
}
