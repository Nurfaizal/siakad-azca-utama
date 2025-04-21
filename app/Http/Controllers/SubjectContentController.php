<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\SubjectContent;

class SubjectContentController extends Controller
{

    public $activeMenu = "subjects";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Muatan Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        $subject_content = SubjectContent::all();

        return view('admin.subjects.subjects_content.index', compact('title', 'activeMenu', 'subject_content'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Muatan Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        return view('admin.subjects.subjects_content.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Muatan Pelajaran tidak boleh kosong.',
            'status.required' => 'Maaf, status tidak boleh kosong.',
        ];

        $validate_subject_content = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        SubjectContent::create($validate_subject_content);

        return redirect('/muatan-mapel')->with('success', 'Data Muatan Mata Pelajaran Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(SubjectContent $subjectContent)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_subcontent)
    {
        $title = "Ubah Muatan Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        $subject_content = SubjectContent::find(Crypt::decrypt($id_subcontent));

        return view('admin.subjects.subjects_content.edit', compact('title', 'activeMenu', 'subject_content'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_subcontent)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Muatan Pelajaran tidak boleh kosong.',
            'status.required' => 'Maaf, status tidak boleh kosong.',
        ];

        $validate_subject_content = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        $subject_content = SubjectContent::find(Crypt::decrypt($id_subcontent));
        $subject_content->update($validate_subject_content);

        return redirect('/muatan-mapel')->with('update', 'Data Muatan Mata Pelajaran Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_subcontent)
    {
        $title = "Hapus Muatan Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        $subject_content = SubjectContent::find(Crypt::decrypt($id_subcontent));

        return view('admin.subjects.subjects_content.delete', compact('title', 'activeMenu', 'subject_content'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_subcontent)
    {
        $subject_content = SubjectContent::find(Crypt::decrypt($id_subcontent));
        $subject_content->delete();

        return redirect('/muatan-mapel')->with('success', 'Data Muatan Mata Pelajaran Berhasil Di Hapus.');
    }
}
