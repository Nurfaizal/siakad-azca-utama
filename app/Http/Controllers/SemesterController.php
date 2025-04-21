<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\Semester;
use App\Models\SemesterType;

class SemesterController extends Controller
{

    public $activeMenu = "print-e-raport";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Semester";
        $activeMenu = $this->activeMenu;

        $semester =  Semester::all();

        return view('admin.print-e-raport.semester.index', compact('title', 'activeMenu', 'semester'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Semester";
        $activeMenu = $this->activeMenu;

        $semester_type = SemesterType::all();

        return view('admin.print-e-raport.semester.create', compact('title', 'activeMenu', 'semester_type'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Semester tidak boleh kosong.',
            'code.required' => 'Maaf, Kode Semester tidak boleh kosong.',
            'id_semester_type.required' => 'Maaf, Jenis Semester tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'attendance.required' => 'Maaf, Nilai absensi tidak boleh kosong.',
            'daily_score.required' => 'Maaf, Nilai harian tidak boleh kosong.',
            'mid_term_score.required' => 'Maaf, Nilai tengah semester tidak boleh kosong.',
            'final_term_score.required' => 'Maaf, Nilai akhir semester tidak boleh kosong.',

        ];

        $validate_semester = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'id_semester_type' => 'required',
            'status' => 'required',
            'final_level' => 'nullable',
            'attendance' => 'required',
            'daily_score' => 'required',
            'mid_term_score' => 'required',
            'final_term_score' => 'required',
        ], $messages);

        if ($request->final_level == 1) {
            $validate_semester['final_level'] = 1;
        }

        Semester::create($validate_semester);

        return redirect('/semester')->with('success', 'Data Semester Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_semester)
    {
        $title = "Detail Semester";
        $activeMenu = $this->activeMenu;

        $semester = Semester::find(Crypt::decrypt($id_semester));

        return view('admin.print-e-raport.semester.show', compact('title', 'activeMenu', 'semester'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_semester)
    {
        $title = "Edit Semester";
        $activeMenu = $this->activeMenu;

        $semester = Semester::find(Crypt::decrypt($id_semester));
        $semester_type = SemesterType::all();

        return view('admin.print-e-raport.semester.edit', compact('title', 'activeMenu', 'semester', 'semester_type'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_semester)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Semester tidak boleh kosong.',
            'code.required' => 'Maaf, Kode Semester tidak boleh kosong.',
            'id_semester_type.required' => 'Maaf, Jenis Semester tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'attendance.required' => 'Maaf, Nilai absensi tidak boleh kosong.',
            'daily_score.required' => 'Maaf, Nilai harian tidak boleh kosong.',
            'mid_term_score.required' => 'Maaf, Nilai tengah semester tidak boleh kosong.',
            'final_term_score.required' => 'Maaf, Nilai akhir semester tidak boleh kosong.',

        ];

        $validate_semester = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'id_semester_type' => 'required',
            'status' => 'required',
            'final_level' => 'nullable',
            'attendance' => 'required',
            'daily_score' => 'required',
            'mid_term_score' => 'required',
            'final_term_score' => 'required',
        ], $messages);

        if ($request->final_level == 1) {
            $validate_semester['final_level'] = 1;
        } else {
            $validate_semester['final_level'] = 0;
        }

        $semester = Semester::find(Crypt::decrypt($id_semester));
        $semester->update($validate_semester);

        return redirect('/semester')->with('update', 'Data Semester Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_semester)
    {
        $title = "Hapus Semester";
        $activeMenu = $this->activeMenu;

        $semester = Semester::find(Crypt::decrypt($id_semester));

        return view('admin.print-e-raport.semester.delete', compact('title', 'activeMenu', 'semester'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_semester)
    {
        $semester = Semester::find(Crypt::decrypt($id_semester));
        $semester->delete();

        return redirect('/semester')->with('success', 'Data Semester Berhasil Di Hapus.');
    }
}
