<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\GpsLocation;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class AttendancesController extends Controller
{
    public $activeMenu = "attendance";

    public function index()
    {
        $activeMenu = $this->activeMenu;
        $title = "Lokasi Absensi GPS";
        $attendances = Attendance::where('id_user', Auth::user()->id_user)->get();
        $attendanceToday = $attendances->filter(function ($attendance) {
            return Carbon::parse($attendance->created_at)->isToday();
        })->first();
        $gpsLocation = GpsLocation::where('status', 'Aktif')->first();
        if (!$gpsLocation) {
            return redirect()->back();
        }
        return view('admin.attendances.attendances.index', compact('activeMenu', 'title', 'gpsLocation', 'attendances', 'attendanceToday'));
    }

    public function reports()
    {
        $activeMenu = $this->activeMenu;
        $title = "Laporan Absensi";
        $attendances = Attendance::with(['user', 'gpsLocation'])->latest()->get();
        $attendanceToday = $attendances->filter(function ($attendance) {
            return Carbon::parse($attendance->created_at)->isToday();
        })->first();
        $gpsLocation = GpsLocation::where('status', 'Aktif')->first();
        if (!$gpsLocation) {
            return redirect()->back();
        }
        return view('admin.attendances.attendance_reports.index', compact('activeMenu', 'title', 'gpsLocation', 'attendances', 'attendanceToday'));
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
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // in meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance; // dalam meter
    }


    public function store(Request $request)
    {
        $alreadyCheckedIn = Attendance::whereDate('created_at', now()->toDateString())
            ->where('id_user', Auth::user()->id_user)
            ->exists();

        if ($alreadyCheckedIn) {
            return redirect()->back()->with('error', 'Kamu sudah melakukan check-in hari ini.');
        }

        $reqValAtt = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:hadir,izin,sakit',
            'latitude' => ($request->status == 'hadir') ? 'required|numeric|between:-90,90' : 'nullable|numeric|between:-90,90',
            'longitude' => ($request->status == 'hadir') ? 'required|numeric|between:-180,180' : 'nullable|numeric|between:-180,180',
        ]);

        $reqValAtt['id_user'] = Auth::user()->id_user;
        $reqValAtt['check_in'] = now()->format('H:i:s');
        $reqValAtt['check_out'] = ($request->status == 'hadir') ? null : now()->format('H:i:s');
        $reqValAtt['description'] = $request->description ?? null;
        $gpsLocation = GpsLocation::where('status', 'Aktif')->first();
        $reqValAtt['id_gps_location'] = $gpsLocation->id;

        $today = now()->locale('id')->isoFormat('dddd'); // hasil: "Senin", "Selasa", dst
        $allowedDays = $gpsLocation?->days->pluck('day')->toArray() ?? [];

        if (!in_array($today, $allowedDays)) {
            return redirect()->back()->with('error', "Hari ini ($today) tidak termasuk hari absen yang diizinkan.");
        }

        if ($gpsLocation) {
            $distance = $this->calculateDistance(
                $request->latitude,
                $request->longitude,
                $gpsLocation->latitude,
                $gpsLocation->longitude
            );

            // Contoh validasi: hanya boleh absen jika dalam radius 100 meter
            if ($distance > $gpsLocation->distance && $reqValAtt['status'] == 'hadir') {
                return redirect()->back()->with('error', 'Lokasi Anda terlalu jauh dari titik absen!');
            }

            if ($request->file('image') != null) {
                $file = $request->file('image');
                $filename = time() . "-" . $file->getClientOriginalName();

                Gdrive::put('attendances-location' . '/' . $filename, $file);

                $imagePath = $filename;
            } else {
                $imagePath = null;
            }

            $reqValAtt['image'] = $imagePath;

            Attendance::create($reqValAtt);

            return redirect()->back()->with('success', 'Berhasil Absen Hari Ini!');
        }
    }

    public function checkout()
    {
        $alreadyCheckedIn = Attendance::whereDate('created_at', now()->toDateString())
            ->where('id_user', Auth::user()->id_user)
            ->whereNotNull('check_in')
            ->first();

        $alreadyCheckedOut = Attendance::whereDate('created_at', now()->toDateString())
            ->where('id_user', Auth::user()->id_user)
            ->whereNotNull('check_out')
            ->exists();
        if (!$alreadyCheckedIn) {
            return redirect()->back()->with('error', 'Kamu belum melakukan check-in hari ini.');
        }
        if ($alreadyCheckedOut) {
            return redirect()->back()->with('error', 'Kamu sudah melakukan check-out hari ini.');
        }

        $alreadyCheckedIn::query()->update(['check_out' => now()->format('H:i:s')]);
        return redirect()->back()->with('success', 'Berhasil Absen Keluar Hari Ini!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
