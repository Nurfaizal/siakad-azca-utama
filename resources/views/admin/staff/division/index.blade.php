@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Divisi</h1>
            </div>
            <div class="flex">
                <a href="/divisi/create">
                    <button class="h-10 min-w-28 rounded-l-lg bg-green-100 px-3 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-plus-lg pe-1"></i>
                        Tambah</button>
                </a>
                <a href="/penetapan-jam-personal">
                    <button class="h-10 min-w-28 rounded-r-lg bg-orange-100 px-3 font-semibold text-orange-700 duration-150 ease-linear hover:bg-orange-200"><i class="bi bi-calendar-week pe-1"></i> Penetapan Jam Masuk Personal</button>
                </a>
            </div>
        </div>
        <div class="body">
            <table id="pagination-table" class="w-full">
                <thead>
                    <tr>
                        <th class="border" style="width: 15px !important;">
                            <div class="flex h-full items-center justify-center">No</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Divisi</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam Masuk</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Aksi</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($division as $d)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->time_in }} - {{ $d->time_out }}</td>
                            <td class="flex justify-center gap-2">
                                <a href="/divisi/{{ Crypt::encrypt($d->id_division) }}/edit"><i class="bi bi-pencil-square mr-3 text-lg text-green-600 hover:text-green-900"></i></a>
                                <a href="/divisi/{{ Crypt::encrypt($d->id_division) }}/delete"><i class="bi bi-trash text-lg text-green-600 hover:text-green-900"></i></a>
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
