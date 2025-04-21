@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 px-5 py-6 bg-white rounded-lg">

        <div class="flex flex-col items-center justify-between gap-5 pb-5 border-b header md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Siswa Non-Aktif
                </h1>
            </div>
            <div class="flex">
                <button
                    class="h-10 font-semibold duration-150 ease-linear rounded-l-lg min-w-28 bg-violet-100 text-violet-700 hover:bg-violet-200"><i
                        class="bi bi-journal-arrow-down pe-1"></i>
                    Ekspor</button>
                <a href="/siswa/create">
                    <button
                        class="h-10 font-semibold text-green-700 duration-150 ease-linear bg-green-100 rounded-r-lg min-w-28 hover:bg-green-200"><i
                            class="bi bi-plus-lg pe-1"></i>
                        Tambah</button>
                </a>
            </div>
        </div>
        <div class="mt-5 body">
            <table id="pagination-table" class="w-full">
                <thead>
                    <tr>
                        <th class="border" style="width: 15px !important;">
                            <div class="flex items-center justify-center h-full">No</div>
                        </th>
                        <th class="border">
                            <div class="flex items-center h-full">Nama Lengkap</div>
                        </th>
                        <th class="border">
                            <div class="flex items-center h-full">NISN</div>
                        </th>
                        <th class="border">
                            <div class="flex items-center h-full">Nama Wali</div>
                        </th>
                        <th class="border">
                            <div class="flex items-center h-full">Kelas</div>
                        </th>
                        <th class="border">
                            <div class="flex items-center justify-center h-full">Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td class="font-medium text-center text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->guardian->guardian_name }}</td>
                            <td>{{ $student->classes->name }}</td>
                            <td class="flex justify-center gap-2">
                                <form action="/siswa/{{ Crypt::encrypt($student->id_student) }}/activate" method="post">
                                    @method('put')
                                    @csrf
                                    <button>
                                        <i class="text-lg text-green-600 bi bi-check-lg hover:text-green-900"></i>
                                    </button>

                                </form>
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
