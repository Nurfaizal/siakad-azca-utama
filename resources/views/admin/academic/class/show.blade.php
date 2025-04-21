@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Detail Data Kelas</h1>
            </div>
            <div>
                <a href="/kelas" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <br>

            <table>
                {{-- 1 --}}
                <tr height="40">
                    <td width="160"><b>Kelas</b></td>
                    <td width="12">:</td>
                    <td>{{ $classes->name }}</td>
                </tr>
                {{-- 2 --}}
                <tr height="40">
                    <td><b>Tingkat</b></td>
                    <td width="12">:</td>
                    <td>{{ $classes->level }}</td>
                </tr>
                {{-- 3 --}}
                <tr height="40">
                    <td><b>Program Keahlian</b></td>
                    <td width="12">:</td>
                    <td>
                        @if ($classes->id_skill != null)
                            {{ $classes->skill->name }}
                        @else
                            Tidak Ada
                        @endif
                    </td>
                </tr>
                {{-- 4 --}}
                <tr height="40">
                    <td><b>Jam Masuk</b></td>
                    <td width="12">:</td>
                    <td>{{ $classes->time_in }} - {{ $classes->time_out }}</td>
                </tr>
                {{-- 5 --}}
                <tr height="40">
                    <td><b>Wali Kelas</b></td>
                    <td width="12">:</td>
                    <td>{{ $classes->staff->name }}</td>
                </tr>
                {{-- 6 --}}
                <tr height="40">
                    <td><b>Tahun Ajaran</b></td>
                    <td width="12">:</td>
                    <td>{{ $classes->year->name }}</td>
                </tr>
                {{-- 7 --}}
                <tr height="40">
                    <td><b>Status</b></td>
                    <td>:</td>
                    <td>
                        @if ($classes->status == 'Aktif')
                            <span class="me-2 rounded-sm bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-800">{{ $classes->status }}</span>
                        @else
                            <span class="me-2 rounded-sm bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800">{{ $classes->status }}</span>
                        @endif
                    </td>
                </tr>
            </table>

        </div>
    </div>
@endsection
