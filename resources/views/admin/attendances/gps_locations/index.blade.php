@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6 mb-8">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Lokasi Absensi</h1>
            </div>
            <div class="flex">
                <a href="/lokasi-gps/create">
                    <button
                        class="h-10 min-w-28 rounded-lg bg-green-100 px-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
                            class="bi bi-plus-lg pe-1"></i>
                        Tambah</button>
                </a>
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
                            <div class="flex h-full items-center">Nama</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jarak</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Alamat</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Deskripsi</div>
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
                    @foreach ($gpsLocations as $loc)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loc->name }}</td>
                            <td>{{ number_format($loc->distance) }}m</td>
                            <td>{{ $loc->start_time }} - {{ $loc->end_time }}</td>
                            <td class="text-wrap">{{ $loc->address }}</td>
                            <td class="text-wrap">{{ $loc->description }}</td>
                            <td><i class="bi bi-{{ $loc->status == 'Aktif' ? 'check' : 'x' }}-lg"></i></td>
                            <td class="text-center flex justify-center gap-3">
                                <a href="/lokasi-gps/{{ Crypt::encrypt($loc->id) }}/edit">
                                    <i class="bi bi-pencil-square text-lg text-green-600 hover:text-green-900"></i>
                                </a>
                                <a href="/lokasi-gps/{{ Crypt::encrypt($loc->id) }}">
                                    <i class="bi bi-trash text-lg text-green-600 hover:text-green-900"></i>
                                </a>
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
