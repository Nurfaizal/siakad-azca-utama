<?php

namespace App\Http\Controllers;

use App\Models\AttendanceStudent;
use App\Models\AttendanceStudentDetail;
use App\Models\ScheduleSubject;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class AttendancesStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $activeMenu = "attendance";

    public function index()
    {
        $activeMenu = $this->activeMenu;
        $title = "Jadwal Mata Pelajaran";
        $schedules = ScheduleSubject::all();
        return view('admin.attendances.attendances_students.index', compact('activeMenu', 'title', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_schedule)
    {
        $id_schedule = Crypt::decrypt($id_schedule);
        $schedule = ScheduleSubject::with(['class', 'subject'])->find($id_schedule);
        $students = Student::where('id_class', $schedule->id_class)->get();
        $activeMenu = $this->activeMenu;
        $title = "Check in Absensi Mata Pelajaran";
        return view('admin.attendances.attendances_students.create', compact('activeMenu', 'title', 'schedule', 'students'));
    }

    public function checkout($id_attendance_student)
    {
        $id_attendance_student = Crypt::decrypt($id_attendance_student);
        $attendance = AttendanceStudent::find($id_attendance_student);
        if ($attendance->check_out) {
            return redirect()->back();
        }
        $foto = null;
        $fileData = null;
        $fileExt = null;
        if (!empty($attendance->image)) {
            try {
                $foto = Gdrive::get('attendance-images/' . $attendance->image);
                if ($foto) {
                    $fileData = base64_encode($foto->file);
                    $fileExt = $foto->ext;
                }
            } catch (Exception $e) {
                // Log error jika terjadi masalah saat mengambil gambar dari Gdrive
                Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
            }
        }

        $students = $attendance->attendence_details;
        $activeMenu = $this->activeMenu;
        $title = "Check out Absensi ";
        return view('admin.attendances.attendances_students.checkout', compact('activeMenu', 'title', 'attendance', 'students', 'fileExt', 'fileData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_schedule)
    {
        $reqValAtt = $request->validate([
            'mode' => 'required|in:offline,online',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);


        $reqValAtt['date'] = now()->format('Y-m-d');
        $reqValAtt['check_in'] = now()->format('H:i:s');
        $reqValAtt['check_out'] = null;
        $reqValAtt['created_by'] = Auth::user()->username;
        $id_schedule = Crypt::decrypt($id_schedule);
        $reqValAtt['id_schedule'] = $id_schedule;

        $request->validate([
            'status' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            if ($request->file('image') != null) {
                $file = $request->file('image');
                $filename = time() . "-" . $file->getClientOriginalName();

                Gdrive::put('attendance-images' . '/' . $filename, $file);

                $imagePath = $filename;
            } else {
                $imagePath = null;
            }

            $reqValAtt['image'] = $imagePath;

            $attendance = AttendanceStudent::create($reqValAtt);
            $schedule = ScheduleSubject::find($id_schedule)->first();
            $students = Student::where('id_class', $schedule->id_class)->get();
            foreach ($students as $index => $student) {
                AttendanceStudentDetail::create([
                    'id_attendance_student' => $attendance->id_attendance_student,
                    'id_student' => $student->id_student,
                    'status' => $request->status[$index],
                ]);
            }

            DB::commit();
            return redirect('/absensi-siswa/' . Crypt::encrypt($attendance->id_schedule))->with('update', 'Absensi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateCheckout(Request $request, $id_attendance_student)
    {
        $reqValAtt = $request->validate([
            'mode' => 'required|in:offline,online',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);


        $reqValAtt['check_out'] = now()->format('H:i:s');
        $reqValAtt['created_by'] = Auth::user()->username;
        $id_attendance_student = Crypt::decrypt($id_attendance_student);

        $request->validate([
            'status' => 'required|array',
        ]);

        DB::beginTransaction();
        try {

            $attendance = AttendanceStudent::where('id_attendance_student', $id_attendance_student)->first();
            if ($request->file('image') != null) {
                $file = $request->file('image');
                $filename = time() . "-" . $file->getClientOriginalName();

                Gdrive::delete('attendance-images' . '/' . $attendance->image);
                Gdrive::put('attendance-images' . '/' . $filename, $file);

                $imagePath = $filename;
            } else {
                $imagePath = $attendance->image;
            }
            $reqValAtt['image'] = $imagePath;
            $attendance->update($reqValAtt);
            $schedule = ScheduleSubject::find($attendance->id_schedule)->first();
            $students = Student::where('id_class', $schedule->id_class)->get();
            foreach ($students as $index => $student) {
                AttendanceStudentDetail::where([['id_attendance_student', $id_attendance_student], ['id_student', $student->id_student]])->update([
                    'status' => $request->status[$index],
                ]);
            }

            DB::commit();
            return redirect('/absensi-siswa/' . Crypt::encrypt($attendance->id_schedule))->with('update', 'Absensi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id_schedule)
    {
        $activeMenu = $this->activeMenu;
        $title = "Detail Jadwal Mata Pelajaran";
        $id_schedule = Crypt::decrypt($id_schedule);
        $attendance = ScheduleSubject::with(['attendance_students' => function ($query) use ($id_schedule) {
            $query->where('id_schedule', $id_schedule);
        }])->find($id_schedule);

        $students = Student::join('attendance_student_details', 'student.id_student', '=', 'attendance_student_details.id_student')
            ->join('attendance_students', 'attendance_students.id_attendance_student', '=', 'attendance_student_details.id_attendance_student')
            ->where('attendance_students.id_schedule', $id_schedule)
            ->select('student.*')
            ->distinct()
            ->get();


        $recaps = [];

        foreach ($students as $student) {
            $data = [
                'name' => $student->name,
                'nis' => $student->nis,
                'kehadiran' => [],
            ];

            foreach ($attendance->attendance_students as $attend) {
                $status = AttendanceStudentDetail::where('id_attendance_student', $attend->id_attendance_student)
                    ->where('id_student', $student->id_student)
                    ->value('status') ?? '-';
                $data['kehadiran'][] = $status;
                // dump($student->id_student);
            }

            $recaps[] = $data;
        }
        // die;
        $totalStatus = [
            'hadir' => 0,
            'alpha' => 0,
            'izin' => 0,
            'sakit' => 0,
        ];

        foreach ($recaps as $rec) {
            foreach ($rec['kehadiran'] as $status) {
                if (isset($totalStatus[$status])) {
                    $totalStatus[$status]++;
                }
            }
        }



        return view('admin.attendances.attendances_students.show', compact('activeMenu', 'title', 'attendance', 'students', 'recaps', 'totalStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_attendance_student)
    {
        $id_attendance_student = Crypt::decrypt($id_attendance_student);
        $attendance = AttendanceStudent::find($id_attendance_student);
        if (!$attendance->check_out) {
            return redirect()->back();
        }
        $foto = null;
        $fileData = null;
        $fileExt = null;
        if (!empty($attendance->image)) {
            try {
                $foto = Gdrive::get('attendance-images/' . $attendance->image);
                if ($foto) {
                    $fileData = base64_encode($foto->file);
                    $fileExt = $foto->ext;
                }
            } catch (Exception $e) {
                // Log error jika terjadi masalah saat mengambil gambar dari Gdrive
                Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
            }
        }

        $students = $attendance->attendence_details;
        $activeMenu = $this->activeMenu;
        $title = "Check out Absensi ";
        return view('admin.attendances.attendances_students.edit', compact('activeMenu', 'title', 'attendance', 'students', 'fileExt', 'fileData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_attendance_student)
    {
        $reqValAtt = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);


        $id_attendance_student = Crypt::decrypt($id_attendance_student);

        $request->validate([
            'status' => 'required|array',
        ]);

        DB::beginTransaction();
        try {

            $attendance = AttendanceStudent::where('id_attendance_student', $id_attendance_student)->first();
            if ($request->file('image') != null) {
                $file = $request->file('image');
                $filename = time() . "-" . $file->getClientOriginalName();

                Gdrive::delete('attendance-images' . '/' . $attendance->image);
                Gdrive::put('attendance-images' . '/' . $filename, $file);

                $imagePath = $filename;
            } else {
                $imagePath = $attendance->image;
            }
            $reqValAtt['image'] = $imagePath;
            $attendance->update($reqValAtt);
            $schedule = ScheduleSubject::find($attendance->id_schedule)->first();
            $students = Student::where('id_class', $schedule->id_class)->get();
            foreach ($students as $index => $student) {
                AttendanceStudentDetail::where([['id_attendance_student', $id_attendance_student], ['id_student', $student->id_student]])->update([
                    'status' => $request->status[$index],
                ]);
            }

            DB::commit();
            return redirect('/absensi-siswa/' . Crypt::encrypt($attendance->id_schedule))->with('update', 'Absensi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceStudent $attendanceStudent)
    {
        //
    }
}
