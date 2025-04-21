<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\Subject;
use App\Models\SubjectContent;

class SubjectController extends Controller
{

    public $activeMenu = "subjects";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        $subject = Subject::all();

        return view('admin.subjects.subjects.index', compact('title', 'activeMenu', 'subject'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        $subject_content = SubjectContent::where('status', 'Aktif')->get();

        return view('admin.subjects.subjects.create', compact('title', 'activeMenu', 'subject_content'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Mata Pelajaran tidak boleh kosong.',
            'subject_code.required' => 'Maaf, Kode Mata Pelajaran tidak boleh kosong.',
            'id_subcontent.required' => 'Maaf, Nama Muatan Pelajaran tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',

            'level.required' => 'Maaf, Tingkat tidak boleh kosong.',
        ];

        $validate_subject = $request->validate([
            'name' => 'required',
            'subject_code' => 'required',
            'level' => 'required',
            'id_subcontent' => 'required',
            'status' => 'required',
        ], $messages);

        Subject::create($validate_subject);

        return redirect('/mapel')->with('success', 'Data Mata Pelajaran Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_subject)
    {
        $title = "Ubah Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        $subject = Subject::find(Crypt::decrypt($id_subject));

        $subject_content = SubjectContent::where('status', 'Aktif')->get();

        return view('admin.subjects.subjects.edit', compact('title', 'activeMenu', 'subject_content', 'subject'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_subject)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Mata Pelajaran tidak boleh kosong.',
            'subject_code.required' => 'Maaf, Kode Mata Pelajaran tidak boleh kosong.',
            'id_subcontent.required' => 'Maaf, Nama Muatan Pelajaran tidak boleh kosong.',
            'status.required' => 'Maaf, status tidak boleh kosong.',

            'level.required' => 'Maaf, Tingkat tidak boleh kosong.',

        ];

        $validate_subject = $request->validate([
            'name' => 'required',
            'subject_code' => 'required',
            'level' => 'required',
            'id_subcontent' => 'required',
            'status' => 'required',
        ], $messages);

        $subject = Subject::find(Crypt::decrypt($id_subject));
        $subject->update($validate_subject);

        return redirect('/mapel')->with('update', 'Data Mata Pelajaran Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_subject)
    {
        $title = "Hapus Mata Pelajaran";
        $activeMenu = $this->activeMenu;

        $subject = Subject::find(Crypt::decrypt($id_subject));

        return view('admin.subjects.subjects.delete', compact('title', 'activeMenu', 'subject'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_subject)
    {
        $subject = Subject::find(Crypt::decrypt($id_subject));
        $subject->delete();

        return redirect('/mapel')->with('success', 'Data Mata Pelajaran Berhasil Di Hapus.');
    }
}
