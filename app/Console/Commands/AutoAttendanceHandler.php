<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\GpsLocation;
use App\Models\User;
use Illuminate\Console\Command;

class AutoAttendanceHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-attendance-handler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->toDateString();
        $nowTime = now()->format('H:i:s');
        $gpsLocation = GpsLocation::where('status', 'Aktif')->first();

        if (!$gpsLocation) {
            $this->info('Tidak ada lokasi GPS aktif.');
            return;
        }

        // Ambil hari aktif dari relasi atau JSON (tergantung implementasi)
        $hariIni = strtolower(now()->locale('id')->isoFormat('dddd'));
        $hariAktif = $gpsLocation->active_days ?? []; // array ['senin', 'selasa', ...]
        if (!in_array($hariIni, $hariAktif)) {
            $this->info("Hari ini ($hariIni) tidak aktif.");
            return;
        }

        // 1️⃣ Tandai yang tidak absen sebagai Alpha
        $users = User::whereHas('level', function ($q) {
            $q->whereIn('level', ['siswa', 'staff']);
        })->get();

        foreach ($users as $user) {
            $sudahAbsen = Attendance::whereDate('created_at', $today)
                ->where('id_user', $user->id_user)
                ->exists();

            if (!$sudahAbsen) {
                Attendance::create([
                    'id_user' => $user->id_user,
                    'status' => 'alpha',
                    'check_in' => '23:58:00',
                    'check_out' => '23:59:00',
                    'id_gps_location' => $gpsLocation->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->info("User {$user->name} dicatat sebagai Alpha.");
            }
        }

        // 2️⃣ Auto-checkout jika sudah check-in tapi belum check-out
        $checkins = Attendance::whereDate('created_at', $today)
            ->whereNull('check_out')
            ->whereNotNull('check_in')
            ->whereIn('status', ['hadir']) // hanya yang hadir
            ->get();

        foreach ($checkins as $checkin) {
            $checkin->check_out = '23:59:00';
            $checkin->save();

            $this->info("Auto-checkout untuk user ID {$checkin->id_user}");
        }

        $this->info("Auto-handler selesai.");
    }
}
