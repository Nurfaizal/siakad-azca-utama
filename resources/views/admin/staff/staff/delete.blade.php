@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                @if ($staff->user->status == 'Aktif')
                    <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Hapus Data Guru & Staff</h1>
                @else
                    <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Hapus Data Guru & Staff Non-Aktif</h1>
                @endif
            </div>
            <div>
                @if ($staff->user->status == 'Aktif')
                    <a href="/staff" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @else
                    <a href="/staff-non-aktif" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @endif
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/staff/{{ Crypt::encrypt($staff->id_staff) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('DELETE')

                <p class="mb-5">Yakin Ingin Menghapus Data Berikut ini : </p>

                <p class="mt-8"><b>Foto</b></p>
                @if ($staff->image != null)
                    <div class="mb-10 mt-5 flex justify-center md:justify-start">
                        <img src="data:image/{{ $fileExt }};base64,{{ $fileData }}" alt="Foto Staff" class="h-60 w-60 rounded object-cover">
                    </div>
                @else
                    <div class="mb-10 mt-10 flex justify-center md:justify-start">
                        <p>(Tidak Ada Foto)</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        {{-- 1 --}}
                        <tr height="40">
                            <td width="200"><b>NIP</b></td>
                            <td width="12">:</td>
                            <td>{{ $staff->nip }}</td>
                        </tr>
                        {{-- 2 --}}
                        <tr height="40">
                            <td><b>Nama Lengkap</b></td>
                            <td>:</td>
                            <td>{{ $staff->name }}</td>
                        </tr>
                        {{-- 3 --}}
                        <tr height="40">
                            <td><b>Username</b></td>
                            <td>:</td>
                            <td>{{ $staff->user->username }}</td>
                        </tr>
                        {{-- 4 --}}
                        <tr height="40">
                            <td><b>No KTP</b></td>
                            <td>:</td>
                            <td>{{ $staff->no_ktp }}</td>
                        </tr>
                        {{-- 5 --}}
                        <tr height="40">
                            <td><b>No HP</b></td>
                            <td>:</td>
                            <td>{{ $staff->phone }}</td>
                        </tr>
                        {{-- 6 --}}
                        <tr height="40">
                            <td><b>Tempat/Tgl.Lahir</b></td>
                            <td>:</td>
                            <td>{{ $staff->place_birth }}, {{ $staff->birth_date }}</td>
                        </tr>
                        {{-- 7 --}}
                        <tr height="40">
                            <td><b>Tanggal Bergabung</b></td>
                            <td>:</td>
                            <td>{{ $staff->join_date }}</td>
                        </tr>
                        {{-- 8 --}}
                        <tr height="40">
                            <td><b>Tanggal Berakhir</b></td>
                            <td>:</td>
                            <td>{{ $staff->end_date }}</td>
                        </tr>
                        {{-- 9 --}}
                        <tr height="40">
                            <td><b>Pendidikan Terakhir</b></td>
                            <td>:</td>
                            <td>{{ $staff->education }}</td>
                        </tr>
                    </table>

                    <table class="w-full" cellpadding="10">
                        {{-- 10 --}}
                        <tr height="40">
                            <td width="200"><b>Jenis Kelamin</b></td>
                            <td width="12">:</td>
                            <td>{{ $staff->gender }}</td>
                        </tr>
                        {{-- 11 --}}
                        <tr height="40">
                            <td><b>Divisi</b></td>
                            <td>:</td>
                            <td>{{ $staff->division->name }}</td>
                        </tr>
                        {{-- 12 --}}
                        <tr height="40">
                            <td><b>Gaji</b></td>
                            <td>:</td>
                            <td>Rp. {{ number_format($staff->salary) }}</td>
                        </tr>
                        {{-- 13 --}}
                        <tr height="40">
                            <td><b>Bagian</b></td>
                            <td>:</td>
                            <td>{{ $staff->part }}</td>
                        </tr>
                        {{-- 14 --}}
                        <tr height="40">
                            <td><b>Status</b></td>
                            <td>:</td>
                            <td>{{ $staff->status }}</td>
                        </tr>
                        {{-- 15 --}}
                        <tr height="40">
                            <td><b>No. Kartu</b></td>
                            <td>:</td>
                            <td>{{ $staff->phone }}</td>
                        </tr>
                        {{-- 16 --}}
                        <tr height="40">
                            <td><b>Email</b></td>
                            <td>:</td>
                            <td>{{ $staff->phone }}</td>
                        </tr>
                        {{-- 17 --}}
                        <tr height="40">
                            <td><b>Alamat</b></td>
                            <td>:</td>
                            <td>{{ $staff->address }}</td>
                        </tr>
                    </table>
                </div>

                <input type="hidden" name="account_status" value="{{ $staff->user->status }}">

                <input type="hidden" name="id_user" value="{{ Crypt::encrypt($staff->user->id_user) }}">

                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection
