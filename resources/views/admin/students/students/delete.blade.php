@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                @if ($students->status == 'Aktif')
                    <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Hapus Data Siswa</h1>
                @else
                    <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Hapus Data Siswa Non-Aktif</h1>
                @endif
            </div>
            <div>
                @if ($students->status == 'Aktif')
                    <a href="/siswa" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @else
                    <a href="/siswa/non-aktif" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @endif
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/siswa/{{ Crypt::encrypt($students->id_student) }}" method="post">
                @csrf
                @method('delete')

                <p class="mb-5">Yakin Ingin Menghapus Data Berikut ini : </p>

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        {{-- 1 --}}
                        <tr height="40">
                            <td width="200"><b>NISN</b></td>
                            <td width="12">:</td>
                            <td>
                                @if ($students->nisn == null)
                                    -
                                @else
                                    {{ $students->nisn }}
                                @endif
                            </td>
                        </tr>
                        {{-- 2 --}}
                        <tr height="40">
                            <td><b>Nama Lengkap</b></td>
                            <td>:</td>
                            <td>{{ $students->name }}</td>
                        </tr>
                        {{-- 3 --}}
                        <tr height="40">
                            <td><b>Kelas</b></td>
                            <td>:</td>
                            <td>{{ $students->classes->name }}</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection
