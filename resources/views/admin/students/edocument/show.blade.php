@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Detail E-Dokumen Siswa
                </h1>
            </div>
            <div>
                <a href="/e-dokumen-siswa"
                    class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
                        class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">

            <table class="mt-8">
                <tr height="40">
                    <td width="150"><b>NISN</b></td>
                    <td width="12">:</td>
                    <td>
                        @if ($document->student->nisn == null)
                            -
                        @else
                            {{ $document->student->nisn }}
                        @endif
                    </td>
                </tr>
                <tr height="40">
                    <td><b>Nama Siswa</b></td>
                    <td>:</td>
                    <td>{{ $document->student->name }}</td>
                </tr>
                <tr height="40">
                    <td><b>Kelas</b></td>
                    <td>:</td>
                    <td>{{ $document->student->class->name }}</td>
                </tr>
                <tr height="40">
                    <td><b>Kategori</b></td>
                    <td>:</td>
                    <td>{{ $document->document_category->name }}</td>
                </tr>
                <tr height="40">
                    <td><b>File</b></td>
                    <td>:</td>
                    <td>
                        {{ $document->file }} <br>

                        <form action="/download-e-dokumen-siswa" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="file_path" value="{{ $document->file }} ">
                            <button
                                class="rounded-lg bg-blue-700 px-3 py-2 text-center text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                                type="submit">Download</button>
                        </form>

                    </td>
                </tr>
            </table>

        </div>
    </div>
@endsection
