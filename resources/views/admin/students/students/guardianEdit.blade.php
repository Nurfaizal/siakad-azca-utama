@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 px-5 py-6 bg-white rounded-lg">
        <div class="flex flex-col items-center justify-between gap-5 pb-5 border-b header md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Ubah Data Siswa
                </h1>
            </div>
            <div>
                <a href="/siswa"
                    class="px-3 py-2 font-semibold text-green-700 duration-150 ease-linear bg-green-100 rounded-lg ms-2 hover:bg-green-200"><i
                        class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">

            <form class="my-6" action="/siswa" enctype="multipart/form-data" method="post">
                @method('post')
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h1 class="mb-5 text-sm font-medium text-slate-600">Data Wali</h1>

                        <div class="mb-4">
                            <label for="guardian_name" class="block mb-2 text-sm text-gray-500 required font-regular">Nama
                                Wali/Orang tua</label>
                            <input type="text" id="guardian_name" name="guardian_name"
                                class="@error('guardian_name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="Nama..." value="{{ old('guardian_name') }}" autocomplete="off" />
                            @error('guardian_name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_username"
                                class="block mb-2 text-sm text-gray-500 required font-regular">Username
                                Wali/Orang tua</label>
                            <input type="text" id="guardian_username" name="guardian_username"
                                class="@error('guardian_username') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="Username Wali..." value="{{ old('guardian_username') }}" autocomplete="off" />
                            @error('guardian_username')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_email"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Email</label>
                            <input type="email" id="guardian_email" name="guardian_email"
                                class="@error('guardian_email') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="guardian_Email..." value="{{ old('guardian_email') }}" autocomplete="off" />
                            @error('guardian_email')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_password"
                                class="block mb-2 text-sm text-gray-500 required font-regular">Password
                                Wali/Orang tua</label>
                            <input type="password" id="guardian_password" name="guardian_password"
                                class="@error('guardian_password') border-red-600 @enderror form-guardian_password block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="Password Wali..." autocomplete="off" />
                            @error('guardian_password')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_phone" class="block mb-2 text-sm text-gray-500 required font-regular">Nomor
                                Telp</label>
                            <input type="text" id="guardian_phone" name="guardian_phone"
                                class="@error('guardian_phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="Nomor Telp..." value="{{ old('guardian_phone') }}" autocomplete="off" />
                            @error('guardian_phone')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="alt_phone" class="block mb-2 text-sm text-gray-500 font-regular">Alternatif Nomor
                                Telp</label>
                            <input type="text" id="alt_phone" name="alt_phone"
                                class="@error('alt_phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="Alternatif Nomor Telpon..." value="{{ old('alt_phone') }}"
                                autocomplete="off" />
                            @error('alt_phone')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_job"
                                class="block mb-2 text-sm text-gray-500 required font-regular">Pekerjaan</label>
                            <input type="text" id="guardian_job" name="guardian_job"
                                class="@error('guardian_job') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="Pekerjaan..." value="{{ old('guardian_job') }}" autocomplete="off" />
                            @error('guardian_job')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_address"
                                class="block mb-2 text-sm text-gray-500 required font-regular">Alamat</label>
                            <textarea name="guardian_address" id="guardian_address" rows="3"
                                class="@error('guardian_address') border-red-600 @enderror mt-2 w-full rounded-lg border p-2"
                                placeholder="Alamat...">{{ old('guardian_address') }}</textarea>
                            @error('guardian_address')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
        </div>
        <div class="flex justify-end mt-10">
            <button type="submit"
                class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
        </div>
        </form>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>

    <!-- Script Menampilkan Password -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            });
        });
    </script>
@endsection
