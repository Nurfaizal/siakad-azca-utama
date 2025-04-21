@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Detail Catatan Siswa</h1>
            </div>
            <div>
                <a href="/catatan-siswa" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">

            <img src="data:image/{{ $fileExt }};base64,{{ $fileData }}" alt="Google Drive Image" class="mt-4" height="100" width="100">

            <table>
                <tr height="40">
                    <td width="150"><b>NISN</b></td>
                    <td width="12">:</td>
                    <td>{{ $student_note->student->nisn }}</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Nama</b></td>
                    <td width="12">:</td>
                    <td>{{ $student_note->student->name }}</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Kelas</b></td>
                    <td width="12">:</td>
                    <td>{{ $student_note->classes->name }}</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Catatan</b></td>
                    <td width="12">:</td>
                    <td>{{ $student_note->note }}</td>
                </tr>
                <tr height="40">
                    <td width="150"><b>Status</b></td>
                    <td width="12">:</td>
                    <td>
                        @if ($student_note->status == 'Aktif')
                            <span class="me-2 rounded-sm bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-800">{{ $student_note->status }}</span>
                        @else
                            <span class="me-2 rounded-sm bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800">{{ $student_note->status }}</span>
                        @endif
                    </td>
                </tr>
            </table>

        </div>
    </div>
@endsection
