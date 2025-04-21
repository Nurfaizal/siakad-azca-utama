@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Edit E-Dokumen Guru & Staff</h1>
            </div>
            <div>
                <a href="/e-dokumen-staff" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/e-dokumen-staff/{{ Crypt::encrypt($document->id_e_document_staff) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">

                    <div>
                        <label for="id_staff" class="mb-2 block text-sm font-medium text-gray-600">Nama Staff</label>
                        <select name="id_staff" id="id_staff" name="id_staff" class="@error('id_staff') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $document->id_staff }}">-- {{ $document->staff->name }} --</option>
                            @foreach ($staff as $s)
                                <option value="{{ $s->id_staff }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('id_staff')
                            <p class="text-xs text-red-600" style="padding-top: 1.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-1"></div>

                    <div>
                        <label for="id_category" class="mb-2 block text-sm font-medium text-gray-600">Tipe Dokumen</label>
                        <select name="id_category" id="id_category" name="id_category" class="@error('id_category') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $document->id_category }}">-- {{ $document->document_category->name }} --</option>
                            @foreach ($type_document as $td)
                                <option value="{{ $td->id_category }}">{{ $td->name }}</option>
                            @endforeach
                        </select>
                        @error('id_category')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="mb-2 block text-sm font-medium text-gray-600">File</label>
                        <input type="file" id="file" name="file" class="block w-full rounded-lg p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" />
                        @error('file')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="pt-2">{{ $document->file }}</p>
                    </div>

                </div>
                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
