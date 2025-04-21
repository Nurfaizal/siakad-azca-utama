@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Detail Semester</h1>
            </div>
            <div>
                <a href="/semester" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">

            <table class="mt-8">
                <tr height="40">
                    <td width="150"><b>Nama Semester</b></td>
                    <td width="12">:</td>
                    @if ($semester->final_level != 0)
                        <td>{{ $semester->name }} - Tingkat Akhir</td>
                    @else
                        <td>{{ $semester->name }}</td>
                    @endif
                </tr>
                <tr height="40">
                    <td width="150"><b>Kode</b></td>
                    <td width="12">:</td>
                    <td>{{ $semester->code }}</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Jenis Semester</b></td>
                    <td width="12">:</td>
                    <td>{{ $semester->semester_type->name }}</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Status</b></td>
                    <td width="12">:</td>
                    <td>
                        @if ($semester->status == 'Aktif')
                            <span class="me-2 rounded-sm bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-800">{{ $semester->status }}</span>
                        @else
                            <span class="me-2 rounded-sm bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800">{{ $semester->status }}</span>
                        @endif
                    </td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Absensi</b></td>
                    <td width="12">:</td>
                    <td>{{ $semester->attendance }} %</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Nilai Harian</b></td>
                    <td width="12">:</td>
                    <td>{{ $semester->daily_score }} %</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>PTS</b></td>
                    <td width="12">:</td>
                    <td>{{ $semester->mid_term_score }} %</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>PAS</b></td>
                    <td width="12">:</td>
                    <td>{{ $semester->final_term_score }} %</td>
                </tr>
            </table>


        </div>
    </div>
@endsection
