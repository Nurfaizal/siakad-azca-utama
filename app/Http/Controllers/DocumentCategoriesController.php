<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\DocumentCategories;

class DocumentCategoriesController extends Controller
{

    public $activeMenu = "master";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Kategori Dokumen";
        $activeMenu = $this->activeMenu;

        $category = DocumentCategories::all();

        return view('admin.master.document_categories.index', compact('title', 'activeMenu', 'category'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Kategori Dokumen";
        $activeMenu = $this->activeMenu;

        return view('admin.master.document_categories.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama dokumen tidak boleh kosong.',
            'type.required' => 'Maaf, Tipe dokumen tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_document_category = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ], $messages);

        DocumentCategories::create($validate_document_category);

        return redirect('/kategori-e-document')->with('success', 'Data Kategori-E-Dokumen Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(DocumentCategories $documentCategories)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_category)
    {
        $title = "Ubah Kategori Dokumen";
        $activeMenu = $this->activeMenu;

        $category = DocumentCategories::find(Crypt::decrypt($id_category));

        return view('admin.master.document_categories.edit', compact('title', 'activeMenu', 'category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_category)
    {
        $messages = [
            'name.required' => 'Maaf, Nama dokumen tidak boleh kosong.',
            'type.required' => 'Maaf, Tipe dokumen tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_document_category = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ], $messages);

        $category = DocumentCategories::find(Crypt::decrypt($id_category));
        $category->update($validate_document_category);

        return redirect('/kategori-e-document')->with('update', 'Data Kategori-E-Dokumen Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_category)
    {
        $title = "Hapus Kategori Dokumen";
        $activeMenu = $this->activeMenu;

        $category = DocumentCategories::find(Crypt::decrypt($id_category));

        return view('admin.master.document_categories.delete', compact('title', 'activeMenu', 'category'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_category)
    {
        $category = DocumentCategories::find(Crypt::decrypt($id_category));
        $category->delete();

        return redirect('/kategori-e-document')->with('success', 'Data Kategori-E-Dokumen Berhasil Di Hapus.');
    }
}
