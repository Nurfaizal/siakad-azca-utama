<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\GpsLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class GpsLocationsController extends Controller
{
    public $activeMenu = "attendance";

    public function index()
    {
        $activeMenu = $this->activeMenu;
        $title = "Lokasi Absensi GPS";
        $gpsLocations = GpsLocation::all();

        return view('admin.attendances.gps_locations.index', compact('activeMenu', 'title', 'gpsLocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activeMenu = $this->activeMenu;
        $title = "Tambah Lokasi Absensi GPS";
        return view('admin.attendances.gps_locations.create', compact('activeMenu', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $reqVal = $request->validate([
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'late_tolerance' => 'required|numeric',
                'distance' => 'required|numeric',
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'description' => 'nullable|string',
                'start_time' => 'required|date_format:H:i',
                'days' => 'required|array',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);
            $reqVal['status'] = "Non-Aktif";
            $gpsLocation = GpsLocation::create($reqVal);

            foreach ($request->days as $day) {
                $gpsLocation->days()->create([
                    'day' => $day
                ]);
            }

            DB::commit();
            return redirect('/lokasi-gps')->with("success", "Berhasil Menambahkan Lokasi Baru");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $activeMenu = $this->activeMenu;
        $title = "Hapus Lokasi Absensi GPS";
        $id = Crypt::decrypt($id);
        $gpsLocation = GpsLocation::find($id);
        return view('admin.attendances.gps_locations.delete', compact('activeMenu', 'title', 'gpsLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activeMenu = $this->activeMenu;
        $title = "Ubah Lokasi Absensi GPS";
        $id = Crypt::decrypt($id);
        $gpsLocation = GpsLocation::find($id);
        $selectedDays = $gpsLocation->days()->pluck('day')->toArray();
        return view('admin.attendances.gps_locations.edit', compact('activeMenu', 'title', 'gpsLocation', 'selectedDays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        DB::beginTransaction();
        try {
            $reqVal = $request->validate([
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'late_tolerance' => 'required|numeric',
                'distance' => 'required|numeric',
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'description' => 'nullable|string',
                'start_time' => 'required|date_format:H:i',
                'days' => 'required|array',
                'status' => 'required|in:Aktif,Non-Aktif',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            $gpsLocation = GpsLocation::find($id);
            $gpsLocation->update($reqVal);

            // Hapus data lama dari 'days'
            $gpsLocation->days()->delete();

            // Menambahkan data days yang baru
            foreach ($request->days as $day) {
                $gpsLocation->days()->create([
                    'day' => $day
                ]);
            }

            DB::commit();
            return redirect('/lokasi-gps')->with("success", "Berhasil Mengubah Lokasi");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);

        DB::beginTransaction();
        try {
            $gpsLocation = GpsLocation::find($id);

            $gpsLocation->days()->delete();
            $gpsLocation->delete();

            DB::commit();
            return redirect('/lokasi-gps')->with("update", "Berhasil Menghapus Lokasi");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
