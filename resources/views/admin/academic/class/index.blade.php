@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Data Kelas</h1>
            </div>
            <div class="flex">
                <button
                    class="h-10 min-w-28 rounded-l-lg bg-violet-100 font-semibold text-violet-700 duration-150 ease-linear hover:bg-violet-200"><i
                        class="bi bi-journal-arrow-down pe-1"></i>
                    Ekspor</button>
                <a href="/kelas/create">
                    <button
                        class="h-10 min-w-28 rounded-r-lg bg-green-100 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
                            class="bi bi-plus-lg pe-1"></i>
                        Tambah</button>
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
                            <div class="flex h-full items-center">Kelas</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Wali Kelas</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam Masuk</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Status</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Aksi</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $c)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->staff->name }}</td>
                            <td>{{ $c->time_in }} - {{ $c->time_out }}</td>
                            <td>
                                <center>
                                    <i class=" bi bi-{{ $c->status == 'Aktif' ? 'check-lg' : 'x-lg' }}"></i>
                                </center>
                            </td>
                            <td class="text-center">
                                <a href="/kelas/{{ Crypt::encrypt($c->id_class) }}">
                                    <i class="bi bi-eye mr-3 text-lg text-green-600 hover:text-green-900"></i>
                                </a>
                                <a href="/kelas/{{ Crypt::encrypt($c->id_class) }}/edit">
                                    <i class="bi bi-pencil-square mr-3 text-lg text-green-600 hover:text-green-900"></i>
                                </a>
                                <a href="/kelas/{{ Crypt::encrypt($c->id_class) }}/delete">
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
