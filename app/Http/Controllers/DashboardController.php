<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\AnnouncementNews;

class DashboardController extends Controller
{
    public $title = "Halaman Dashboard";
    public $activeMenu = "dashboard";

    public function dashboard()
    {
        $title = $this->title;
        $activeMenu = $this->activeMenu;

        $news = AnnouncementNews::where('status', 'Aktif')->get();

        // Buat array untuk menyimpan foto masing-masing berita
        $newsWithPhotos = [];

        foreach ($news as $n) {
            $foto = null;
            $fileData = null;
            $fileExt = null;

            if (!empty($n->image)) {
                $foto = Gdrive::get('Foto-Berita-Pengumuman' . '/' . $n->image);

                if ($foto) {
                    $fileData = base64_encode($foto->file);
                    $fileExt = $foto->ext;
                }
            }

            $newsWithPhotos[] = [
                'news' => $n,
                'fileData' => $fileData, // Bisa null jika tidak ada foto
                'fileExt' => $fileExt
            ];
        }

        return view('admin.dashboard.index', [
            'title' => $title,
            'activeMenu' => $activeMenu,
            'newsWithPhotos' => $newsWithPhotos,
        ]);
    }
}
