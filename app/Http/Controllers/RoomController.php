<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\Room;

class RoomController extends Controller
{

    public $activeMenu = "exam";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Ruangan";
        $activeMenu = $this->activeMenu;

        $room =  Room::all();

        return view('admin.exam-quiz.room.index', compact('title', 'activeMenu', 'room'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Ruangan";
        $activeMenu = $this->activeMenu;

        return view('admin.exam-quiz.room.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Ruangan tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_room = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        Room::create($validate_room);

        return redirect('/ruangan')->with('success', 'Data Ruangan Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_room)
    {
        $title = "Edit Ruangan";
        $activeMenu = $this->activeMenu;

        $room = Room::find(Crypt::decrypt($id_room));

        return view('admin.exam-quiz.room.edit', compact('title', 'activeMenu', 'room'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_room)
    {
        $messages = [
            'name.required' => 'Maaf, Nama Ruangan tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
        ];

        $validate_room = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ], $messages);

        $room = Room::find(Crypt::decrypt($id_room));
        $room->update($validate_room);

        return redirect('/ruangan')->with('update', 'Data Ruangan Berhasil Di Ubah.');
    }


    /**
     * Show the page for deleting the specified resource.
     */
    public function delete($id_room)
    {
        $title = "Hapus Ruangan";
        $activeMenu = $this->activeMenu;

        $room = Room::find(Crypt::decrypt($id_room));

        return view('admin.exam-quiz.room.delete', compact('title', 'activeMenu', 'room'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_room)
    {
        $room = Room::find(Crypt::decrypt($id_room));
        $room->delete();

        return redirect('/ruangan')->with('success', 'Data Ruangan Berhasil Di Hapus.');
    }
}
