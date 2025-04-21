<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\PersonalEntryHour;

class PersonalEntryHourController extends Controller
{

    public $activeMenu = "staff";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Penetapan Jam Masuk Personal";
        $activeMenu = $this->activeMenu;

        $personal = PersonalEntryHour::all();

        return view('admin.staff.personal-time.index', compact('title', 'activeMenu', 'personal'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(PersonalEntryHour $personalEntryHour)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_personal)
    {
        $title = "Ubah Penetapan Jam Masuk Personal";
        $activeMenu = $this->activeMenu;

        $personal = PersonalEntryHour::find(Crypt::decrypt($id_personal));

        return view('admin.staff.personal-time.edit', compact('title', 'activeMenu', 'personal'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_personal)
    {
        $validate_personal_hour = $request->validate([
            'monday_in' => 'required',
            'monday_out' => 'required',
            'tuesday_in' => 'required',
            'tuesday_out' => 'required',
            'wednesday_in' => 'required',
            'wednesday_out' => 'required',
            'thursday_in' => 'required',
            'thursday_out' => 'required',
            'friday_in' => 'required',
            'friday_out' => 'required',
            'saturday_in' => 'nullable',
            'saturday_out' => 'nullable',
            'sunday_in' => 'nullable',
            'sunday_out' => 'nullable',
        ]);

        $personal = PersonalEntryHour::find(Crypt::decrypt($id_personal));
        $personal->update($validate_personal_hour);

        return redirect('/penetapan-jam-personal')->with('update', 'Penetapan Jam Masuk Personal Berhasil Di Ubah.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalEntryHour $personalEntryHour)
    {
        //
    }
}
