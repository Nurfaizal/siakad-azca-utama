<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\ExamCategories;
use App\Models\Staff;
use App\Models\Room;
use Carbon\Carbon;

class ExamController extends Controller
{

    public $activeMenu = "exam";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Ujian/Quiz";
        $activeMenu = $this->activeMenu;

        $exam =  Exam::all();

        return view('admin.exam-quiz.exam.index', compact('title', 'activeMenu', 'exam'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Ujian/Quiz";
        $activeMenu = $this->activeMenu;

        $subject = Subject::all();
        $exam_category = ExamCategories::all();
        $staff = Staff::where('staff_status', 'Aktif')->get();
        $room = Room::all();

        return view('admin.exam-quiz.exam.create', compact('title', 'activeMenu', 'subject', 'exam_category', 'staff', 'room'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama ujian tidak boleh kosong.',
            'id_subject.required' => 'Maaf, Mata pelajaran tidak boleh kosong.',
            'id_exam_category.required' => 'Maaf, Kategori ujian tidak boleh kosong.',
            'exam_date.required' => 'Maaf, Tanggal ujian tidak boleh kosong.',
            'start_time.required' => 'Maaf, Waktu mulai tidak boleh kosong.',
            'end_time.required' => 'Maaf, Waktu selesai tidak boleh kosong.',
            'id_room.required' => 'Maaf, Nama Ruangan tidak boleh kosong.',
            'supervisor.required' => 'Maaf, Nama pengawas tidak boleh kosong.',
            'corrector.required' => 'Maaf, Nama pengoreksi tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'note.required' => 'Maaf, Catatan tidak boleh kosong.',
        ];

        $validate_exam = $request->validate([
            'name' => 'required', // 1
            'id_subject' => 'required', // 2
            'id_exam_category' => 'required', // 3
            'exam_date' => 'required', // 4
            'start_time' => 'required', // 5
            'end_time' => 'required', // 6
            'id_room' => 'required', // 7
            'supervisor' => 'required', // 8
            'corrector' => 'required', // 9
            'show_poin' => 'boolean', // 10
            'note' => 'required', // 12
        ], $messages);

        $code = substr(md5(Carbon::now()), 0, 6) . rand(100, 999);
        $validate_exam['code'] = $code;
        $validate_exam['status'] = 'Non-Aktif';
        $validate_exam['show_poin'] = $request->has('show_poin') ? '1' : '0';


        Exam::create($validate_exam);

        return redirect('/ujian-quiz')->with('success', 'Data Ujian/Quiz Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_exam)
    {
        $title = "Detail Ujian/Quiz";
        $activeMenu = $this->activeMenu;

        $exam = Exam::find(Crypt::decrypt($id_exam));

        return view('admin.exam-quiz.exam.show', compact('title', 'activeMenu', 'exam'));
    }

    public function createQuestion($id_exam)
    {
        $title = "Buat Soal Ujian/Quiz";
        $activeMenu = $this->activeMenu;

        return view('admin.exam-quiz.questions.create', compact('title', 'activeMenu', 'id_exam'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_exam)
    {
        $title = "Edit Ujian/Quiz";
        $activeMenu = $this->activeMenu;

        $exam = Exam::find(Crypt::decrypt($id_exam));

        $subject = Subject::all();
        $exam_category = ExamCategories::all();
        $staff = Staff::where('staff_status', 'Aktif')->get();
        $room = Room::all();

        return view('admin.exam-quiz.exam.edit', compact('title', 'activeMenu', 'exam', 'subject', 'exam_category', 'staff', 'room'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_exam)
    {
        $messages = [
            'name.required' => 'Maaf, Nama ujian tidak boleh kosong.',
            'id_subject.required' => 'Maaf, Mata pelajaran tidak boleh kosong.',
            'id_exam_category.required' => 'Maaf, Kategori ujian tidak boleh kosong.',
            'exam_date.required' => 'Maaf, Tanggal ujian tidak boleh kosong.',
            'start_time.required' => 'Maaf, Waktu mulai tidak boleh kosong.',
            'end_time.required' => 'Maaf, Waktu selesai tidak boleh kosong.',
            'id_room.required' => 'Maaf, Nama Ruangan tidak boleh kosong.',
            'supervisor.required' => 'Maaf, Nama pengawas tidak boleh kosong.',
            'corrector.required' => 'Maaf, Nama pengoreksi tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'note.required' => 'Maaf, Catatan tidak boleh kosong.',
        ];

        $validate_exam = $request->validate([
            'name' => 'required', // 1
            'id_subject' => 'required', // 2
            'id_exam_category' => 'required', // 3
            'exam_date' => 'required', // 4
            'start_time' => 'required', // 5
            'end_time' => 'required', // 6
            'id_room' => 'required', // 7
            'supervisor' => 'required', // 8
            'corrector' => 'required', // 9
            'score_show' => 'nullable', // 10
            'status' => 'required', // 11
            'note' => 'required', // 12
        ], $messages);

        if ($request->score_show == 1) {
            $validate_exam['score_show'] = 1;
        } else {
            $validate_exam['score_show'] = 0;
        }

        $exam = Exam::find(Crypt::decrypt($id_exam));
        $exam->update($validate_exam);

        return redirect('/ujian-quiz')->with('update', 'Data Ujian/Quiz Berhasil Di Ubah.');
    }

    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_exam)
    {
        $title = "Hapus Ujian/Quiz";
        $activeMenu = $this->activeMenu;

        $exam = Exam::find(Crypt::decrypt($id_exam));

        return view('admin.exam-quiz.exam.delete', compact('title', 'activeMenu', 'exam'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_exam)
    {
        $exam = Exam::find(Crypt::decrypt($id_exam));
        $exam->delete();

        return redirect('/ujian-quiz')->with('success', 'Data Ujian/Quiz Berhasil Di Hapus.');
    }
}
