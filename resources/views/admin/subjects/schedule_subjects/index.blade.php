@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">

        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Jadwal Mata
                    Pelajaran</h1>
            </div>
            <div class="flex">
                <button class="h-10 min-w-28 rounded-l-lg bg-violet-100 font-semibold text-violet-700 duration-150 ease-linear hover:bg-violet-200"><i class="bi bi-journal-arrow-down pe-1"></i>
                    Ekspor</button>
                <a href="/jadwal-mapel/create">
                    <button class="h-10 min-w-28 rounded-r-lg bg-green-100 px-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-plus-lg pe-1"></i>
                        Tambah</button>
                </a>
            </div>
        </div>

        @php
            $user = Auth::user();
            $level = $user->level->pluck('level')->toArray();
        @endphp

        <div class="body mt-5">
            <table id="pagination-table" class="w-full">
                <thead>
                    <tr>
                        <th class="border" style="width: 15px !important;">
                            <div class="flex h-full items-center justify-center">No</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Mata Pelajaran</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Hari</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Guru</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Kelas</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam Pelajaran</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Lokasi</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Link</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Status</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center justify-center">Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">1</td>
                            <td>{{ $schedule->subject->name }}</td>
                            <td class="capitalize">{{ $schedule->day }}</td>
                            <td>{{ $schedule->staff->name }}</td>
                            <td>{{ $schedule->class->name }}</td>
                            <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                            <td>{{ $schedule->location }}</td>
                            <td>{{ $schedule->link ?? '-' }}</td>
                            <td><i class="bi bi-{{ $schedule->status == 'Aktif' ? 'check' : 'x' }}-lg"></i></td>

                            @if (in_array('admin', $level) || in_array('staff', $level))
                                <td class="flex justify-center gap-2">
                                    <a href="/jadwal-mapel/{{ Crypt::encrypt($schedule->id_schedule) }}/edit"><i class="bi bi-pencil-square text-lg text-green-600 hover:text-green-900"></i></a>
                                    <a href="/jadwal-mapel/{{ Crypt::encrypt($schedule->id_schedule) }}/delete"><i class="bi bi-trash text-lg text-green-600 hover:text-green-900"></i></a>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
