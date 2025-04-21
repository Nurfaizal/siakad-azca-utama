@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Catatan Siswa
                </h1>
            </div>
            <div>
                <a href="/catatan-siswa" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/catatan-siswa" enctype="multipart/form-data" method="post">
                @csrf

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div>
                        <label for="id_class" class="mb-2 block text-sm font-medium text-gray-600">Kelas</label>
                        <select name="id_class" id="id_class" name="id_class" class="@error('id_class') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Kelas --</option>
                            @foreach ($class as $c)
                                <option value="{{ $c->id_class }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('id_class')
                            <p class="pt-5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_student" class="mb-2 block text-sm font-medium text-gray-600">Siswa</label>
                        <select name="id_student" id="id_student" name="id_student" class="@error('id_student') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Siswa --</option>
                            @foreach ($student as $s)
                                <option value="{{ $s->id_student }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('id_student')
                            <p class="pt-5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="note" class="mb-2 block text-sm font-medium text-gray-600">Catatan</label>
                        <textarea name="note" id="note" rows="2" class="@error('note') border-red-600 @enderror w-full rounded-lg border p-2">{{ old('note') }}</textarea>
                        @error('note')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Status --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                        @error('status')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="mb-2 block text-sm font-medium text-gray-600">Foto</label>
                        <input type="file" id="image" name="image" class="block w-full rounded-lg p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" />
                        @error('image')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
