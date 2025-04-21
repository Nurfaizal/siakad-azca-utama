<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\Staff;
use App\Models\StaffNote;

class StaffNoteController extends Controller
{

    public $activeMenu = "notes";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Catatan Staff";
        $activeMenu = $this->activeMenu;

        $staff_note = StaffNote::all();

        return view('admin.notes.staff-notes.index', compact('title', 'activeMenu', 'staff_note'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Catatan Staff";
        $activeMenu = $this->activeMenu;

        $staff = Staff::all();

        return view('admin.notes.staff-notes.create', compact('title', 'activeMenu', 'staff'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'id_staff.required' => 'Maaf, Nama staff tidak boleh kosong.',
            'note.required' => 'Maaf, Isi catatan tidak boleh kosong.',
            'image.required' => 'Maaf, Foto tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_staff_note = $request->validate([
            'id_staff' => 'required',
            'note' => 'required',
            'image' => 'required',
            'status' => 'required',
        ], $messages);

        $file = $request->file('image');
        $filename = time() . "-" . $file->getClientOriginalName();

        Gdrive::put('Foto-Catatan-Staff' . '/' . $filename, $file);

        $validate_staff_note['image'] = $filename;

        StaffNote::create($validate_staff_note);

        return redirect('/catatan-staff')->with('success', 'Data Catatan Staff Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_staff_note)
    {
        $title = "Detail Catatan Staff";
        $activeMenu = $this->activeMenu;

        $staff_note = StaffNote::find(Crypt::decrypt($id_staff_note));

        $foto = Gdrive::get('Foto-Catatan-Staff' . '/' . $staff_note->image);

        return view('admin.notes.staff-notes.show', [
            'fileData' => base64_encode($foto->file), // Encode file agar bisa digunakan dalam HTML
            'fileExt' => $foto->ext,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'staff_note' => $staff_note,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_staff_note)
    {
        $title = "Ubah Catatan Staff";
        $activeMenu = $this->activeMenu;

        $staff_note = StaffNote::find(Crypt::decrypt($id_staff_note));

        $staff = staff::all();

        $foto = Gdrive::get('Foto-Catatan-Staff' . '/' . $staff_note->image);

        return view('admin.notes.staff-notes.edit', [
            'fileData' => base64_encode($foto->file), // Encode file agar bisa digunakan dalam HTML
            'fileExt' => $foto->ext,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'staff_note' => $staff_note,
            'staff' => $staff,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_staff_note)
    {
        $messages = [
            'id_staff.required' => 'Maaf, Nama staff tidak boleh kosong.',
            'note.required' => 'Maaf, Isi catatan tidak boleh kosong.',
            'image.required' => 'Maaf, Foto tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_staff_note = $request->validate([
            'id_staff' => 'required',
            'note' => 'required',
            'image' => 'nullable',
            'status' => 'required',
        ], $messages);

        $staff_note = StaffNote::find(Crypt::decrypt($id_staff_note));

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::delete('Foto-Catatan-Staff' . '/' . $staff_note->image);
            Gdrive::put('Foto-Catatan-Staff' . '/' . $filename, $file);

            $validate_staff_note['image'] = $filename;
        } else {
            $validate_staff_note['image'] = $staff_note->image;
        }

        $staff_note->update($validate_staff_note);

        return redirect('/catatan-staff')->with('update', 'Data Catatan Staff Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_staff_note)
    {
        $title = "Hapus Catatan Staff";
        $activeMenu = $this->activeMenu;

        $staff_note = StaffNote::find(Crypt::decrypt($id_staff_note));

        return view('admin.notes.staff-notes.delete', compact('title', 'activeMenu', 'staff_note'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_staff_note)
    {
        $staff_note = StaffNote::find(Crypt::decrypt($id_staff_note));
        if ($staff_note->image != null) {
            Gdrive::delete('Foto-Catatan-Staff' . '/' . $staff_note->image);
        }
        $staff_note->delete();

        return redirect('/catatan-staff')->with('success', 'Data Catatan Staff Berhasil Di Hapus.');
    }
}
