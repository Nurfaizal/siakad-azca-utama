@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Edit Ujian/Quiz</h1>
            </div>
            <div>
                <a href="/ujian-quiz"
                    class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
                        class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/ujian-quiz/{{ Crypt::encrypt($exam->id_exam) }}" method="post">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    {{-- 1 --}}
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-600">Nama Ujian</label>
                        <input type="text" id="name" name="name"
                            class="@error('name') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                            placeholder="Nama Ujian..." value="{{ $exam->name }}" autocomplete="off" />
                        @error('name')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2 --}}
                    <div>
                        <label for="id_subject" class="mb-2 block text-sm font-medium text-gray-600">Mata Pelajaran</label>
                        <select name="id_subject" id="id_subject" name="id_subject"
                            class="@error('id_subject') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $exam->id_subject }}">-- {{ $exam->subject->name }} --</option>
                            @foreach ($subject as $s)
                                <option value="{{ $s->id_subject }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('id_subject')
                            <p class="mt-5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 3 --}}
                    <div>
                        <label for="id_exam_category" class="mb-2 block text-sm font-medium text-gray-600">Kategori
                            Ujian</label>
                        <select name="id_exam_category" id="id_exam_category" name="id_exam_category"
                            class="@error('id_exam_category') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $exam->id_exam_category }}">-- {{ $exam->exam_category->name }} --
                            </option>
                            @foreach ($exam_category as $ec)
                                <option value="{{ $ec->id_exam_category }}">{{ $ec->name }}</option>
                            @endforeach
                        </select>
                        @error('id_exam_category')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 4 --}}
                    <div>
                        <label for="exam_date" class="mb-2 block text-sm font-medium text-gray-600">Tanggal Ujian</label>
                        <input type="date" id="exam_date" name="exam_date"
                            class="@error('exam_date') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                            placeholder="Nama Ujian..." value="{{ $exam->exam_date }}" autocomplete="off" />
                        @error('exam_date')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 5 --}}
                    {{-- 6 --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="relative">
                            <label for="start_time" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                                Masuk</label>
                            <input type="time" id="start_time" name="start_time"
                                class="@error('start_time') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ $exam->start_time }}" />
                            <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                            @error('start_time')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative">
                            <label for="end_time" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                                Keluar</label>
                            <input type="time" id="end_time" name="end_time"
                                class="@error('end_time') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ $exam->end_time }}" />
                            <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                            @error('end_time')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- 7 --}}
                    <div>
                        <label for="id_room" class="mb-2 block text-sm font-medium text-gray-600">Ruangan</label>
                        <select name="id_room" id="id_room" name="id_room"
                            class="@error('id_room') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $exam->id_room }}">-- {{ $exam->room->name }} --</option>
                            @foreach ($room as $r)
                                <option value="{{ $r->id_room }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                        @error('id_room')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 8 --}}
                    <div>
                        <label for="supervisor" class="mb-2 block text-sm font-medium text-gray-600">Pengawas</label>
                        <select name="supervisor" id="supervisor" name="supervisor"
                            class="@error('supervisor') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $exam->supervisor }}">-- {{ $exam->supervisor }} --</option>
                            @foreach ($staff as $s)
                                <option value="{{ $s->name }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('supervisor')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 9 --}}
                    <div>
                        <label for="corrector" class="mb-2 block text-sm font-medium text-gray-600">Pengoreksi</label>
                        <select name="corrector" id="corrector" name="corrector"
                            class="@error('corrector') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $exam->corrector }}">-- {{ $exam->corrector }} --</option>
                            @foreach ($staff as $s)
                                <option value="{{ $s->name }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('corrector')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 10 --}}
                    <div>
                        <div class="flex items-start pt-7">
                            <div class="flex h-5 items-center">
                                <input id="score_show" type="checkbox" name="score_show" value="{{ 1 }}"
                                    class="focus:ring-3 h-4 w-4 rounded-sm border border-gray-300 bg-gray-50 focus:ring-blue-300"
                                    @if ($exam->score_show == 1) checked @endif />
                            </div>
                            <label for="score_show" class="ms-2 text-sm font-medium text-gray-900">Tampilkan Nilai Setelah
                                Ujian</label>
                        </div>
                    </div>


                    {{-- 11 --}}
                    <div>
                        <label for="status" class="my-3 block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="status" name="status"
                            class="@error('status') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $exam->status }}">-- {{ $exam->status }} --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                        @error('status')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 12 --}}
                    <div>
                        <label for="note" class="mb-2 block text-sm font-medium text-gray-900">Catatan</label>
                        <textarea id="note" name="note" rows="4"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Deskripsi...">{{ $exam->note }}</textarea>
                    </div>

                    {{-- 10 --}}
                    <div>
                        <div class="flex items-start pt-7">
                            <div class="flex h-5 items-center">
                                <input id="score_show" type="checkbox" name="score_show" value="{{ 1 }}" class="focus:ring-3 h-4 w-4 rounded-sm border border-gray-300 bg-gray-50 focus:ring-blue-300" @if ($exam->score_show == 1) checked @endif />
                            </div>
                            <label for="score_show" class="ms-2 text-sm font-medium text-gray-900">Tampilkan Nilai Setelah Ujian</label>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit"
                        class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
