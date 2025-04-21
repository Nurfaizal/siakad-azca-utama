@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">

        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Catatan Guru & Staff</h1>
            </div>
            <div class="flex">
                <a href="/catatan-staff/create">
                    <button class="h-10 min-w-28 rounded-lg bg-green-100 px-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-plus-lg pe-1"></i>
                        Tambah Catatan</button>
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
                            <div class="flex h-full items-center">NIP</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Nama Lengkap</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center justify-center">Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staff_note as $sn)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td>{{ $sn->staff->nip }}</td>
                            <td>{{ $sn->staff->name }}</td>
                            <td class="flex justify-center gap-2">
                                <a href="/catatan-staff/{{ Crypt::encrypt($sn->id_staff_note) }}"><i class="bi bi-eye mr-3 text-lg text-green-600 hover:text-green-900"></i></a>
                                <a href="/catatan-staff/{{ Crypt::encrypt($sn->id_staff_note) }}/edit"><i class="bi bi-pencil-square mr-3 text-lg text-green-600 hover:text-green-900"></i></a>
                                <a href="/catatan-staff/{{ Crypt::encrypt($sn->id_staff_note) }}/delete"><i class="bi bi-trash text-lg text-green-600 hover:text-green-900"></i></a>
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
