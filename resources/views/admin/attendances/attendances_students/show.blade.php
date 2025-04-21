@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6 mb-10">

        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Jadwal Mata
                    Pelajaran</h1>
            </div>
            <div class="flex">
                <a href="/absensi-siswa"
                    class="ms-2 rounded-l-lg bg-red-100 px-3 py-2 font-semibold text-red-700 duration-150 ease-linear hover:bg-red-200"><i
                        class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
                <a href="/absensi-siswa/create/{{ Crypt::encrypt($attendance->id_schedule) }}">
                    <button
                        class="h-10 min-w-28 rounded-r-lg bg-green-100 px-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
                            class="bi bi-plus-lg pe-1"></i>
                        Buat Absensi</button>
                </a>
            </div>
        </div>
        <div class="body mt-5">
            <table cellpadding="10">
                <tr>
                    <td class="text-slate-700 font-light" width="150">Mata Pelajaran</td>
                    <td class="text-slate-700 font-light" width="20">:</td>
                    <td class="text-slate-700 font-light">{{ $attendance->subject->name }}</td>
                </tr>
                <tr>
                    <td class="text-slate-700 font-light">Pengajar</td>
                    <td class="text-slate-700 font-light">:</td>
                    <td class="text-slate-700 font-light">{{ $attendance->staff->name }}</td>
                </tr>
                <tr>
                    <td class="text-slate-700 font-light">Kelas</td>
                    <td class="text-slate-700 font-light">:</td>
                    <td class="text-slate-700 font-light">{{ $attendance->class->name }}</td>
                </tr>
            </table>
            <table id="pagination-table" class="w-full">
                <thead>
                    <tr>
                        <th class="border" style="width: 15px !important;">
                            <div class="flex h-full items-center justify-center">No</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Pembelajaran</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Hari/Tanggal</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam Pelajaran</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Check In</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Check Out</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Dibuat</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center justify-center">Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendance->attendance_students as $attend)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">1</td>
                            <td class="capitalize">{{ $attend->mode == 'offline' ? 'Luring' : 'Daring' }}
                                ({{ $attend->mode }})
                            </td>
                            <td>{{ \Carbon\Carbon::parse($attend->date)->translatedFormat('l') }} / {{ $attend->date }}</td>
                            <td>{{ $attendance->start_time }} - {{ $attendance->end_time }}</td>
                            <td>{{ $attend->check_in }}</td>
                            <td>{{ $attend->check_out }}</td>
                            <td>{{ $attend->created_by }}</td>
                            <td class="flex justify-center gap-2">
                                @if (!$attend->check_out)
                                    <a href="/absensi-siswa/{{ Crypt::encrypt($attend->id_attendance_student) }}/checkout"><i
                                            class="bi bi-box-arrow-right text-lg text-red-600 hover:text-red-900"></i></a>
                                @else
                                    <a href="/absensi-siswa/{{ Crypt::encrypt($attend->id_attendance_student) }}/edit"><i
                                            class="bi bi-pencil-square text-lg text-green-600 hover:text-green-900"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6 mb-5">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-calendar-week pe-2"></i> Rekap Kehadiran</h1>
            </div>
            <div class="flex">
            </div>
        </div>
        <div class="body mt-5">

            <table id="pagination-table-100" class="w-full">
                <thead>
                    <tr>
                        <th class="border" style="width: 15px !important;">
                            <div class="flex h-full items-center justify-center">No</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Nama</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Nis</div>
                        </th>
                        @foreach ($recaps as $index => $rec)
                            @foreach ($rec['kehadiran'] as $val)
                                <th class="border">
                                    <div class="flex h-full items-center justify-center">Pertemuan {{ $loop->iteration }}
                                    </div>
                                </th>
                            @endforeach
                        @break
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($recaps as $index => $rec)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rec['name'] }}</td>
                        <td>{{ $rec['nis'] }}</td>

                        @foreach ($rec['kehadiran'] as $val)
                            <td class="text-center">
                                <h1>
                                    @if ($val == 'hadir')
                                        <i class="bi bi-check-circle-fill text-green-600"></i>
                                    @elseif ($val == 'sakit')
                                        <i class="bi bi-info-circle-fill text-sky-600"></i>
                                    @elseif ($val == 'izin')
                                        <i class="bi bi-exclamation-circle-fill text-orange-600"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-red-600"></i>
                                    @endif
                                </h1>
                            </td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 my-10 gap-4">
    <div>
        <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-app-indicator pe-2"></i> Keterangan
                    Status
                </h1>
            </div>
            <div class="body mt-5">
                <table class="tables mt-5 w-full">
                    <tr>
                        <td width="40"><i class="bi bi-check-circle-fill text-green-600"></i></td>
                        <td width="150" class="text-sm">Hadir</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-info-circle-fill text-sky-600"></i></td>
                        <td class="text-sm">Sakit</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-exclamation-circle-fill text-orange-600"></i></td>
                        <td class="text-sm">Izin</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-x-circle-fill text-red-600"></i></td>
                        <td class="text-sm">Alpha</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6 col-span-1 lg:col-span-2">
        <div>
            <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-pie-chart-fill pe-2"></i> Grafik Kehadiran
            </h1>
        </div>
        <div class="body mt-5">
            <div style="width: 100%; max-width: 500px; margin: auto;">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const ctx = document.getElementById('attendanceChart').getContext('2d');

    const attendanceChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Hadir', 'Alpha', 'Izin', 'Sakit'],
            datasets: [{
                label: 'Jumlah Kehadiran Siswa',
                data: [
                    {{ $totalStatus['hadir'] ?? 0 }},
                    {{ $totalStatus['alpha'] ?? 0 }},
                    {{ $totalStatus['izin'] ?? 0 }},
                    {{ $totalStatus['sakit'] ?? 0 }}
                ],
                backgroundColor: [
                    '#4ade80', // green
                    '#f87171', // red
                    '#fb923c', // orange
                    '#60a5fa' // blue
                ],
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 16,
                        color: '#333',
                        padding: 15,
                        font: {
                            size: 14,
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1f2937',
                    titleFont: {
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 10,
                    cornerRadius: 4,
                    callbacks: {
                        label: function(context) {
                            const label = context.chart.data.labels[context.dataIndex] || '';
                            const value = context.raw || 0;
                            return label + ': ' + value;
                        }

                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        display: false
                    }
                },
            },
            layout: {
                padding: 20
            },
            animation: {
                animateRotate: true,
                duration: 1000,
                easing: 'easeOutBounce'
            },
        }
    });
</script>


@if (session('success'))
    <script>
        Swal.fire({
            title: "Sukses!",
            text: "{{ session('success') }}!",
            icon: "success"
        });
    </script>
@endif

@if (session('update'))
    <script>
        Swal.fire({
            title: "Sukses!",
            text: "{{ session('update') }}!",
            icon: "info"
        });
    </script>
@endif
@endsection
