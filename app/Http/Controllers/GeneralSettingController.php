<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\GeneralSetting;
use App\Models\SchoolYear;

class GeneralSettingController extends Controller
{

    public $activeMenu = "setting";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_general_setting)
    {
        //
    }


    public function profil_sekolah()
    {
        $title = "Edit Pengaturan Umum";
        $activeMenu = $this->activeMenu;

        $general = GeneralSetting::where('id_general_setting', 1)->first();
        $school_year = SchoolYear::where('status', 'Aktif')->get();

        return view('admin.general.edit', compact('title', 'activeMenu', 'general', 'school_year'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_general_setting)
    {
        $messages = [
            'name.required' => 'Maaf, Nama sekolah tidak boleh kosong.', // 1
            'npsn.required' => 'Maaf, npsn tidak boleh kosong.', // 2
            'education_form.required' => 'Maaf, Bentuk pendidikan tidak boleh kosong.', // 3
            'school_status.required' => 'Maaf, Status Sekolah tidak boleh kosong.', // 4
            'ownership_status.required' => 'Maaf, Status kepemilikan tidak boleh kosong.', // 5
            'id_year.required' => 'Maaf, Tahun ajaran tidak boleh kosong.', // 6
            'neighborhood.required' => 'Maaf, Kelurahan/desa tidak boleh kosong.', // 7
            'district.required' => 'Maaf, Kabupaten/kota tidak boleh kosong.', // 8
            'province.required' => 'Maaf, Provinsi tidak boleh kosong.', // 9
            'pos_code.required' => 'Maaf, Kode pos tidak boleh kosong.', // 10
            'address.required' => 'Maaf, Alamat tidak boleh kosong.', // 11
            'principal.required' => 'Maaf, Nama kepala sekolah tidak boleh kosong.', // 16
            'school_day.required' => 'Maaf, Hari sekolah tidak boleh kosong.', // 19
            'logo.required' => 'Maaf, Logo sekolah tidak boleh kosong.', // 22
        ];

        $validate_general = $request->validate([
            'name' => 'required', // 1
            'npsn' => 'required', // 2
            'education_form' => 'required', // 3
            'school_status' => 'required', // 4
            'ownership_status' => 'required', // 5
            'id_year' => 'required', // 6
            'neighborhood' => 'required', // 7
            'district' => 'required', // 8
            'province' => 'required', // 9
            'pos_code' => 'required', // 10
            'address' => 'required', // 11
            'phone' => 'nullable', // 12 /////////////////////
            'fax' => 'nullable', // 13 //////////////////////
            'email' => 'nullable', // 14 ////////////////////
            'website' => 'nullable', // 15 /////////////////
            'principal' => 'required', // 16
            'principal_nip' => 'nullable', // 17 //////////////////
            'administration_head' => 'nullable', // 18 /////////////
            'school_day' => 'required', // 19
            'vision' => 'nullable', // 20 ////////////////
            'mission' => 'nullable', // 21 ///////////////
            'logo' => 'nullable', // 22
        ], $messages);

        $general = GeneralSetting::find(Crypt::decrypt($id_general_setting));

        if ($request->file('logo') != null) {
            $file = $request->file('logo');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::put('Foto-Logo' . '/' . $filename, $file);

            $validate_general['logo'] = $filename;
        } else {
            $validate_general['logo'] = $general->logo;
        }

        $general->update($validate_general);

        return redirect('/pengaturan-umum/profil-sekolah')->with('update', 'Data Pengaturan Umum Berhasil Di Ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
