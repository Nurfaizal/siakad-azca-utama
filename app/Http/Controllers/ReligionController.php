<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\Religion;

class ReligionController extends Controller
{

    public $activeMenu = "master";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Agama";
        $activeMenu = $this->activeMenu;

        $religion =  Religion::all();

        return view('admin.master.religion.index', compact('title', 'activeMenu', 'religion'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Agama";
        $activeMenu = $this->activeMenu;

        return view('admin.master.religion.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Agama tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_religion = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        Religion::create($validate_religion);

        return redirect('/agama')->with('success', 'Data Agama Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Religion $religion)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_religion)
    {
        $title = "Edit Agama";
        $activeMenu = $this->activeMenu;

        $religion = Religion::find(Crypt::decrypt($id_religion));

        return view('admin.master.religion.edit', compact('title', 'activeMenu', 'religion'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_religion)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Agama tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_religion = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        $religion = Religion::find(Crypt::decrypt($id_religion));
        $religion->update($validate_religion);

        return redirect('/agama')->with('update', 'Data Agama Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_religion)
    {
        $title = "Hapus Agama";
        $activeMenu = $this->activeMenu;

        $religion = Religion::find(Crypt::decrypt($id_religion));

        return view('admin.master.religion.delete', compact('title', 'activeMenu', 'religion'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_religion)
    {
        $religion = Religion::find(Crypt::decrypt($id_religion));
        $religion->delete();

        return redirect('/agama')->with('success', 'Data Agama Berhasil Di Hapus.');
    }
}
