@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Berita/Pengumuman
                </h1>
            </div>
            <div>
                <a href="/berita-pengumuman/create">
                    <button class="ms-2 h-10 min-w-28 rounded-lg bg-green-100 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-plus-lg pe-1"></i>
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
                            <div class="flex h-full items-center">Judul</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Keterangan</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Tipe</div>
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
                    @foreach ($news as $n)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td>{{ $n->title }}</td>
                            <td>{{ $n->short_desc }}</td>
                            <td class="capitalize">{{ $n->type == 'Berita' ? '📢' : '📝' }} {{ $n->type }}</td>
                            <td>
                                @if ($n->status == 'Aktif')
                                    <span class="me-2 rounded-sm bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">{{ $n->status }}</span>
                                @else
                                    <span class="me-2 rounded-sm bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-800">{{ $n->status }}</span>
                                @endif
                            </td>
                            <td class="flex justify-center gap-1">
                                <a href="/berita-pengumuman/{{ Crypt::encrypt($n->id_news) }}" target="_blank"><i class="bi bi-eye mr-3 text-lg text-green-600 hover:text-green-900"></i></a>
                                <a href="/berita-pengumuman/{{ Crypt::encrypt($n->id_news) }}/edit"><i class="bi bi-pencil-square mr-3 text-lg text-green-600 hover:text-green-900"></i></a>
                                <a href="/berita-pengumuman/{{ Crypt::encrypt($n->id_news) }}/delete"><i class="bi bi-trash text-lg text-green-600 hover:text-green-900"></i></a>
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
