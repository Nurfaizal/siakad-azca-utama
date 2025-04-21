<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\Staff;
use App\Models\DocumentCategories;
use App\Models\EDocumentStaff;

class EDocumentStaffController extends Controller
{

    public $activeMenu = "staff";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data E-Document Staff";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStaff::all();

        return view('admin.staff.edocument.index', compact('title', 'activeMenu', 'document'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah E-Document Staff";
        $activeMenu = $this->activeMenu;

        $staff = Staff::all();
        $type_document = DocumentCategories::all();

        return view('admin.staff.edocument.create', compact('title', 'activeMenu', 'staff', 'type_document'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'id_staff.required' => 'Maaf, Nama staff tidak boleh kosong.',
            'id_category.required' => 'Maaf, Kategori dokumen tidak boleh kosong.',
            'file.required' => 'Maaf, File tidak boleh kosong.',
        ];

        $validate_document_staff = $request->validate([
            'id_staff' => 'required',
            'id_category' => 'required',
            'file' => 'required',
        ], $messages);

        $file = $request->file('file');
        $filename = time() . "-" . $file->getClientOriginalName();

        Gdrive::put('E-Document-Staff' . '/' . $filename, $file);

        $validate_document_staff['file'] = $filename;

        EDocumentStaff::create($validate_document_staff);

        return redirect('/e-dokumen-staff')->with('success', 'Data E-Dokumen Staff Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_e_document_staff)
    {
        $title = "Detail E-Dokumen Staff";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStaff::find(Crypt::decrypt($id_e_document_staff));

        return view('admin.staff.edocument.show', compact('title', 'activeMenu', 'document'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_e_document_staff)
    {
        $title = "Edit E-Document Staff";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStaff::find(Crypt::decrypt($id_e_document_staff));

        $staff = Staff::all();
        $type_document = DocumentCategories::all();

        return view('admin.staff.edocument.edit', compact('title', 'activeMenu', 'document', 'staff', 'type_document'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_e_document_staff)
    {
        $messages = [
            'id_staff.required' => 'Maaf, Nama staff tidak boleh kosong.',
            'id_category.required' => 'Maaf, Kategori dokumen tidak boleh kosong.',
            'file.required' => 'Maaf, File tidak boleh kosong.',
        ];

        $validate_document_staff = $request->validate([
            'id_staff' => 'required',
            'id_category' => 'required',
            'file' => 'required',
        ], $messages);

        $document = EDocumentStaff::find(Crypt::decrypt($id_e_document_staff));

        if ($request->file('file') != null) {
            $file = $request->file('file');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::delete('E-Document-Staff' . '/' . $document->file);
            Gdrive::put('E-Document-Staff' . '/' . $filename, $file);

            $validate_document_staff['file'] = $filename;
        } else {
            $validate_document_staff['file'] = $document->file;
        }

        $document->update($validate_document_staff);

        return redirect('/e-dokumen-staff')->with('update', 'Data E-Dokumen Staff Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_e_document_staff)
    {
        $title = "Hapus E-Document Staff";
        $activeMenu = $this->activeMenu;

        $document = EDocumentStaff::find(Crypt::decrypt($id_e_document_staff));

        return view('admin.staff.edocument.delete', compact('title', 'activeMenu', 'document'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_e_document_staff)
    {
        $document = EDocumentStaff::find(Crypt::decrypt($id_e_document_staff));
        if ($document->file != null) {
            Gdrive::delete('E-Document-Staff' . '/' . $document->file);
        }
        $document->delete();

        return redirect('/e-dokumen-staff')->with('success', 'Data E-Dokumen Staff Berhasil Di Hapus.');
    }


    public function download(Request $request)
    {
        $filePath = $request->file_path;
        $data = Gdrive::get('E-Document-Staff' . '/' . $filePath);

        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-Disposition', 'attachment; filename="' . $data->filename . '"');
    }
}
