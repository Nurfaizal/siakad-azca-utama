@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6 mb-8">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Laporan Absensi</h1>
            </div>
            <div class="flex">
            </div>
        </div>
        <div class="body mt-5">
            <table id="pagination-table-100" class="w-full table-auto border border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-sm font-semibold text-gray-700">
                        <th class="border px-2 py-1">No</th>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Tanggal</th>
                        <th class="border px-2 py-1">Check In</th>
                        <th class="border px-2 py-1">Check Out</th>
                        <th class="border px-2 py-1 text-center">Status</th>
                        <th class="border px-2 py-1">Lokasi</th>
                        <th class="border px-2 py-1">Latitude</th>
                        <th class="border px-2 py-1">Longitude</th>
                        <th class="border px-2 py-1">Foto</th>
                        <th class="border px-2 py-1">Keterangan</th>
                        <th class="border px-2 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr class="text-sm text-gray-700 hover:bg-gray-100">
                            <td class="border px-2 py-1 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-2 py-1">
                                @if ($attendance->user->student)
                                    {{ $attendance->user->student->name }}
                                @elseif ($attendance->user->staff)
                                    {{ $attendance->user->staff->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border px-2 py-1">
                                {{ \Carbon\Carbon::parse($attendance->created_at)->translatedFormat('l, d F Y') }}</td>
                            <td class="border px-2 py-1">
                                @php
                                    $checkInTime = \Carbon\Carbon::parse($attendance->check_in);
                                    $startTime = \Carbon\Carbon::parse(
                                        $attendance->gpsLocation->start_time,
                                    )->addMinutes($attendance->gpsLocation->late_tolerance);
                                    $isLate = $checkInTime->gt($startTime);
                                @endphp
                                <p class="{{ $isLate ? 'text-red-600' : '' }}">
                                    {{ $attendance->check_in }} @if ($isLate)
                                        <i class="bi bi-alarm"></i>
                                    @endif
                                </p>
                            </td>
                            <td class="border px-2 py-1">{{ $attendance->check_out ?? '-' }}</td>
                            <td class="border px-2 py-1 capitalize text-center">
                                <h1>
                                    @if ($attendance->status == 'hadir')
                                        <i class="bi bi-check-circle-fill text-green-600"></i>
                                    @elseif ($attendance->status == 'sakit')
                                        <i class="bi bi-info-circle-fill text-sky-600"></i>
                                    @elseif ($attendance->status == 'izin')
                                        <i class="bi bi-exclamation-circle-fill text-orange-600"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-red-600"></i>
                                    @endif
                                </h1>
                            </td>
                            <td class="border px-2 py-1">{{ $attendance->gpsLocation->name ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $attendance->latitude ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $attendance->longitude ?? '-' }}</td>
                            <td class="border px-2 py-1 flex justify-center">
                                @php
                                    $fileData = null;
                                    $fileExt = null;

                                    if ($attendance->image != null) {
                                        try {
                                            $foto = \Yaza\LaravelGoogleDriveStorage\Gdrive::get(
                                                'attendances-location/' . $attendance->image,
                                            );
                                            if ($foto) {
                                                $fileData = base64_encode($foto->file);
                                                $fileExt = $foto->ext;
                                            }
                                        } catch (\Exception $e) {
                                            \Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
                                        }
                                    }
                                @endphp

                                @if ($fileData && $fileExt)
                                    <img src="data:image/{{ $fileExt }};base64,{{ $fileData }}" alt="Foto Staff"
                                        class="object-cover w-52 h-32 my-2">
                                @endif
                            </td>
                            <td class="border px-2 py-1">{{ $attendance->description ?? '-' }}</td>
                            <td class="border px-2 py-1">
                                @if ($attendance->status == 'hadir')
                                    <a href="https://www.google.com/maps?q={{ $attendance->latitude }},{{ $attendance->longitude }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-700 ease-in duration-150">
                                        <i class="bi bi-pin-map"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="border px-4 py-2 text-center text-gray-500">Belum ada data presensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
