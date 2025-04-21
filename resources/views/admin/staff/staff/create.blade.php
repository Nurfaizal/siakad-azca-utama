@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Data Guru & Staff
                </h1>
            </div>
            <div>
                <a href="/staff" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/staff" enctype="multipart/form-data" method="post">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="nip" class="required mb-2 block text-sm font-medium text-gray-600">NIP</label>
                        <input type="number" id="nip" name="nip" class="@error('nip') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="NIP..." value="{{ old('nip') }}" autocomplete="off" />
                        @error('nip')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="required mb-2 block text-sm font-medium text-gray-600">Nama</label>
                        <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama..." value="{{ old('name') }}" autocomplete="off" />
                        @error('name')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="username" class="required mb-2 block text-sm font-medium text-gray-600">Username</label>
                        <input type="text" id="username" name="username" class="@error('username') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Username..." value="{{ old('username') }}" autocomplete="off" />
                        @error('username')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="no_ktp" class="required mb-2 block text-sm font-medium text-gray-600">No KTP</label>
                        <input type="number" id="no_ktp" name="no_ktp" class="@error('no_ktp') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="No KTP..." value="{{ old('no_ktp') }}" autocomplete="off" />
                        @error('no_ktp')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="required mb-2 block text-sm font-medium text-gray-600">No HP</label>
                        <input type="number" id="phone" name="phone" class="@error('phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="No HP..." value="{{ old('phone') }}" autocomplete="off" />
                        @error('phone')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="place_birth" class="required mb-2 block text-sm font-medium text-gray-600">Tempat
                            Lahir</label>
                        <input type="text" id="place_birth" name="place_birth" class="@error('place_birth') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Tempat Lahir..." value="{{ old('place_birth') }}" autocomplete="off" />
                        @error('place_birth')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="birth_date" class="required mb-2 block text-sm font-medium text-gray-600">Tanggal
                            Lahir</label>
                        <input type="date" id="birth_date" name="birth_date" class="@error('birth_date') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('birth_date') }}" autocomplete="off" />
                        @error('birth_date')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="join_date" class="required mb-2 block text-sm font-medium text-gray-600">Tanggal
                            Bergabung</label>
                        <input type="date" id="join_date" name="join_date" class="@error('join_date') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('join_date') }}" autocomplete="off" />
                        @error('join_date')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="required mb-2 block text-sm font-medium text-gray-600">Tanggal
                            Berakhir</label>
                        <input type="date" id="end_date" name="end_date" class="@error('end_date') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('end_date') }}" autocomplete="off" />
                        @error('end_date')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="education" class="required mb-2 block text-sm font-medium text-gray-600">Pendidikan
                            Terakhir</label>
                        <input type="text" id="education" name="education" class="@error('education') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Pendidikan Terakhir..." value="{{ old('education') }}" autocomplete="off" />
                        @error('education')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="gender" class="required mb-2 block text-sm font-medium text-gray-600">Jenis
                            Kelamin</label>
                        <select name="gender" id="gender" name="gender" class="@error('gender') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('gender')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="id_division" class="required mb-2 block text-sm font-medium text-gray-600">Divisi</label>
                        <select name="id_division" id="id_division" name="id_division" class="@error('id_division') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="">-- Pilih Divisi --</option>
                            @foreach ($division as $d)
                                <option value="{{ $d->id_division }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                        @error('id_division')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="salary" class="required mb-2 block text-sm font-medium text-gray-600">Gaji</label>
                        <input type="text" id="salary" name="salary" class="@error('salary') border-red-600 @enderror money block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Gaji..." value="{{ old('salary') }}" autocomplete="off" />
                        @error('salary')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="part" class="required mb-2 block text-sm font-medium text-gray-600">Bagian</label>
                        <input type="text" id="part" name="part" class="@error('part') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Satpam, Office Boy, dll..." value="{{ old('part') }}" autocomplete="off" />
                        @error('part')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="required mb-2 block text-sm font-medium text-gray-600">Status</label>
                        <input type="text" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="PNS, Honorer, dll..." value="{{ old('status') }}" autocomplete="off" />
                        @error('status')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="card_number" class="required mb-2 block text-sm font-medium text-gray-600">Nomor
                            Kartu</label>
                        <input type="number" id="card_number" name="card_number" class="@error('card_number') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nomor Kartu..." value="{{ old('card_number') }}" autocomplete="off" />
                        @error('card_number')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="required mb-2 block text-sm font-medium text-gray-600">Email</label>
                        <input type="email" id="email" name="email" class="@error('email') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Email..." value="{{ old('email') }}" autocomplete="off" />
                        @error('email')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="required mb-2 block text-sm font-medium text-gray-600">Password</label>
                        <input type="password" id="password" name="password" class="@error('password') border-red-600 @enderror form-password block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Password..." autocomplete="off" />
                        @error('password')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="konfir_password" class="required mb-2 block text-sm font-medium text-gray-600">Konfirmasi Password</label>
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
                    <div>
                        <label for="address" class="required mb-2 block text-sm font-medium text-gray-600">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="@error('address') border-red-600 @enderror mt-2 w-full rounded-lg border p-2" placeholder="Alamat...">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="level" class="required mb-2 block text-sm font-medium text-gray-600">Tingkat
                            Pengguna</label>
                        <div class="grid grid-cols-2">
                            <div>
                                <div class="mb-2">
                                    <input type="checkbox" class="border" name="level[]" value="admin" id="admin">
                                    <label for="admin" class="ms-2 text-sm font-medium text-gray-600">Admin</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="border" name="level[]" value="staff" id="staff">
                                    <label for="staff" class="ms-2 text-sm font-medium text-gray-600">Staff</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="border" name="level[]" value="guru sma" id="sma">
                                    <label for="sma" class="ms-2 text-sm font-medium text-gray-600">Guru SMA</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="border" name="level[]" value="guru smp" id="smp">
                                    <label for="smp" class="ms-2 text-sm font-medium text-gray-600">Guru SMP</label>
                                </div>
                            </div>
                            <div>
                                <div class="mb-2">
                                    <input type="checkbox" class="border" name="level[]" value="guru sd" id="sd">
                                    <label for="sd" class="ms-2 text-sm font-medium text-gray-600">Guru SD</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="border" name="level[]" value="guru tk" id="tk">
                                    <label for="tk" class="ms-2 text-sm font-medium text-gray-600">Guru TK</label>
                                </div>
                            </div>
                        </div>
                        @error('level')
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
