@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Mata Pelajaran</h1>
            </div>
            <div>
                <a href="/mapel" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/mapel" enctype="multipart/form-data" method="post">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-600">Nama Mata
                            Pelajaran</label>
                        <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama Mata Pelajaran..." value="{{ old('name') }}" autocomplete="off" />
                        @error('name')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="subject_code" class="mb-2 block text-sm font-medium text-gray-600">Kode Mata
                            Pelajaran</label>
                        <input type="text" id="subject_code" name="subject_code" class="@error('subject_code') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Kode Mata Pelajaran..." value="{{ old('subject_code') }}" autocomplete="off" />
                        @error('subject_code')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="level" class="required mb-2 block text-sm font-medium text-gray-600">Tingkat</label>
                        <select name="level" id="level" name="level" class="@error('level') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="TK">TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                        </select>
                        @error('level')
                            <p class="pt-5 text-xs text-red-600" style="padding-top: 1.25rem;">{{ $message }}</p>
                        @enderror
                        <div class="mt-1"></div>
                    </div>

                    <div>
                        <label for="id_subcontent" class="mb-2 block text-sm font-medium text-gray-600">Muatan Mapel</label>
                        <select name="id_subcontent" id="id_subcontent" name="id_subcontent" class="@error('id_subcontent') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Muatan --</option>
                            @foreach ($subject_content as $s)
                                <option value="{{ $s->id_subcontent }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('id_subcontent')
                            <p class="text-xs text-red-600" style="padding-top: 1.25rem;">{{ $message }}</p>
                        @enderror
                        <div class="mt-1"></div>
                    </div>

                    <div>
                        <div class="mt-2"></div>
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Status --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif"> Non-Aktif</option>
                        </select>
                        @error('status')
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
