<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentCategoriesController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\SkillProgramController;
use App\Http\Controllers\SemesterTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ExamCategoriesController;
use App\Http\Controllers\SubjectContentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AnnouncementNewsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AttendancesStudentsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ClassMutationController;
use App\Http\Controllers\StaffDivisionController;
use App\Http\Controllers\PersonalEntryHourController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentNoteController;
use App\Http\Controllers\StaffNoteController;
use App\Http\Controllers\DuesGroupController;
use App\Http\Controllers\EDocumentStaffController;
use App\Http\Controllers\EDocumentStudentController;
use App\Http\Controllers\GpsLocationsController;
use App\Http\Controllers\ScheduleSubjectsController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\UsersController;




// Route Untuk Tamu
Route::middleware(['guest'])->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        Route::post('/login/autentikasi', 'autentikasi');
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/lupa-password', 'showLinkRequestForm')->name('password.request');
        Route::post('/lupa-password/submit', 'sendResetLinkEmail')->name('password.email');

        Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
        Route::post('/reset-password/submit', 'reset')->name('password.update');
    });
});




// Route Semua Level
Route::middleware(['auth', 'CekLevel:admin,staff,guru tk,guru sd,guru smp,guru sma,siswa,wali siswa'])->group(function () {

    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

    // Route Profil User
    Route::resource('/profile', UsersController::class);

    // Route Logout
    Route::post('/logout', [LoginController::class, 'logout']);
});




// Route Untuk Level Admin, Staff, Guru TK, Guru SD, Guru SMP, Guru SMA, Siswa
Route::middleware(['auth', 'CekLevel:admin,staff,guru tk,guru sd,guru smp,guru sma,siswa'])->group(function () {

    // Route Absen Lokasi
    Route::post('/absen-lokasi/checkout', [AttendancesController::class, 'checkout']);
    Route::resource('/absen-lokasi', AttendancesController::class);
});




// Route Untuk Level Admin, Staff
Route::middleware(['auth', 'CekLevel:admin,staff'])->group(function () {

    // Route kelas
    Route::get('/kelas/{id_class}/delete', [ClassesController::class, 'delete'])->name('kelas.delete');
    Route::resource('/kelas', ClassesController::class);

    // Route mutasi kelas
    Route::put('/mutasi-kelas', [ClassMutationController::class, 'mutation']);
    Route::resource('/mutasi-kelas', ClassMutationController::class);

    // Route Grup Iuran
    Route::get('/grup-iuran/{id_dues_grup}/delete', [DuesGroupController::class, 'delete'])->name('grup-iuran.delete');
    Route::resource('grup-iuran', DuesGroupController::class);

    // Route Ruangan
    Route::get('/ruangan/{id_room}/delete', [RoomController::class, 'delete'])->name('ruangan.delete');
    Route::resource('ruangan', RoomController::class)->except(['show']);

    // Route Kategori Ujian
    Route::get('/kategori-ujian/{id_exam_category}/delete', [ExamCategoriesController::class, 'delete'])->name('kategori-ujian.delete');
    Route::resource('kategori-ujian', ExamCategoriesController::class)->except(['show']);

    // Route Berita Pengumuman
    Route::get('/berita-pengumuman/{id_news}/delete', [AnnouncementNewsController::class, 'delete'])->name('berita-pengumuman.delete');
    Route::resource('berita-pengumuman', AnnouncementNewsController::class);

    // Route Semester
    Route::get('/semester/{id_semester}/delete', [SemesterController::class, 'delete'])->name('semester.delete');
    Route::resource('semester', SemesterController::class);

    // Route Jenis Semester
    Route::get('/jenis-semester/{id_semester_type}/delete', [SemesterTypeController::class, 'delete'])->name('jenis-semester.delete');
    Route::resource('jenis-semester', SemesterTypeController::class)->except(['show']);

    // Route Jadwal Mapel
    Route::get('/jadwal-mapel/{id_schedule}/delete', [ScheduleSubjectsController::class, 'delete']);
    Route::resource('/jadwal-mapel', ScheduleSubjectsController::class);
});




// Route Untuk Level Admin, Guru TK, Guru SD, Guru SMP, Guru SMA
Route::middleware(['auth', 'CekLevel:admin,staff,guru tk,guru sd,guru smp,guru sma'])->group(function () {

    // Route Siswa
    Route::get('/siswa/non-aktif', [StudentController::class, 'inActive']);
    Route::put('/siswa/{id_student}/activate', [StudentController::class, 'activate']);
    Route::post('/siswa/create', [StudentController::class, 'store']);
    Route::get('/siswa/{id_student}/delete', [StudentController::class, 'delete']);
    Route::resource('/siswa', StudentController::class);

    // Route E-Dokumen Siswa
    Route::put('/download-e-dokumen-siswa', [EDocumentStudentController::class, 'download'])->name('e-dokumen-siswa.download');
    Route::get('/e-dokumen-siswa/{id_e_document_student}/delete', [EDocumentStudentController::class, 'delete'])->name('e-dokumen-siswa.delete');
    Route::resource('e-dokumen-siswa', EDocumentStudentController::class);

    // Route Ujian/Quiz
    Route::get('/ujian-quiz/{id_exam}/question', [ExamController::class, 'createQuestion'])->name('ujian-quiz.delete');
    Route::get('/ujian-quiz/{id_exam}/delete', [ExamController::class, 'delete'])->name('ujian-quiz.delete');
    Route::resource('ujian-quiz', ExamController::class);

    // Route Absensi Siswa
    Route::post('/absensi-siswa/{id_schedule}', [AttendancesStudentsController::class, 'store']);
    Route::put('/absensi-siswa/{id_attendance_student}/checkout', [AttendancesStudentsController::class, 'updateCheckout']);
    Route::get('/absensi-siswa/{id_attendance_student}/checkout', [AttendancesStudentsController::class, 'checkout']);
    Route::get('/absensi-siswa/create/{id_schedule}', [AttendancesStudentsController::class, 'create']);
    Route::resource('/absensi-siswa', AttendancesStudentsController::class);

    // Route Catatan Siswa
    Route::get('/catatan-siswa/{id_student_note}/delete', [StudentNoteController::class, 'delete'])->name('catatan-siswa.delete');
    Route::resource('catatan-siswa', StudentNoteController::class);
});




