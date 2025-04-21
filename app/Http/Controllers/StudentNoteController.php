<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\Classes;
use App\Models\Student;
use App\Models\StudentNote;

class StudentNoteController extends Controller
{

    public $activeMenu = "notes";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Catatan Siswa";
        $activeMenu = $this->activeMenu;

        $student_note = StudentNote::all();

        return view('admin.notes.student-notes.index', compact('title', 'activeMenu', 'student_note'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Catatan Siswa";
        $activeMenu = $this->activeMenu;

        $class = Classes::all();
        $student = Student::all();

        return view('admin.notes.student-notes.create', compact('title', 'activeMenu', 'class', 'student'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'id_class.required' => 'Maaf, Nama kelas tidak boleh kosong.',
            'id_student.required' => 'Maaf, Nama siswa tidak boleh kosong.',
            'note.required' => 'Maaf, Isi catatan tidak boleh kosong.',
            'image.required' => 'Maaf, Foto tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_student_note = $request->validate([
            'id_class' => 'required',
            'id_student' => 'required',
            'note' => 'required',
            'image' => 'required',
            'status' => 'required',
        ], $messages);

        $file = $request->file('image');
        $filename = time() . "-" . $file->getClientOriginalName();

        Gdrive::put('Foto-Catatan-Siswa' . '/' . $filename, $file);

        $validate_student_note['image'] = $filename;

        StudentNote::create($validate_student_note);

        return redirect('/catatan-siswa')->with('success', 'Data Catatan Siswa Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_student_note)
    {
        $title = "Detail Catatan Siswa";
        $activeMenu = $this->activeMenu;

        $student_note = StudentNote::find(Crypt::decrypt($id_student_note));

        $foto = Gdrive::get('Foto-Catatan-Siswa' . '/' . $student_note->image);

        return view('admin.notes.student-notes.show', [
            'fileData' => base64_encode($foto->file), // Encode file agar bisa digunakan dalam HTML
            'fileExt' => $foto->ext,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'student_note' => $student_note,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_student_note)
    {
        $title = "Ubah Catatan Siswa";
        $activeMenu = $this->activeMenu;

        $student_note = StudentNote::find(Crypt::decrypt($id_student_note));

        $class = Classes::all();
        $student = Student::all();

        $foto = Gdrive::get('Foto-Catatan-Siswa' . '/' . $student_note->image);

        return view('admin.notes.student-notes.edit', [
            'fileData' => base64_encode($foto->file), // Encode file agar bisa digunakan dalam HTML
            'fileExt' => $foto->ext,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'student_note' => $student_note,
            'class' => $class,
            'student' => $student,

        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_student_note)
    {
        $messages = [
            'id_class.required' => 'Maaf, Nama kelas tidak boleh kosong.',
            'id_student.required' => 'Maaf, Nama siswa tidak boleh kosong.',
            'note.required' => 'Maaf, Isi catatan tidak boleh kosong.',
            'image.required' => 'Maaf, Foto tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_student_note = $request->validate([
            'id_class' => 'required',
            'id_student' => 'required',
            'note' => 'required',
            'image' => 'nullable',
            'status' => 'required',
        ], $messages);

        $student_note = StudentNote::find(Crypt::decrypt($id_student_note));

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::delete('Foto-Catatan-Siswa' . '/' . $student_note->image);
            Gdrive::put('Foto-Catatan-Siswa' . '/' . $filename, $file);

            $validate_student_note['image'] = $filename;
        } else {
            $validate_student_note['image'] = $student_note->image;
        }

        $student_note->update($validate_student_note);

        return redirect('/catatan-siswa')->with('update', 'Data Catatan Siswa Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_student_note)
    {
        $title = "Hapus Catatan Siswa";
        $activeMenu = $this->activeMenu;

        $student_note = StudentNote::find(Crypt::decrypt($id_student_note));

        return view('admin.notes.student-notes.delete', compact('title', 'activeMenu', 'student_note'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_student_note)
    {
        $student_note = StudentNote::find(Crypt::decrypt($id_student_note));
        if ($student_note->image != null) {
            Gdrive::delete('Foto-Catatan-Siswa' . '/' . $student_note->image);
        }
        $student_note->delete();

        return redirect('/catatan-siswa')->with('success', 'Data Catatan Siswa Berhasil Di Hapus.');
    }
}
