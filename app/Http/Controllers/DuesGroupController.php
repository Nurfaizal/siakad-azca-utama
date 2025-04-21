<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\DuesGroup;

class DuesGroupController extends Controller
{

    public $activeMenu = "dues";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Grup Iuran";
        $activeMenu = $this->activeMenu;

        $dues_group =  DuesGroup::all();

        return view('admin.dues.dues_group.index', compact('title', 'activeMenu', 'dues_group'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Grup Iuran";
        $activeMenu = $this->activeMenu;

        return view('admin.dues.dues_group.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama grup tidak boleh kosong.',
            'description.required' => 'Maaf, Deskripsi tidak boleh kosong.',
            'type.required' => 'Maaf, Jenis iuran tidak boleh kosong.',
            'amount.required' => 'Maaf, Nominal tidak boleh kosong.',
            'due_date.required' => 'Maaf, Tanggal jatuh tempo tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_dues_group = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ], $messages);

        $validate_dues_group['amount'] = str_replace('.', '', $request->amount);

        DuesGroup::create($validate_dues_group);

        return redirect('/grup-iuran')->with('success', 'Data Grup Iuran Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_dues_group)
    {
        $title = "Detail Grup Iuran";
        $activeMenu = $this->activeMenu;

        $dues_group = DuesGroup::find(Crypt::decrypt($id_dues_group));

        return view('admin.dues.dues_group.show', compact('title', 'activeMenu', 'dues_group'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_dues_group)
    {
        $title = "Edit Grup Iuran";
        $activeMenu = $this->activeMenu;

        $dues_group = DuesGroup::find(Crypt::decrypt($id_dues_group));

        return view('admin.dues.dues_group.edit', compact('title', 'activeMenu', 'dues_group'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_dues_group)
    {
        $messages = [
            'name.required' => 'Maaf, Nama grup tidak boleh kosong.',
            'description.required' => 'Maaf, Deskripsi tidak boleh kosong.',
            'type.required' => 'Maaf, Jenis iuran tidak boleh kosong.',
            'amount.required' => 'Maaf, Nominal tidak boleh kosong.',
            'due_date.required' => 'Maaf, Tanggal jatuh tempo tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_dues_group = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ], $messages);

        $validate_dues_group['amount'] = str_replace('.', '', $request->amount);

        $dues_group = DuesGroup::find(Crypt::decrypt($id_dues_group));
        $dues_group->update($validate_dues_group);

        return redirect('/grup-iuran')->with('update', 'Data Grup Iuran Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_dues_group)
    {
        $title = "Hapus Grup Iuran";
        $activeMenu = $this->activeMenu;

        $dues_group = DuesGroup::find(Crypt::decrypt($id_dues_group));

        return view('admin.dues.dues_group.delete', compact('title', 'activeMenu', 'dues_group'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_dues_group)
    {
        $dues_group = DuesGroup::find(Crypt::decrypt($id_dues_group));
        $dues_group->delete();

        return redirect('/grup-iuran')->with('success', 'Data Grup Iuran Berhasil Di Hapus.');
    }
}
