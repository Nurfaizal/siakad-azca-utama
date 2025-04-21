<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\SemesterType;

class SemesterTypeController extends Controller
{

    public $activeMenu = "print-e-raport";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Jenis Semester";
        $activeMenu = $this->activeMenu;

        $semester_type =  SemesterType::all();

        return view('admin.print-e-raport.semester-type.index', compact('title', 'activeMenu', 'semester_type'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Jenis Semester";
        $activeMenu = $this->activeMenu;

        return view('admin.print-e-raport.semester-type.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Jenis Semester tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_semester_type = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        SemesterType::create($validate_semester_type);

        return redirect('/jenis-semester')->with('success', 'Data Jenis Semester Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(SemesterType $semesterType)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_semester_type)
    {
        $title = "Edit Jenis Semester";
        $activeMenu = $this->activeMenu;

        $semester_type = SemesterType::find(Crypt::decrypt($id_semester_type));

        return view('admin.print-e-raport.semester-type.edit', compact('title', 'activeMenu', 'semester_type'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_semester_type)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Jenis Semester tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_semester_type = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        $semester_type = SemesterType::find(Crypt::decrypt($id_semester_type));
        $semester_type->update($validate_semester_type);

        return redirect('/jenis-semester')->with('update', 'Data Jenis Semester Berhasil Di Ubah.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function delete($id_semester_type)
    {
        $title = "Hapus Jenis Semester";
        $activeMenu = $this->activeMenu;

        $semester_type = SemesterType::find(Crypt::decrypt($id_semester_type));

        return view('admin.print-e-raport.semester-type.delete', compact('title', 'activeMenu', 'semester_type'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_semester_type)
    {
        $semester_type = SemesterType::find(Crypt::decrypt($id_semester_type));
        $semester_type->delete();

        return redirect('/jenis-semester')->with('success', 'Data Jenis Semester Berhasil Di Hapus.');
    }
}
