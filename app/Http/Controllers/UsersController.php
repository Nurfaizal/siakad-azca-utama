<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $activeMenu = "profile";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Profile Pengguna";
        $activeMenu = $this->activeMenu;
        return view('admin.profile.index', compact('title', 'activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_user)
    {
        $title = "Ubah Password";
        $activeMenu = $this->activeMenu;

        $user = User::find(Crypt::decrypt($id_user));

        return view('admin.profile.edit', compact('title', 'activeMenu', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_user)
    {
        $messages = [
            'old_password.required' => 'Maaf, Password tidak boleh kosong.',
            'password.required' => 'Maaf, Password Baru tidak boleh kosong.',
            'konfir_password.required' => 'Maaf, Konfirmasi Password tidak boleh kosong.',
            'min' => 'Maaf, :attribute harus minimal :min karakter.',
            'konfir_password.min' => 'Maaf, konfirmasi password harus minimal :min karakter.',
            'password.same' => 'Maaf, Password Harus Sama Dengan Konfirmasi Password.',
        ];

        $request->validate([
            'old_password' => 'required',
            'konfir_password' => 'min:6|required',
            'password' => 'min:6|same:konfir_password|required',
        ], $messages);

        $getPassword = User::find(Crypt::decrypt($id_user));

        if (Hash::check($request->old_password, $getPassword->password)) {
            $user = User::find(Crypt::decrypt($id_user));
            $user->password = Hash::make($request->password);
            $user->save();
        } else if (!Hash::check($request->old_password, $getPassword->password)) {
            return back()->withErrors([
                'old_password' => ['Maaf, Password Tidak Cocok Dengan Password Lama.']
            ]);
        }

        return redirect('/profile')->with('update', 'Password Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_user)
    {
        //
    }
}
