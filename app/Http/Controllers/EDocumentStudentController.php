<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\Student;
use App\Models\DocumentCategories;
use App\Models\EDocumentStudent;

class EDocumentStudentController extends Controller
{

    public $activeMenu = "students";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data E-Document Siswa";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStudent::all();

        return view('admin.students.edocument.index', compact('title', 'activeMenu', 'document'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah E-Document Siswa";
        $activeMenu = $this->activeMenu;

        $student = Student::all();
        $type_document = DocumentCategories::all();

        return view('admin.students.edocument.create', compact('title', 'activeMenu', 'student', 'type_document'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'id_student.required' => 'Maaf, Nama siswa tidak boleh kosong.',
            'id_category.required' => 'Maaf, Kategori dokumen tidak boleh kosong.',
            'file.required' => 'Maaf, File tidak boleh kosong.',
        ];

        $validate_document_student = $request->validate([
            'id_student' => 'required',
            'id_category' => 'required',
            'file' => 'required',
        ], $messages);

        $file = $request->file('file');
        $filename = time() . "-" . $file->getClientOriginalName();

        Gdrive::put('E-Document-Siswa' . '/' . $filename, $file);

        $validate_document_student['file'] = $filename;

        EDocumentStudent::create($validate_document_student);

        return redirect('/e-dokumen-siswa')->with('success', 'Data E-Dokumen Siswa Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_e_document_student)
    {
        $title = "Detail E-Dokumen Siswa";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStudent::find(Crypt::decrypt($id_e_document_student));

        return view('admin.students.edocument.show', compact('title', 'activeMenu', 'document'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_e_document_student)
    {
        $title = "Edit E-Document Siswa";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStudent::find(Crypt::decrypt($id_e_document_student));

        $student = Student::all();
        $type_document = DocumentCategories::all();

        return view('admin.students.edocument.edit', compact('title', 'activeMenu', 'document', 'student', 'type_document'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_e_document_student)
    {
        $messages = [
            'id_student.required' => 'Maaf, Nama student tidak boleh kosong.',
            'id_category.required' => 'Maaf, Kategori dokumen tidak boleh kosong.',
            'file.required' => 'Maaf, File tidak boleh kosong.',
        ];

        $validate_document_student = $request->validate([
            'id_student' => 'required',
            'id_category' => 'required',
            'file' => 'required',
        ], $messages);

        $document = EDocumentStudent::find(Crypt::decrypt($id_e_document_student));

        if ($request->file('file') != null) {
            $file = $request->file('file');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::delete('E-Document-Siswa' . '/' . $document->file);
            Gdrive::put('E-Document-Siswa' . '/' . $filename, $file);

            $validate_document_student['file'] = $filename;
        } else {
            $validate_document_student['file'] = $document->file;
        }

        $document->update($validate_document_student);

        return redirect('/e-dokumen-siswa')->with('update', 'Data E-Dokumen Siswa Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_e_document_student)
    {
        $title = "Hapus E-Document Siswa";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStudent::find(Crypt::decrypt($id_e_document_student));

        return view('admin.students.edocument.delete', compact('title', 'activeMenu', 'document'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_e_document_student)
    {
        $document = EDocumentStudent::find(Crypt::decrypt($id_e_document_student));
        if ($document->file != null) {
            Gdrive::delete('E-Document-Siswa' . '/' . $document->file);
        }
        $document->delete();

        return redirect('/e-dokumen-siswa')->with('success', 'Data E-Dokumen Siswa Berhasil Di Hapus.');
    }


    public function download(Request $request)
    {
        $filePath = $request->file_path;
        $data = Gdrive::get('E-Document-Siswa' . '/' . $filePath);

        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-Disposition', 'attachment; filename="' . $data->filename . '"');
    }
}
