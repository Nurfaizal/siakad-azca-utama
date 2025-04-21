<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\SkillProgram;

class SkillProgramController extends Controller
{

    public $activeMenu = "master";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Program Keahlian";
        $activeMenu = $this->activeMenu;

        $skill =  SkillProgram::all();

        return view('admin.master.skill_program.index', compact('title', 'activeMenu', 'skill'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Program Keahlian";
        $activeMenu = $this->activeMenu;

        return view('admin.master.skill_program.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama program keahlian tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_skill = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        SkillProgram::create($validate_skill);

        return redirect('/program-keahlian')->with('success', 'Data Program Keahlian Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(SkillProgram $skillProgram)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_skill)
    {
        $title = "Edit Program Keahlian";
        $activeMenu = $this->activeMenu;

        $skill = SkillProgram::find(Crypt::decrypt($id_skill));

        return view('admin.master.skill_program.edit', compact('title', 'activeMenu', 'skill'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_skill)
    {
        $messages = [
            'name.required' => 'Maaf, Nama program keahlian tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_skill = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        $skill = SkillProgram::find(Crypt::decrypt($id_skill));
        $skill->update($validate_skill);

        return redirect('/program-keahlian')->with('update', 'Data Program Keahlian Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_skill)
    {
        $title = "Hapus Program Keahlian";
        $activeMenu = $this->activeMenu;

        $skill = SkillProgram::find(Crypt::decrypt($id_skill));

        return view('admin.master.skill_program.delete', compact('title', 'activeMenu', 'skill'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_skill)
    {
        $skill = SkillProgram::find(Crypt::decrypt($id_skill));
        $skill->delete();

        return redirect('/program-keahlian')->with('success', 'Data Program Keahlian Berhasil Di Hapus.');
    }
}
