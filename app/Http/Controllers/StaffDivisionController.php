<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\StaffDivision;

class StaffDivisionController extends Controller
{

    public $activeMenu = "staff";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Divisi";
        $activeMenu = $this->activeMenu;

        $division = StaffDivision::all();

        return view('admin.staff.division.index', compact('title', 'activeMenu', 'division'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Divisi";
        $activeMenu = $this->activeMenu;

        return view('admin.staff.division.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama divisi tidak boleh kosong.',
            'time_in.required' => 'Maaf, Jam masuk tidak boleh kosong.',
            'time_out.required' => 'Maaf, Jam keluar tidak boleh kosong.',
        ];

        $validate_division = $request->validate([
            'name' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ], $messages);

        StaffDivision::create($validate_division);

        return redirect('/divisi')->with('success', 'Data Divisi Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(StaffDivision $staffDivision)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_division)
    {
        $title = "Edit Divisi";
        $activeMenu = $this->activeMenu;

        $division = StaffDivision::find(Crypt::decrypt($id_division));

        return view('admin.staff.division.edit', compact('title', 'activeMenu', 'division'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_division)
    {
        $messages = [
            'name.required' => 'Maaf, Nama divisi tidak boleh kosong.',
            'time_in.required' => 'Maaf, Jam masuk tidak boleh kosong.',
            'time_out.required' => 'Maaf, Jam masuk tidak boleh kosong.',
        ];

        $validate_division = $request->validate([
            'name' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ], $messages);

        $division = StaffDivision::find(Crypt::decrypt($id_division));
        $division->update($validate_division);

        return redirect('/divisi')->with('update', 'Data Divisi Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_division)
    {
        $title = "Hapus Divisi";
        $activeMenu = $this->activeMenu;

        $division = StaffDivision::find(Crypt::decrypt($id_division));

        return view('admin.staff.division.delete', compact('title', 'activeMenu', 'division'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_division)
    {
        $division = StaffDivision::find(Crypt::decrypt($id_division));
        $division->delete();

        return redirect('/divisi')->with('success', 'Data Divisi Berhasil Di Hapus.');
    }
}