// Route Untuk Level Admin
Route::middleware(['auth'])->group(function () {

    // Route Kategori-E-Dokumen
    Route::get('/kategori-e-document/{id_category}/delete', [DocumentCategoriesController::class, 'delete'])->name('kategori-e-document.delete');
    Route::resource('kategori-e-document', DocumentCategoriesController::class)->except(['show']);

    // Route Tahun Ajaran
    Route::get('/tahun-ajaran/{id_year}/delete', [SchoolYearController::class, 'delete'])->name('tahun-ajaran.delete');
    Route::resource('tahun-ajaran', SchoolYearController::class)->except(['show']);

    // Route Agama
    Route::get('/agama/{id_religion}/delete', [ReligionController::class, 'delete'])->name('agama.delete');
    Route::resource('agama', ReligionController::class)->except(['show']);

    // Route Program Keahlian
    Route::get('/program-keahlian/{id_skill}/delete', [SkillProgramController::class, 'delete'])->name('program-keahlian.delete');
    Route::resource('program-keahlian', SkillProgramController::class)->except(['show']);

    // Route Muatan Mata Pelajaran
    Route::get('/muatan-mapel/{id_subcontent}/delete', [SubjectContentController::class, 'delete'])->name('muatan-mapel.delete');
    Route::resource('muatan-mapel', SubjectContentController::class)->except(['show']);

    // Route Mata Pelajaran
    Route::get('/mapel/{id_subject}/delete', [SubjectController::class, 'delete'])->name('mapel.delete');
    Route::resource('mapel', SubjectController::class)->except(['show']);

    // Route Divisi
    Route::get('/divisi/{id_division}/delete', [StaffDivisionController::class, 'delete'])->name('divisi.delete');
    Route::resource('divisi', StaffDivisionController::class)->except(['show']);

    // Route Penetapan Jam Masuk Personal
    Route::resource('penetapan-jam-personal', PersonalEntryHourController::class)->only(['index', 'edit', 'update']);

    // Route Staff
    Route::get('/staff/{id_staff}/delete', [StaffController::class, 'delete'])->name('staff.delete');
    Route::get('/staff-non-aktif', [StaffController::class, 'non_active'])->name('staff.non_active');
    Route::resource('staff', StaffController::class);

    // Route gaji staff
    Route::get('/gaji-staff/pembayaran/{id_staff}/{month}/{year}', [SalariesController::class, 'edit']);
    Route::get('/gaji-staff/bayar/{id_staff}', [SalariesController::class, 'pay']);
    Route::post('/gaji-staff/bayar/{id_staff}', [SalariesController::class, 'create']);
    Route::resource('/gaji-staff', SalariesController::class);

    // Route Catatan Staff
    Route::get('/catatan-staff/{id_staff_note}/delete', [StaffNoteController::class, 'delete'])->name('catatan-staff.delete');
    Route::resource('catatan-staff', StaffNoteController::class);

    // Route Grup Iuran
    Route::get('/grup-iuran/{id_dues_grup}/delete', [DuesGroupController::class, 'delete'])->name('grup-iuran.delete');
    Route::resource('grup-iuran', DuesGroupController::class);

    // Route E-Dokumen Staff
    Route::put('/download-e-dokumen-staff', [EDocumentStaffController::class, 'download'])->name('e-dokumen-staff.download');
    Route::get('/e-dokumen-staff/{id_e_document_staff}/delete', [EDocumentStaffController::class, 'delete'])->name('e-dokumen-staff.delete');
    Route::resource('e-dokumen-staff', EDocumentStaffController::class);

    // Route Lokasi GPS
    Route::resource('/lokasi-gps', GpsLocationsController::class);
    Route::get('/laporan-absensi', [AttendancesController::class, 'reports']);
  
    // Route Pengaturan Umum
    

    Route::get('pengaturan-umum/profil-sekolah', [GeneralSettingController::class, 'profil_sekolah'])->name('pengaturan-umum.profil_sekolah');
    Route::resource('/pengaturan-umum', GeneralSettingController::class)->only(['profil_sekolah', 'update']);
});
