<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Guardian;
use App\Models\Level;
use App\Models\Parents;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class StudentController extends Controller
{

    public $activeMenu = "students";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Siswa";
        $activeMenu = $this->activeMenu;

        $students =  Student::whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->get();
        return view('admin.students.students.index', compact('title', 'activeMenu', 'students'));
    }

    public function inActive()
    {
        $title = "Daftar Siswa Tidak Aktif";
        $activeMenu = $this->activeMenu;

        $students = Student::whereHas('user', function ($query) {
            $query->where('status', 'Non-Aktif');
        })->get();
        return view('admin.students.students.inActive', compact('title', 'activeMenu', 'students'));
    }

    public function activate($id_student)
    {
        $student = Student::find(Crypt::decrypt($id_student));

        $student->user->update([
            'status' => 'Aktif'
        ]);

        $guardian = Guardian::where('id_student', Crypt::decrypt($id_student))->first();
        $guardian->user->update([
            'status' => 'Aktif'
        ]);


        return redirect('/siswa/non-aktif')->with('success', 'Berhasil Mengaktifkan Siswa');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Data Siswa";
        $activeMenu = $this->activeMenu;

        $classes = Classes::all();
        $religions = Religion::all();

        return view('admin.students.students.create', compact('title', 'activeMenu', 'classes', 'religions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        DB::beginTransaction();

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                $reqValUser = $request->validate([
                    'username' => 'required|unique:user',
                    'email' => 'required|email|unique:user',
                    "status" => "required|in:Aktif,Non-Aktif",
                    'password' => 'required|min:6',
                ]);

                $request->validate([
                    'guardian_username' => 'required|unique:user,username',
                    'guardian_email' => 'required|email|unique:user,email',
                    'guardian_password' => 'required|min:6',
                ]);

                $reqValUser['password'] = Hash::make($reqValUser['password']);
                $user = User::create($reqValUser);
            }

            $reqValStudent = $request->validate([
                "id_class" => "required|integer",
                "nisn" => "nullable|integer",
                "nis" => "required|integer|unique:student,nis",
                "name" => "required",
                "address" => "required",
                "place_birth" => "required",
                "birth_date" => "required|date",
                "gender" => "required",
                "family_status" => "required",
                "child_order" => "required",
                "phone" => "required|unique:student,phone",
                "id_religion" => "required",
                "study_program" => "nullable",
                "prev_school" => "nullable",
                "image" => "mimes:jpg,png|max:2048",
                "receive_date" => "required|date",
                "graduation_date" => "nullable|date",
            ]);

            if ($request->file('image') != null) {
                $file = $request->file('image');
                $filename = time() . "-" . $file->getClientOriginalName();

                Gdrive::put('Foto-Siswa' . '/' . $filename, $file);
                $imagePath = $filename;
            } else {
                $imagePath = null;
            }

            $reqValStudent['image'] = $imagePath;
            $reqValStudent['id_user'] = $user->id_user;
            $student = Student::create($reqValStudent);

            $reqValParent = $request->validate([
                'father_name' => 'nullable',
                'father_phone' => 'nullable',
                'father_job' => 'nullable',
                'father_address' => 'nullable',
                'mother_name' => 'nullable',
                'mother_phone' => 'nullable',
                'mother_job' => 'nullable',
                'mother_address' => 'nullable',
            ]);

            $reqValParent['id_student'] = $student->id_student;
            Parents::create($reqValParent);

            $guardianUser = User::create([
                'username' => $request->guardian_username,
                'email' => $request->guardian_email,
                'status' => $request->status,
                'password' => Hash::make($request->guardian_password),
            ]);

            $reqValGuardian = $request->validate([
                'guardian_name' => 'required',
                'guardian_phone' => 'required',
                'alt_phone' => 'nullable',
                'guardian_job' => 'required',
                'guardian_address' => 'required',
            ]);

            $reqValGuardian['id_student'] = $student->id_student;
            $reqValGuardian['id_user'] = $guardianUser->id_user;

            Guardian::create($reqValGuardian);

            Level::create([
                'id_user' => $user->id_user,
                'level' => 'siswa'
            ]);

            Level::create([
                'id_user' => $guardianUser->id_user,
                'level' => 'wali'
            ]);

            DB::commit();

            return redirect('/siswa')->with('success', 'Berhasil Menambah Siswa Baru');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id_student)
    {
        $title = "Detail Data Siswa";
        $activeMenu = $this->activeMenu;
        $student = Student::where('id_student', Crypt::decrypt($id_student))->first();
        $selectedLevels = Level::where('id_user', $student->user->id_user)->pluck('level')->toArray();
        $guardian = Guardian::with('user')->where('id_student', Crypt::decrypt($id_student))->first();
        return view('admin.students.students.show', compact('title', 'activeMenu', 'student', 'guardian', 'selectedLevels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Ubah Data Siswa";
        $activeMenu = $this->activeMenu;

        $student =  Student::with(['religion', 'parent', 'guardian', 'classes', 'user'])->where('id_student', Crypt::decrypt($id))->first();
        $classes = Classes::all();
        $religions = Religion::all();


        return view('admin.students.students.edit', compact('title', 'activeMenu', 'student', 'religions', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::find(Crypt::decrypt($id));
        $user = User::find($student->id_user);
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            "status" => "required|in:Aktif,Non-Aktif",
            'password' => $request->password != null ? 'required|min:6' : 'nullable',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status,
            'password' => $request->password != null ? Hash::make($request->password) : $user->password,
        ]);

        $reqValStudent = $request->validate([
            "id_class" => "required|integer",
            "nisn" => "nullable|integer",
            "nis" => $student->nis != $request->nis ? "required|integer|unique:student,nis" : "required|integer",
            "name" => "required",
            "address" => "required",
            "place_birth" => "required",
            "birth_date" => "required|date",
            "gender" => "required",
            "family_status" => "required",
            "child_order" => "required",
            "phone" => $student->phone != $request->phone ? "required|unique:student,phone" : "required",
            "id_religion" => "required",
            "study_program" => "nullable",
            "prev_school" => "nullable",
            "image" => "nullable|mimes:jpg,png|max:2048",
            "receive_date" => "required|date",
            "graduation_date" => "nullable|date",
        ]);

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::delete('Foto-Siswa' . '/' . $student->image);
            Gdrive::put('Foto-Siswa' . '/' . $filename, $file);

            $imagePath = $filename;
        } else {
            $imagePath = $student->image;
        }

        $reqValStudent['image'] = $imagePath;
        $student->update($reqValStudent);

        $reqValParent = $request->validate([
            'father_name' => 'nullable',
            'father_phone' => 'nullable',
            'father_job' => 'nullable',
            'father_address' => 'nullable',
            'mother_name' => 'nullable',
            'mother_phone' => 'nullable',
            'mother_job' => 'nullable',
            'mother_address' => 'nullable',
        ]);

        $reqValParent['id_student'] = $student->id_student;

        $parent = Parents::where('id_student', $student->id_student)->first();
        $parent->update($reqValParent);
        return redirect('/siswa')->with('update', 'Berhasil Mengubah Data Siswa');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function delete($id_student)
    {
        $title = "Hapus Data Siswa";
        $activeMenu = $this->activeMenu;

        $students = Student::find(Crypt::decrypt($id_student));

        return view('admin.students.students.delete', compact('title', 'activeMenu', 'students'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_student)
    {
        $students = Student::find(Crypt::decrypt($id_student));
        if ($students->image != null) {
            Gdrive::delete('Foto-Siswa' . '/' . $students->image);
        }
        $students->delete();

        return redirect('/siswa')->with('success', 'Berhasil Menghapus Data Siswa');
    }
}
