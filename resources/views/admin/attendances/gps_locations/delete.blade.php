@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-2">

        <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
            <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
                <div>
                    <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Hapus Lokasi Absensi
                    </h1>
                </div>
                <div>
                    <a href="/lokasi-gps"
                        class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
                            class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                </div>
            </div>
            <div class="body">
                <form class="my-6" action="/lokasi-gps/{{ Crypt::encrypt($gpsLocation->id) }}"
                    enctype="multipart/form-data" method="post">
                    @method('delete')
                    @csrf
                    <div class="flex justify-center mb-10">
                        <img src="{{ asset('assets/img/warning-delete.png') }}" alt="warning" class="w-56">
                    </div>

                    <table class="w-full tables" cellpadding="10">
                        <thead>
                            <tr>
                                <th class="font-medium text-slate-800" colspan="3">Detail Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="text-slate-800" width="150">Nama Lokasi</td>
                                <td class="text-slate-600" width="30">:</td>
                                <td class="text-slate-600 font-light">{{ $gpsLocation->name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-slate-800">Alamat</td>
                                <td class="text-slate-600">:</td>
                                <td class="text-slate-600 font-light">{{ $gpsLocation->address }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-slate-800">Jam/Waktu</td>
                                <td class="text-slate-600">:</td>
                                <td class="text-slate-600 font-light">{{ $gpsLocation->start_time }} -
                                    {{ $gpsLocation->end_time }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-slate-800">Jarak Radius (meter)</td>
                                <td class="text-slate-600">:</td>
                                <td class="text-slate-600 font-light">{{ $gpsLocation->distance }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-slate-800">Deskripsi</td>
                                <td class="text-slate-600">:</td>
                                <td class="text-slate-600 font-light">{{ $gpsLocation->description }} </td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="mt-10 flex justify-end">
                        <button type="submit"
                            class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
