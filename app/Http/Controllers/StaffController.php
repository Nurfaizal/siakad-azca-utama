<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Models\Staff;
use App\Models\StaffDivision;
use App\Models\PersonalEntryHour;
use App\Models\User;

class StaffController extends Controller
{

    public $activeMenu = "staff";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Guru & Staff";
        $activeMenu = $this->activeMenu;

        $staff = Staff::with('user')->whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->get();

        return view('admin.staff.staff.index', compact('title', 'activeMenu', 'staff'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Guru & Staff";
        $activeMenu = $this->activeMenu;

        $division = StaffDivision::all();

        return view('admin.staff.staff.create', compact('title', 'activeMenu', 'division'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nip.required' => 'Maaf, NIP tidak boleh kosong.',
            'name.required' => 'Maaf, Nama tidak boleh kosong.',
            'username.required' => 'Maaf, Username tidak boleh kosong.',
            'password.required' => 'Maaf, Password tidak boleh kosong.',
            'place_birth.required' => 'Maaf, Tempat Lahir tidak boleh kosong.',
            'birth_date.required' => 'Maaf, Tanggal Lahir tidak boleh kosong.',
            'gender.required' => 'Maaf, Jenis Kelamin tidak boleh kosong.',
            'address.required' => 'Maaf, Alamat tidak boleh kosong.',
            'join_date.required' => 'Maaf, Tanggal Bergabung tidak boleh kosong.',
            'end_date.required' => 'Maaf, Tanggal Berakhir tidak boleh kosong.',
            'no_ktp.required' => 'Maaf, No.KTP tidak boleh kosong.',
            'phone.numeric' => 'Maaf, No.HP harus angka.',
            'phone.required' => 'Maaf, No.HP tidak boleh kosong.',
            'email.required' => 'Maaf, Email tidak boleh kosong.',
            'education.required' => 'Maaf, Pendidikan terakhir tidak boleh kosong.',
            'salary.required' => 'Maaf, Gaji tidak boleh kosong.',
            'id_division.required' => 'Maaf, Divisi tidak boleh kosong.',
            'part.required' => 'Maaf, Bagian tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'card_number.required' => 'Maaf, Nomor kartu tidak boleh kosong.',

            'level.required' => 'Maaf, Tingkat pengguna tidak boleh kosong.',

            'min' => 'Maaf, :attribute harus minimal :min karakter.',
            'konfir_password.min' => 'Maaf, Konfirmasi password harus minimal :min karakter.',
            'password.same' => 'Maaf, Password Harus Sama Dengan Konfirmasi Password.',
            'konfir_password.required' => 'Maaf, Konfirmasi password tidak boleh kosong.'
        ];

        $request->validate([
            'nip' => 'required', // 1
            'name' => 'required', // 2
            'place_birth' => 'required', // 3
            'birth_date' => 'required|date', // 4
            'gender' => 'required', // 5
            'address' => 'required', // 6
            'image' => 'nullable|mimes:jpg,png|max:2048', // 7
            'join_date' => 'required|date', // 8
            'end_date' => 'required|date', // 9
            'no_ktp' => 'required|numeric', // 10
            'phone' => 'required|numeric', // 11
            'education' => 'required', // 12
            'salary' => 'required', // 13
            'id_division' => 'required', // 14
            'part' => 'required', // 15
            'status' => 'required', // 16
            'card_number' => 'required', // 17

            'level' => 'required|array',

            'username' => 'required',
            'email' => 'required|email|unique:user,email', // Pastikan email unik
            'password' => 'required|min:6|same:konfir_password',
            'konfir_password' => 'required|min:6',
        ], $messages);

        $user = User::create([
            'username'     => $request->username,
            'email'     => $request->email,
            'password'     => Hash::make($request->password),
            'status'        => 'Aktif',
        ]);

        foreach ($request->level as $levelName) {
            Level::create([
                'id_user' => $user->id_user,
                'level' => $levelName
            ]);
        }

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::put('Foto-Staff' . '/' . $filename, $file);

            $imagePath = $filename;
        } else {
            $imagePath = null;
        }

        $salary_amount = str_replace('.', '', $request->salary);

        $staff = Staff::create([
            'nip'     => $request->nip, // 1
            'name'     => $request->name, // 2
            'id_user'     => $user->id_user, // 3
            'place_birth'     => $request->place_birth, // 4
            'birth_date'     => $request->birth_date, // 5
            'gender'     => $request->gender, // 6
            'address'     => $request->address, // 7
            'image'      => $imagePath, // 8
            'join_date'      => $request->join_date, // 9
            'end_date'      => $request->end_date, // 10
            'no_ktp'      => $request->no_ktp, // 11
            'phone'      => $request->phone, // 12
            'education'      => $request->education, // 13
            'salary'      => $salary_amount, // 14
            'id_division'      => $request->id_division, // 15
            'status'      => $request->status, // 16
            'part'      => $request->part, // 17
            'card_number'      => $request->card_number, // 18
        ]);

        $division_time = StaffDivision::find($request->id_division);

        // Kode untuk tambah penetapan jam masuk personal ketika pertama kali input data guru & staff
        PersonalEntryHour::create([
            'id_staff'      => $staff->id_staff,
            'monday_in'     => $division_time->time_in,
            'monday_out'    => $division_time->time_out,
            'tuesday_in'    => $division_time->time_in,
            'tuesday_out'   => $division_time->time_out,
            'wednesday_in'  => $division_time->time_in,
            'wednesday_out' => $division_time->time_out,
            'thursday_in'   => $division_time->time_in,
            'thursday_out'  => $division_time->time_out,
            'friday_in'     => $division_time->time_in,
            'friday_out'    => $division_time->time_out,
            'saturday_in'   => $division_time->time_in,
            'saturday_out'  => $division_time->time_out,
        ]);

        return redirect('/staff')->with('success', 'Data Guru dan Staff Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_staff)
    {
        $title = "Detail Guru & Staff";
        $activeMenu = $this->activeMenu;

        $staff = Staff::find(Crypt::decrypt($id_staff));
        $selectedLevels = Level::where('id_user', $staff->user->id_user)->pluck('level')->toArray();

        $foto = null;
        $fileData = null;
        $fileExt = null;

        // Cek apakah news memiliki image
        if (!empty($staff->image)) {
            try {
                $foto = Gdrive::get('Foto-Staff/' . $staff->image);
                if ($foto) {
                    $fileData = base64_encode($foto->file);
                    $fileExt = $foto->ext;
                }
            } catch (Exception $e) {
                // Log error jika terjadi masalah saat mengambil gambar dari Gdrive
                Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
            }
        }

        return view('admin.staff.staff.show', [
            'fileData' => $fileData, // Bisa null jika tidak ada gambar
            'fileExt' => $fileExt,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'staff' => $staff,
            'selectedLevels' => $selectedLevels,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_staff)
    {
        $title = "Edit Guru & Staff";
        $activeMenu = $this->activeMenu;

        $staff = Staff::find(Crypt::decrypt($id_staff));
        $division = StaffDivision::all();
        $selectedLevels = Level::where('id_user', $staff->user->id_user)->pluck('level')->toArray();

        $foto = null;
        $fileData = null;
        $fileExt = null;

        // Cek apakah news memiliki image
        if (!empty($staff->image)) {
            try {
                $foto = Gdrive::get('Foto-Staff/' . $staff->image);
                if ($foto) {
                    $fileData = base64_encode($foto->file);
                    $fileExt = $foto->ext;
                }
            } catch (Exception $e) {
                // Log error jika terjadi masalah saat mengambil gambar dari Gdrive
                Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
            }
        }

        return view('admin.staff.staff.edit', [
            'fileData' => $fileData, // Bisa null jika tidak ada gambar
            'fileExt' => $fileExt,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'staff' => $staff,
            'division' => $division,
            'selectedLevels' => $selectedLevels,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_staff)
    {
        $messages = [
            'nip.required' => 'Maaf, NIP tidak boleh kosong.',
            'name.required' => 'Maaf, Nama tidak boleh kosong.',
            'username.required' => 'Maaf, Username tidak boleh kosong.',
            'place_birth.required' => 'Maaf, Tempat Lahir tidak boleh kosong.',
            'birth_date.required' => 'Maaf, Tanggal Lahir tidak boleh kosong.',
            'gender.required' => 'Maaf, Jenis Kelamin tidak boleh kosong.',
            'address.required' => 'Maaf, Alamat tidak boleh kosong.',
            'join_date.required' => 'Maaf, Tanggal Bergabung tidak boleh kosong.',
            'end_date.required' => 'Maaf, Tanggal Berakhir tidak boleh kosong.',
            'no_ktp.required' => 'Maaf, No.KTP tidak boleh kosong.',
            'phone.numeric' => 'Maaf, No.HP harus angka.',
            'phone.required' => 'Maaf, No.HP tidak boleh kosong.',
            'email.required' => 'Maaf, Email tidak boleh kosong.',
            'education.required' => 'Maaf, Pendidikan terakhir tidak boleh kosong.',
            'salary.required' => 'Maaf, Gaji tidak boleh kosong.',
            'id_division.required' => 'Maaf, Divisi tidak boleh kosong.',
            'part.required' => 'Maaf, Bagian tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'card_number.required' => 'Maaf, Nomor kartu tidak boleh kosong.',

            'level.required' => 'Maaf, Tingkat pengguna tidak boleh kosong.',

            'min' => 'Maaf, :attribute harus minimal :min karakter.',
            'konfir_password.min' => 'Maaf, konfirmasi password harus minimal :min karakter.',
            'password.same' => 'Maaf, Password Harus Sama Dengan Konfirmasi Password.',
        ];

        $request->validate([
            'nip' => 'required', // 1
            'name' => 'required', // 2
            'place_birth' => 'required', // 3
            'birth_date' => 'required|date', // 4
            'gender' => 'required', // 5
            'address' => 'required', // 6
            'image' => 'nullable|mimes:jpg,png|max:2048', // 7
            'join_date' => 'required|date', // 8
            'end_date' => 'required|date', // 9
            'no_ktp' => 'required|numeric', // 10
            'phone' => 'required|numeric', // 11
            'education' => 'required', // 12
            'salary' => 'required', // 13
            'id_division' => 'required', // 14
            'part' => 'required', // 15
            'status' => 'required', // 16
            'card_number' => 'required', // 17

            'level' => 'required|array',

            'username' => 'required',
            'email' => 'required|email', // Pastikan email unik
            'password' => 'nullable|min:6|same:konfir_password',
            'konfir_password' => 'nullable|min:6',
        ], $messages);

        $staff = Staff::find(Crypt::decrypt($id_staff));

        // Cek perubahan status staff
        if ($request->account_status != $staff->user->status) {
            // Jika status staff berubah menjadi Non-Aktif, hapus jam masuk personal
            if ($request->account_status == 'Non-Aktif') {
                PersonalEntryHour::where('id_staff', $staff->id_staff)->delete();
            }
            // Jika status staff berubah menjadi Aktif, tambahkan kembali jam masuk personal
            elseif ($request->account_status == 'Aktif') {
                $division_time = StaffDivision::find($staff->id_division);
                PersonalEntryHour::create([
                    'id_staff'      => $staff->id_staff,
                    'monday_in'     => $division_time->time_in,
                    'monday_out'    => $division_time->time_out,
                    'tuesday_in'    => $division_time->time_in,
                    'tuesday_out'   => $division_time->time_out,
                    'wednesday_in'  => $division_time->time_in,
                    'wednesday_out' => $division_time->time_out,
                    'thursday_in'   => $division_time->time_in,
                    'thursday_out'  => $division_time->time_out,
                    'friday_in'     => $division_time->time_in,
                    'friday_out'    => $division_time->time_out,
                    'saturday_in'   => $division_time->time_in,
                    'saturday_out'  => $division_time->time_out,
                ]);
            }
        }
        // Jika status tidak berubah, maka jam masuk personal tetap sama

        $user = User::find($staff->id_user);

        // Jika Password Di isi
        if ($request->password != null) {
            $user->update([
                'username'     => $request->username,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'status'        => $request->account_status,
            ]);
        } else {
            $user->update([
                'username'     => $request->username,
                'email'     => $request->email,
                'status'        => $request->account_status,
            ]);
        }

        Level::where('id_user', $user->id_user)->delete();

        foreach ($request->level as $levelName) {
            Level::create([
                'id_user' => $user->id_user,
                'level' => $levelName
            ]);
        }

        // Jika Image Di isi
        if ($request->file('image') != null) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::delete('Foto-Staff' . '/' . $staff->image);
            Gdrive::put('Foto-Staff' . '/' . $filename, $file);

            $imagePath = $filename;
        } else {
            $imagePath = $staff->image;
        }

        $salary_amount = str_replace('.', '', $request->salary);

        $staff->update([
            'nip'     => $request->nip, // 1
            'name'     => $request->name, // 2
            'id_user'     => $user->id_user, // 3
            'place_birth'     => $request->place_birth, // 4
            'birth_date'     => $request->birth_date, // 5
            'gender'     => $request->gender, // 6
            'address'     => $request->address, // 7
            'image'      => $imagePath, // 8
            'join_date'      => $request->join_date, // 9
            'end_date'      => $request->end_date, // 10
            'no_ktp'      => $request->no_ktp, // 11
            'phone'      => $request->phone, // 12
            'education'      => $request->education, // 13
            'salary'      => $salary_amount, // 14
            'id_division'      => $request->id_division, // 15
            'status'      => $request->status, // 16
            'part'      => $request->part, // 17
            'card_number'      => $request->card_number, // 18
        ]);

        if ($request->account_status == "Aktif") {
            return redirect('/staff')->with('update', 'Data Guru dan Staff Berhasil Di Ubah.');
        } else {
            return redirect('/staff-non-aktif')->with('update', 'Data Guru dan Staff Berhasil Di Ubah.');
        }
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_staff)
    {
        $title = "Hapus Guru & Staff";
        $activeMenu = $this->activeMenu;

        $staff = Staff::find(Crypt::decrypt($id_staff));

        $foto = null;
        $fileData = null;
        $fileExt = null;

        // Cek apakah news memiliki image
        if (!empty($staff->image)) {
            try {
                $foto = Gdrive::get('Foto-Staff/' . $staff->image);
                if ($foto) {
                    $fileData = base64_encode($foto->file);
                    $fileExt = $foto->ext;
                }
            } catch (Exception $e) {
                // Log error jika terjadi masalah saat mengambil gambar dari Gdrive
                Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
            }
        }

        return view('admin.staff.staff.delete', [
            'fileData' => $fileData, // Bisa null jika tidak ada gambar
            'fileExt' => $fileExt,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'staff' => $staff,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id_staff)
    {
        $staff = Staff::find(Crypt::decrypt($id_staff));
        if ($staff->image != null) {
            Gdrive::delete('Foto-Staff' . '/' . $staff->image);
        }
        $user = User::find($staff->id_user);
        $user->delete();

        if ($request->account_status == "Aktif") {
            return redirect('/staff')->with('success', 'Data Guru dan Staff Berhasil Di Hapus.');
        } else {
            return redirect('/staff-non-aktif')->with('success', 'Data Guru dan Staff Berhasil Di Hapus.');
        }
    }


    // Menampilkan Halaman Staff Non Aktif
    public function non_active()
    {
        $title = "Daftar Non Aktif Guru & Staff";
        $activeMenu = $this->activeMenu;

        $staff = Staff::with('user')->whereHas('user', function ($query) {
            $query->where('status', 'Non-Aktif');
        })->get();

        return view('admin.staff.staff-inactive.index', compact('title', 'activeMenu', 'staff'));
    }
}
