@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Hapus Data Guru & Staff</h1>
            </div>
            <div>
                <a href="/staff" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/staff/delete/{{ Crypt::encrypt($staff->id_staff) }}" enctype="multipart/form-data" method="post">
                @csrf



                <p>Yakin Ingin Menghapus Data Berikut ini : </p>
                <br>
                <br>

                <table class="w-full" cellpadding="10">
                    <tr>
                        <td width="150"><b>NIP</b></td>
                        <td width="12">:</td>
                        <td>{{ $staff->nip }}</td>
                    </tr>
                    <tr>
                        <td><b>Nama Lengkap</b></td>
                        <td>:</td>
                        <td>{{ $staff->name }}</td>
                    </tr>
                    <tr>
                        <td><b>Divisi</b></td>
                        <td>:</td>
                        <td>{{ $staff->division }}</td>
                    </tr>
                    <tr>
                        <td><b>Alamat</b></td>
                        <td>:</td>
                        <td>{{ $staff->address }}</td>
                    </tr>
                </table>

                <input type="hidden" name="id_user" value="{{ $staff->user->id_user }}">




                <div class="mt-10 flex justify-end">
                    <button type="submit" class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection
