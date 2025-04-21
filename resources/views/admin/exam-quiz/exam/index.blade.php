@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Ujian/Quiz</h1>
            </div>
            <div>
                <a href="/ujian-quiz/create">
                    <button
                        class="ms-2 h-10 min-w-28 rounded-lg bg-green-100 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
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
                            <div class="flex h-full items-center">Nama</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Kategori</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Mata Pelajaran</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Tanggal/Jam</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jumlah Soal</div>
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
                    @foreach ($exam as $e)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td>{{ $e->name }}</td>
                            <td>{{ $e->exam_category->name }}</td>
                            <td>{{ $e->subject->name }}</td>
                            <td>{{ $e->exam_date }} <br> {{ $e->start_time }} - {{ $e->end_time }}</td>
                            <td>-</td>
                            <td>
                                @if ($e->status == 'Aktif')
                                    <span
                                        class="me-2 rounded-sm bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-800">{{ $e->status }}</span>
                                @else
                                    <span
                                        class="me-2 rounded-sm bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800">{{ $e->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/ujian-quiz/{{ Crypt::encrypt($e->id_exam) }}/question"><i
                                        class="bi bi-list-task mr-3 text-lg text-green-600 hover:text-green-900"></i></a>
                                <a href="/ujian-quiz/{{ Crypt::encrypt($e->id_exam) }}/edit"><i
                                        class="bi bi-pencil-square mr-3 text-lg text-green-600 hover:text-green-900"></i></a>
                                <a href="/ujian-quiz/{{ Crypt::encrypt($e->id_exam) }}/delete"><i
                                        class="bi bi-trash text-lg text-green-600 hover:text-green-900"></i></a>
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
