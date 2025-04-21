@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Edit Penetapan Jam Masuk Personal</h1>
            </div>
            <div>
                <a href="/penetapan-jam-personal" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">


            <form class="my-6" action="/penetapan-jam-personal/{{ Crypt::encrypt($personal->id_personal) }}" method="post">
                @csrf
                @method('PUT')

                <table>
                    <tr>
                        <td width="100"><b>Nama</b></td>
                        <td width="12">:</td>
                        <td>{{ $personal->staff->name }}</td>
                    </tr>
                    <tr>
                        <td><b>Divisi</b></td>
                        <td>:</td>
                        <td>{{ $personal->staff->division->name }}</td>
                    </tr>
                </table>

                <div class="mt-4 grid grid-cols-3 gap-3">
                    <div class="relative mt-8"><label><b>Senin</b></label></div>
                    <div class="relative">
                        <label for="monday_in" class="mb-2 block text-sm font-medium text-gray-600">Jam Masuk</label>
                        <input type="time" id="monday_in" name="monday_in" class="@error('monday_in') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->monday_in }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('monday_in')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="monday_out" class="mb-2 block text-sm font-medium text-gray-600">Jam Keluar</label>
                        <input type="time" id="monday_out" name="monday_out" class="@error('monday_out') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->monday_out }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('monday_out')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-3">
                    <div class="relative mt-8"><label><b>Selasa</b></label></div>
                    <div class="relative">
                        <label for="tuesday_in" class="mb-2 block text-sm font-medium text-gray-600">Jam Masuk</label>
                        <input type="time" id="tuesday_in" name="tuesday_in" class="@error('tuesday_in') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->tuesday_in }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('tuesday_in')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="tuesday_out" class="mb-2 block text-sm font-medium text-gray-600">Jam Keluar</label>
                        <input type="time" id="tuesday_out" name="tuesday_out" class="@error('tuesday_out') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->tuesday_out }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('tuesday_out')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-3">
                    <div class="relative mt-8"><label><b>Rabu</b></label></div>
                    <div class="relative">
                        <label for="wednesday_in" class="mb-2 block text-sm font-medium text-gray-600">Jam Masuk</label>
                        <input type="time" id="wednesday_in" name="wednesday_in" class="@error('wednesday_in') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->wednesday_in }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('wednesday_in')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="wednesday_out" class="mb-2 block text-sm font-medium text-gray-600">Jam Keluar</label>
                        <input type="time" id="wednesday_out" name="wednesday_out" class="@error('wednesday_out') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->wednesday_out }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('wednesday_out')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-3">
                    <div class="relative mt-8"><label><b>Kamis</b></label></div>
                    <div class="relative">
                        <label for="thursday_in" class="mb-2 block text-sm font-medium text-gray-600">Jam Masuk</label>
                        <input type="time" id="thursday_in" name="thursday_in" class="@error('thursday_in') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->thursday_in }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('thursday_in')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="thursday_out" class="mb-2 block text-sm font-medium text-gray-600">Jam Keluar</label>
                        <input type="time" id="thursday_out" name="thursday_out" class="@error('thursday_out') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->thursday_out }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('thursday_out')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-3">
                    <div class="relative mt-8"><label><b>Jumat</b></label></div>
                    <div class="relative">
                        <label for="friday_in" class="mb-2 block text-sm font-medium text-gray-600">Jam Masuk</label>
                        <input type="time" id="friday_in" name="friday_in" class="@error('friday_in') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->friday_in }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('friday_in')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="friday_out" class="mb-2 block text-sm font-medium text-gray-600">Jam Keluar</label>
                        <input type="time" id="friday_out" name="friday_out" class="@error('friday_out') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->friday_out }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('friday_out')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-3">
                    <div class="relative mt-8"><label><b>Sabtu</b></label></div>
                    <div class="relative">
                        <label for="saturday_in" class="mb-2 block text-sm font-medium text-gray-600">Jam Masuk</label>
                        <input type="time" id="saturday_in" name="saturday_in" class="@error('saturday_in') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->saturday_in }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('saturday_in')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="saturday_out" class="mb-2 block text-sm font-medium text-gray-600">Jam Keluar</label>
                        <input type="time" id="saturday_out" name="saturday_out" class="@error('saturday_out') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->saturday_out }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('saturday_out')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-3">
                    <div class="relative mt-8"><label><b>Minggu</b></label></div>
                    <div class="relative">
                        <label for="sunday_in" class="mb-2 block text-sm font-medium text-gray-600">Jam Masuk</label>
                        <input type="time" id="sunday_in" name="sunday_in" class="@error('sunday_in') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->sunday_in }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('sunday_in')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <label for="sunday_out" class="mb-2 block text-sm font-medium text-gray-600">Jam Keluar</label>
                        <input type="time" id="sunday_out" name="sunday_out" class="@error('sunday_out') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ $personal->sunday_out }}" />
                        <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                        @error('sunday_out')
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
