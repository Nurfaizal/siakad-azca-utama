@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Semester</h1>
            </div>
            <div>
                <a href="/semester" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">

            <form class="my-6" action="/semester" method="post">
                @csrf

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-600">Nama Semester</label>
                        <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama Semester..." value="{{ old('name') }}" autocomplete="off" />
                        @error('name')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code" class="mb-2 block text-sm font-medium text-gray-600">Kode</label>
                        <input type="text" id="code" name="code" class="@error('code') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Kode..." value="{{ old('code') }}" autocomplete="off" />
                        @error('code')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_semester_type" class="mb-2 block text-sm font-medium text-gray-600">Jenis Semester</label>
                        <select name="id_semester_type" id="id_semester_type" name="id_semester_type" class="@error('id_semester_type') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Jenis Semester --</option>
                            @foreach ($semester_type as $st)
                                <option value="{{ $st->id_semester_type }}">{{ $st->name }}</option>
                            @endforeach
                        </select>
                        @error('id_semester_type')
                            <p class="pt-5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Status --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                        @error('status')
                            <p class="pt-5 text-xs text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="flex items-start pt-8">
                            <div class="flex h-5 items-center">
                                <input id="final_level" type="checkbox" name="final_level" value="{{ 1 }}" class="focus:ring-3 h-4 w-4 rounded-sm border border-gray-300 bg-gray-50 focus:ring-blue-300" />
                            </div>
                            <label for="final_level" class="ms-2 text-sm font-medium text-gray-900">Tingkat Akhir</label>
                        </div>
                    </div>

                    <div class="pt-4">
                        <label for="attendance" class="mb-2 block text-sm font-medium text-gray-600">Absensi</label>
                        <input type="number" id="attendance" name="attendance" class="@error('attendance') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nilai Absensi..." value="{{ old('attendance') }}" autocomplete="off" />
                        @error('attendance')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <label for="daily_score" class="mb-2 block text-sm font-medium text-gray-600">Nilai Harian</label>
                        <input type="number" id="daily_score" name="daily_score" class="@error('daily_score') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nilai Harian..." value="{{ old('daily_score') }}" autocomplete="off" />
                        @error('daily_score')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mid_term_score" class="mb-2 block text-sm font-medium text-gray-600">PTS</label>
                        <input type="number" id="mid_term_score" name="mid_term_score" class="@error('mid_term_score') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nilai PTS..." value="{{ old('mid_term_score') }}" autocomplete="off" />
                        @error('mid_term_score')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="final_term_score" class="mb-2 block text-sm font-medium text-gray-600">PAS</label>
                        <input type="number" id="final_term_score" name="final_term_score" class="@error('final_term_score') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nilai PAS..." value="{{ old('final_term_score') }}" autocomplete="off" />
                        @error('final_term_score')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>




                <div class="mt-10 flex justify-end">
                    <button type="submit" class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
