<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ScheduleSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ScheduleSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $activeMenu = "subjects";

    public function index()
    {
        $activeMenu = $this->activeMenu;
        $title = "Jadwal Mata Pelajaran";
        $schedules = ScheduleSubject::all();
        return view('admin.subjects.schedule_subjects.index', compact('activeMenu', 'title', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activeMenu = $this->activeMenu;
        $title = "Tambah Jadwal Mata Pelajaran";

        $classes = Classes::get();
        $subjects = Subject::get();

        return view('admin.subjects.schedule_subjects.create', compact('activeMenu', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reqVal = $request->validate([
            'id_class'   => 'required|exists:classes,id_class',
            'id_subject' => 'required|exists:subject,id_subject',
            'id_staff'   => 'required|exists:staff,id_staff',
            'day'        => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,ahad',
            'location'   => 'required|string|max:255',
            'link'       => 'nullable|url|max:255',
            'start_time'    => 'required',
            'end_time'   => 'required|after:time_in',
            'status'     => 'required|in:Aktif,Non-Aktif'
        ]);

        ScheduleSubject::create($reqVal);

        return redirect('/jadwal-mapel')->with('create', 'Berhasil membuat jadwal baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduleSubject $scheduleSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_schedule)
    {
        $id_schedule = Crypt::decrypt($id_schedule);
        $activeMenu = $this->activeMenu;
        $title = "Ubah Jadwal Mata Pelajaran";
        $schedule = ScheduleSubject::find($id_schedule);
        return view('admin.subjects.schedule_subjects.edit', compact('activeMenu', 'title', 'schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_schedule)
    {
        $reqVal = $request->validate([
            'id_class'   => 'required|exists:classes,id_class',
            'id_subject' => 'required|exists:subject,id_subject',
            'id_staff'   => 'required|exists:staff,id_staff',
            'day'        => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,ahad',
            'location'   => 'required|string|max:255',
            'link'       => 'nullable|url|max:255',
            'start_time'    => 'required',
            'end_time'   => 'required|after:time_in',
            'status'     => 'required|in:Aktif,Non-Aktif'
        ]);

        $id_schedule = Crypt::decrypt($id_schedule);

        ScheduleSubject::where('id_schedule', $id_schedule)->update($reqVal);

        return redirect('/jadwal-mapel')->with('update', 'Berhasil mengubah jadwal!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id_schedule)
    {
        $id_schedule = Crypt::decrypt($id_schedule);
        $activeMenu = $this->activeMenu;
        $title = "Hapus Mata Pelajaran";
        $schedule = ScheduleSubject::find($id_schedule);
        return view('admin.subjects.schedule_subjects.delete', compact('activeMenu', 'title', 'schedule'));
    }

    public function destroy($id_schedule)
    {
        $id_schedule = Crypt::decrypt($id_schedule);
        ScheduleSubject::destroy($id_schedule);
        return redirect('/jadwal-mapel')->with('success', 'Berhasil menghapus jadwal!');
    }
}
