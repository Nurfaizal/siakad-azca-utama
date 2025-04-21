<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\SchoolYear;

class SchoolYearController extends Controller
{

    public $activeMenu = "master";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Tahun Ajaran";
        $activeMenu = $this->activeMenu;

        $year = SchoolYear::all();

        return view('admin.master.school_year.index', compact('title', 'activeMenu', 'year'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Tahun Ajaran";
        $activeMenu = $this->activeMenu;

        return view('admin.master.school_year.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Tahun Ajaran tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_school_year = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        SchoolYear::create($validate_school_year);

        return redirect('/tahun-ajaran')->with('success', 'Data Tahun Ajaran Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(SchoolYear $schoolYear)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_year)
    {
        $title = "Edit Tahun Ajaran";
        $activeMenu = $this->activeMenu;

        $year = SchoolYear::find(Crypt::decrypt($id_year));

        return view('admin.master.school_year.edit', compact('title', 'activeMenu', 'year'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_year)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Tahun Ajaran tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_school_year = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        if ($validate_school_year['status'] == 'Aktif') {
            SchoolYear::query()->update(['status' => 'Non-Aktif']);
        } else {
            return redirect('/tahun-ajaran')->with('status', 'Tahun Ajaran Harus Ada Aktif Satu.');
        }

        $year = SchoolYear::find(Crypt::decrypt($id_year));
        $year->update($validate_school_year);

        return redirect('/tahun-ajaran')->with('update', 'Data Tahun Ajaran Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_year)
    {
        $title = "Hapus Tahun Ajaran";
        $activeMenu = $this->activeMenu;

        $year = SchoolYear::find(Crypt::decrypt($id_year));

        return view('admin.master.school_year.delete', compact('title', 'activeMenu', 'year'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_year)
    {
        $year = SchoolYear::find(Crypt::decrypt($id_year));
        $year->delete();

        return redirect('/tahun-ajaran')->with('success', 'Data Tahun Ajaran Berhasil Di Hapus.');
    }
}
