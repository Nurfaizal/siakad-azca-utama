<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Models\AnnouncementNews;

class AnnouncementNewsController extends Controller
{

    public $activeMenu = "announce";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Berita & Pengumuman";
        $activeMenu = $this->activeMenu;

        $news =  AnnouncementNews::all();

        return view('admin.news.index', compact('title', 'activeMenu', 'news'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Berita & Pengumuman";
        $activeMenu = $this->activeMenu;

        return view('admin.news.create', compact('title', 'activeMenu'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'titile.required' => 'Maaf, Judul Berita/Pengumuman tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'type.required' => 'Maaf, Tipe tidak boleh kosong.',
            'short_desc.required' => 'Maaf, Keterangan singkat tidak boleh kosong.',
            'description.required' => 'Maaf, Deskripsi tidak boleh kosong.',
        ];

        $validate_news = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'type' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png|max:2048',
        ], $messages);

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::put('Foto-Berita-Pengumuman' . '/' . $filename, $file);

            $validate_news['image'] = $filename;
        } else {
            $validate_news['image'] = null;
        }

        AnnouncementNews::create($validate_news);

        return redirect('/berita-pengumuman')->with('success', 'Data Berita dan Pengumuman Berhasil Di Tambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_news)
    {
        $title = "Baca Berita & Pengumuman";
        $activeMenu = $this->activeMenu;

        $news = AnnouncementNews::find(Crypt::decrypt($id_news));

        if (!$news || $news->status != 'Aktif') {
            return redirect()->back();
        }

        $foto = null;
        $fileData = null;
        $fileExt = null;

        // Cek apakah news memiliki image
        if (!empty($news->image)) {
            try {
                $foto = Gdrive::get('Foto-Berita-Pengumuman/' . $news->image);
                if ($foto) {
                    $fileData = base64_encode($foto->file);
                    $fileExt = $foto->ext;
                }
            } catch (Exception $e) {
                // Log error jika terjadi masalah saat mengambil gambar dari Gdrive
                Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
            }
        }

        return view('admin.news.read', [
            'fileData' => $fileData, // Bisa null jika tidak ada gambar
            'fileExt' => $fileExt,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'news' => $news,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_news)
    {
        $title = "Edit Berita & Pengumuman";
        $activeMenu = $this->activeMenu;

        $news = AnnouncementNews::find(Crypt::decrypt($id_news));

        $foto = Gdrive::get('Foto-Berita-Pengumuman' . '/' . $news->image);

        return view('admin.news.edit', [
            'fileData' => base64_encode($foto->file), // Encode file agar bisa digunakan dalam HTML
            'fileExt' => $foto->ext,
            'title' => $title,
            'activeMenu' => $activeMenu,
            'news' => $news,

        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_news)
    {
        $messages = [
            'titile.required' => 'Maaf, Judul Berita/Pengumuman tidak boleh kosong.',
            'status.required' => 'Maaf, Status tidak boleh kosong.',
            'type.required' => 'Maaf, Tipe tidak boleh kosong.',
            'short_desc.required' => 'Maaf, Keterangan singkat tidak boleh kosong.',
            'description.required' => 'Maaf, Deskripsi tidak boleh kosong.',
        ];

        $validate_news = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'type' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png|max:2048',
        ], $messages);

        $news = AnnouncementNews::find(Crypt::decrypt($id_news));

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();

            Gdrive::delete('Foto-Berita-Pengumuman' . '/' . $news->image);
            Gdrive::put('Foto-Berita-Pengumuman' . '/' . $filename, $file);

            $validate_news['image'] = $filename;
        } else {
            $validate_news['image'] = $news->image;
        }

        $news->update($validate_news);

        return redirect('/berita-pengumuman')->with('update', 'Data Berita dan Pengumuman Berhasil Di Ubah.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function delete($id_news)
    {
        $title = "Hapus Berita & Pengumuman";
        $activeMenu = $this->activeMenu;

        $news = AnnouncementNews::find(Crypt::decrypt($id_news));

        return view('admin.news.delete', compact('title', 'activeMenu', 'news'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_news)
    {
        $news = AnnouncementNews::find(Crypt::decrypt($id_news));
        if ($news->image != null) {
            Gdrive::delete('Foto-Berita-Pengumuman' . '/' . $news->image);
        }
        $news->delete();

        return redirect('/berita-pengumuman')->with('success', 'Data Berita dan Pengumuman Berhasil Di Hapus.');
    }
}
