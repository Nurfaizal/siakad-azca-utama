<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

use App\Models\Student;
use App\Models\Staff;
use App\Models\Guardian;
use App\Models\AnnouncementNews;

class DashboardController extends Controller
{
    public $title = "Halaman Dashboard";
    public $activeMenu = "dashboard";

    public function dashboard()
    {
        $title = $this->title;
        $activeMenu = $this->activeMenu;

        $student_total = Student::with('user')->whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->count();

        $teacher_total = Staff::with('division')->whereHas('division', function ($query) {
            $query->where('name', 'Guru');
        })->count();

        $staff_total = Staff::with('division')->whereHas('division', function ($query) {
            $query->where('name', 'Staff Lainnya');
        })->count();

        $guardian_total = Guardian::with('user')->whereHas('user', function ($query) {
            $query->where('status', 'Aktif');
        })->count();

        $annoucement_total = AnnouncementNews::where('type', '=', 'Pengumuman')->count();

        $news_total = AnnouncementNews::where('type', '=', 'Berita')->count();



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

            'student_total' => $student_total,
            'teacher_total' => $teacher_total,
            'staff_total' => $staff_total,
            'guardian_total' => $guardian_total,
            'announcement_total' => $annoucement_total,
            'news_total' => $news_total,
        ]);
    }
}
