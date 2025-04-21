@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Ubah Password</h1>
            </div>
            <a href="/profile" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                Kembali</a>

        </div>
        <div class="body">
            <form class="my-6" action="/profile/{{ Crypt::encrypt(Auth::user()->id_user) }}" method="post">
                @csrf
                @method('PUT')

                <p><b>Nama :</b> {{ $user->staff->name }}</p>
                <p><b>No.Telp :</b> {{ $user->staff->phone }}</p>
                <br>

                <div class="mb-4">
                    <label for="old_password" class="required mb-2 block text-sm font-medium text-gray-600">Password
                        Lama</label>
                    <input type="password" id="old_password" name="old_password" class="@error('old_password') border-red-600 @enderror form-password block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Password Lama..." autocomplete="off" />
                    @error('old_password')
                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="required mb-2 block text-sm font-medium text-gray-600">Password
                        Baru</label>
                    <input type="password" id="password" name="password" class="@error('password') border-red-600 @enderror form-password block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Password Baru..." autocomplete="off" />
                    @error('password')
                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="konfir_password" class="required mb-2 block text-sm font-medium text-gray-600">Konfirmasi
                        Password</label>
                    <input type="password" id="konfir_password" name="konfir_password" class="@error('konfir_password') border-red-600 @enderror form-password block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Konfirmasi Password..." autocomplete="off" />
                    @error('konfir_password')
                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="mb-4 mt-4 flex items-center">
                        <input id="default-checkbox" type="checkbox" class="form-checkbox mt-1 h-4 w-4 rounded-sm border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500">
                        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">Tampilkan
                            Password</label>
                    </div>
                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>

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
