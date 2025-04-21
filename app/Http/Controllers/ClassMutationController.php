<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassMutationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $activeMenu = "academic";

    public function index()
    {
        $title = "Halaman mutasi kelas";
        $activeMenu = $this->activeMenu;
        return view('admin.academic.class_mutation.index', compact('activeMenu', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function mutation(Request $request)
    {
        // dd($request->from_id_student);
        $request->validate([
            'from_id_student' => 'required|array',
            'to_id_class' => 'required|exists:classes,id_class',
        ]);

        // Perbarui kelas siswa yang dipilih
        Student::whereIn('id_student', $request->from_id_student)
            ->update(['id_class' => $request->to_id_class]);

        return redirect()->back()->with('success', 'Berhasil melakukan mutasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classes $classes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
