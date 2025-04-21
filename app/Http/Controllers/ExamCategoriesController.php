<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\ExamCategories;

class ExamCategoriesController extends Controller
{

    public $activeMenu = "exam";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Kategori Ujian";
        $activeMenu = $this->activeMenu;

        $exam_category =  ExamCategories::all();

        return view('admin.exam-quiz.exam-category.index', compact('title', 'activeMenu', 'exam_category'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Kategori Ujian";
        $activeMenu = $this->activeMenu;

        return view('admin.exam-quiz.exam-category.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Kategori Ujian tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_exam_category = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        ExamCategories::create($validate_exam_category);

        return redirect('/kategori-ujian')->with('success', 'Data Kategori Ujian Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(ExamCategories $examCategories)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_exam_category)
    {
        $title = "Edit Kategori Ujian";
        $activeMenu = $this->activeMenu;

        $exam_category = ExamCategories::find(Crypt::decrypt($id_exam_category));

        return view('admin.exam-quiz.exam-category.edit', compact('title', 'activeMenu', 'exam_category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_exam_category)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Kategori Ujian tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_exam_category = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        $exam_category = ExamCategories::find(Crypt::decrypt($id_exam_category));
        $exam_category->update($validate_exam_category);

        return redirect('/kategori-ujian')->with('update', 'Data Kategori Ujian Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_exam_category)
    {
        $title = "Hapus Kategori Ujian";
        $activeMenu = $this->activeMenu;

        $exam_category = ExamCategories::find(Crypt::decrypt($id_exam_category));

        return view('admin.exam-quiz.exam-category.delete', compact('title', 'activeMenu', 'exam_category'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_exam_category)
    {
        $exam_category = ExamCategories::find(Crypt::decrypt($id_exam_category));
        $exam_category->delete();

        return redirect('/kategori-ujian')->with('success', 'Data Kategori Ujian Berhasil Di Hapus.');
    }
}
