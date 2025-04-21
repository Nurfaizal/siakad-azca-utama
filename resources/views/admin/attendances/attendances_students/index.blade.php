@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">

        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Abensi Mata
                    Pelajaran</h1>
            </div>
            <div class="flex">
            </div>
        </div>
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
                            <div class="flex h-full items-center text-wrap w-20 text-center">Total Pertemuan</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Link</div>
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
                            <td class="text-center">{{ count($schedule->attendance_students) }}</td>
                            <td>{{ $schedule->link ?? '-' }}</td>
                            <td class="flex justify-center gap-2">
                                <a href="/absensi-siswa/{{ Crypt::encrypt($schedule->id_schedule) }}"><i
                                        class="bi bi-calendar-check text-lg text-green-600 hover:text-green-900"></i></a>

                            </td>
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
