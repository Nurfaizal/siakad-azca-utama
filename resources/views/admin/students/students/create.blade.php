@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Data Siswa
                </h1>
            </div>
            <div>
                <a href="/siswa" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">

            <form class="my-6" action="/siswa" enctype="multipart/form-data" method="post">
                @method('post')
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h1 class="mb-5 text-sm font-medium text-slate-600">Data Siswa</h1>

                        <div>
                            <label for="id_class" class="font-regular required mb-2 block text-sm text-gray-500">Kelas</label>
                            <select name="id_class" id="id_class" name="id_class" class="@error('id_class') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                <option selected value="">-- Pilih Kelas --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id_class }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('id_class')
                                <p class="text-xs text-red-600" style="padding-top: 1.25rem;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-8"></div>

                        <div class="mb-4">
                            <label for="nisn" class="font-regular mb-2 block text-sm text-gray-500">Nisn</label>
                            <input type="number" id="nisn" name="nisn" class="@error('nisn') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nisn..." value="{{ old('nisn') }}" autocomplete="off" />
                            @error('nisn')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nis" class="font-regular required mb-2 block text-sm text-gray-500">Nis</label>
                            <input type="number" id="nis" name="nis" class="@error('nis') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nis..." value="{{ old('nis') }}" autocomplete="off" />
                            @error('nis')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name" class="required font-regular mb-2 block text-sm text-gray-500">Nama
                                Lengkap</label>
                            <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama..." value="{{ old('name') }}" autocomplete="off" />
                            @error('name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="username" class="required font-regular mb-2 block text-sm text-gray-500">Username</label>
                            <input type="text" id="username" name="username" class="@error('username') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Username..." value="{{ old('username') }}" autocomplete="off" />
                            @error('username')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="required font-regular mb-2 block text-sm text-gray-600">Email</label>
                            <input type="email" id="email" name="email" class="@error('email') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Email..." value="{{ old('email') }}" autocomplete="off" />
                            @error('email')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="required font-regular mb-2 block text-sm text-gray-500">Password
                                Siswa</label>
                            <input type="password" id="password" name="password" class="@error('password') border-red-600 @enderror form-password-student block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Password..." autocomplete="off" />
                            @error('password')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="flex items-start pt-4">
                                <div class="flex h-5 items-center">
                                    <input type="checkbox" class="form-checkbox-student focus:ring-3 h-4 w-4 rounded-sm border border-gray-300 bg-gray-50 focus:ring-blue-300" />
                                </div>
                                <label class="ms-2 text-sm font-medium text-gray-900">Tampilkan Password</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="required font-regular mb-2 block text-sm text-gray-500">Alamat</label>
                            <textarea name="address" id="address" rows="3" class="@error('address') border-red-600 @enderror mt-2 w-full rounded-lg border p-2" placeholder="Alamat...">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="place_birth" class="required font-regular mb-2 block text-sm text-gray-500">Tempat
                                Lahir</label>
                            <input type="text" id="place_birth" name="place_birth" class="@error('place_birth') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Tempat Lahir..." value="{{ old('place_birth') }}" autocomplete="off" />
                            @error('place_birth')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="birth_date" class="required font-regular mb-2 block text-sm text-gray-500">Tanggal
                                Lahir</label>
                            <input type="date" id="birth_date" name="birth_date" class="@error('birth_date') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('birth_date') }}" autocomplete="off" />
                            @error('birth_date')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status" class="required font-regular mb-2 mt-4 block text-sm text-gray-600">Status</label>
                            <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                <option selected value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                            @error('status')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="required font-regular mb-2 block text-sm text-gray-500">Jenis
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
                        <div class="mb-4">
                            <label for="family_status" class="required font-regular mb-2 block text-sm text-gray-500">Status dalam
                                Keluarga</label>
                            <input type="text" id="family_status" name="family_status" class="@error('family_status') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Anak kandung/dll..." value="{{ old('family_status') }}" autocomplete="off" />
                            @error('family_status')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="child_order" class="required font-regular mb-2 block text-sm text-gray-500">Anak
                                ke</label>
                            <input type="number" id="child_order" name="child_order" class="@error('child_order') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="1/2/3/..." value="{{ old('child_order') }}" autocomplete="off" />
                            @error('child_order')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="required font-regular mb-2 block text-sm text-gray-500">Nomor
                                Telp</label>
                            <input type="text" id="phone" name="phone" class="@error('phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nomor Telp..." value="{{ old('phone') }}" autocomplete="off" />
                            @error('phone')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="id_religion" class="font-regular required mb-2 block text-sm text-gray-500">Agama</label>
                            <select name="id_religion" id="id_religion" name="id_religion" class="@error('id_religion') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                <option selected value="">-- Pilih Agama --</option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id_religion }}">{{ $religion->name }}</option>
                                @endforeach
                            </select>
                            @error('id_religion')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="prev_school" class="font-regular mb-2 block text-sm text-gray-500">Sekolah
                                Asal</label>
                            <input type="text" id="prev_school" name="prev_school" class="@error('prev_school') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Sekolah Asal..." value="{{ old('prev_school') }}" autocomplete="off" />
                            @error('prev_school')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="study_program" class="font-regular mb-2 block text-sm text-gray-500">Program
                                Studi</label>
                            <input type="text" id="study_program" name="study_program" class="@error('study_program') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Program Studi..." value="{{ old('study_program') }}" autocomplete="off" />
                            @error('study_program')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="image" class="mb-2 block text-sm font-medium text-gray-600">Foto</label>
                            <input type="file" id="image" name="image" class="block w-full rounded-lg p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" />
                            @error('image')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <h1 class="mb-5 text-sm font-medium text-slate-600">Data Orang Tua</h1>

                        <div class="mb-4">
                            <label for="father_name" class="font-regular mb-2 block text-sm text-gray-500">Nama
                                Ayah</label>
                            <input type="text" id="father_name" name="father_name" class="@error('father_name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama..." value="{{ old('father_name') }}" autocomplete="off" />
                            @error('father_name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="father_job" class="font-regular mb-2 block text-sm text-gray-500">Pekerjaan
                                Ayah</label>
                            <input type="text" id="father_job" name="father_job" class="@error('father_job') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Pekerjaan..." value="{{ old('father_job') }}" autocomplete="off" />
                            @error('father_job')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="father_phone" class="font-regular mb-2 block text-sm text-gray-500">Nomor Telp
                                Ayah</label>
                            <input type="text" id="father_phone" name="father_phone" class="@error('father_phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nomor Telp..." value="{{ old('father_phone') }}" autocomplete="off" />
                            @error('father_phone')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="father_address" class="font-regular mb-2 block text-sm text-gray-500">Alamat</label>
                            <textarea name="father_address" id="father_address" rows="3" class="@error('father_address') border-red-600 @enderror mt-2 w-full rounded-lg border p-2" placeholder="Alamat...">{{ old('father_address') }}</textarea>
                            @error('father_address')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="mother_name" class="font-regular mb-2 block text-sm text-gray-500">Nama
                                Ibu</label>
                            <input type="text" id="mother_name" name="mother_name" class="@error('mother_name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama..." value="{{ old('mother_name') }}" autocomplete="off" />
                            @error('mother_name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="mother_job" class="font-regular mb-2 block text-sm text-gray-500">Pekerjaan
                                Ibu</label>
                            <input type="text" id="mother_job" name="mother_job" class="@error('mother_job') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Pekerjaan..." value="{{ old('mother_job') }}" autocomplete="off" />
                            @error('mother_job')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="mother_phone" class="font-regular mb-2 block text-sm text-gray-500">Nomor Telp
                                Ibu</label>
                            <input type="text" id="mother_phone" name="mother_phone" class="@error('mother_phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nomor Telp..." value="{{ old('mother_phone') }}" autocomplete="off" />
                            @error('mother_phone')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="mother_address" class="font-regular mb-2 block text-sm text-gray-500">Alamat</label>
                            <textarea name="mother_address" id="mother_address" rows="3" class="@error('mother_address') border-red-600 @enderror mt-2 w-full rounded-lg border p-2" placeholder="Alamat...">{{ old('mother_address') }}</textarea>
                            @error('mother_address')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <h1 class="mb-5 text-sm font-medium text-slate-600">Data Wali</h1>

                        <div class="mb-4">
                            <label for="guardian_name" class="required font-regular mb-2 block text-sm text-gray-500">Nama
                                Wali/Orang tua</label>
                            <input type="text" id="guardian_name" name="guardian_name" class="@error('guardian_name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama..." value="{{ old('guardian_name') }}" autocomplete="off" />
                            @error('guardian_name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_username" class="required font-regular mb-2 block text-sm text-gray-500">Username
                                Wali/Orang tua</label>
                            <input type="text" id="guardian_username" name="guardian_username" class="@error('guardian_username') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Username Wali..." value="{{ old('guardian_username') }}" autocomplete="off" />
                            @error('guardian_username')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_email" class="required font-regular mb-2 block text-sm text-gray-600">Email</label>
                            <input type="email" id="guardian_email" name="guardian_email" class="@error('guardian_email') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Email Wali..." value="{{ old('guardian_email') }}" autocomplete="off" />
                            @error('guardian_email')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_password" class="required font-regular mb-2 block text-sm text-gray-500">Password
                                Wali/Orang tua</label>
                            <input type="password" id="guardian_password" name="guardian_password" class="@error('guardian_password') border-red-600 @enderror form-password-guardian block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Password Wali..." autocomplete="off" />
                            @error('guardian_password')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="flex items-start pt-4">
                                <div class="flex h-5 items-center">
                                    <input type="checkbox" class="form-checkbox-guardian focus:ring-3 h-4 w-4 rounded-sm border border-gray-300 bg-gray-50 focus:ring-blue-300" />
                                </div>
                                <label class="ms-2 text-sm font-medium text-gray-900">Tampilkan Password</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="guardian_phone" class="required font-regular mb-2 block text-sm text-gray-500">Nomor
                                Telp</label>
                            <input type="text" id="guardian_phone" name="guardian_phone" class="@error('guardian_phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nomor Telp..." value="{{ old('guardian_phone') }}" autocomplete="off" />
                            @error('guardian_phone')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="alt_phone" class="font-regular mb-2 block text-sm text-gray-500">Alternatif Nomor
                                Telp</label>
                            <input type="text" id="alt_phone" name="alt_phone" class="@error('alt_phone') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Alternatif Nomor Telpon..." value="{{ old('alt_phone') }}" autocomplete="off" />
                            @error('alt_phone')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_job" class="required font-regular mb-2 block text-sm text-gray-500">Pekerjaan</label>
                            <input type="text" id="guardian_job" name="guardian_job" class="@error('guardian_job') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Pekerjaan..." value="{{ old('guardian_job') }}" autocomplete="off" />
                            @error('guardian_job')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="guardian_address" class="required font-regular mb-2 block text-sm text-gray-500">Alamat</label>
                            <textarea name="guardian_address" id="guardian_address" rows="3" class="@error('guardian_address') border-red-600 @enderror mt-2 w-full rounded-lg border p-2" placeholder="Alamat...">{{ old('guardian_address') }}</textarea>
                            @error('guardian_address')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <h1 class="mb-5 text-sm font-medium text-slate-600">Diterima di Sekolah Ini</h1>
                        <div class="mb-4">
                            <label for="receive_date" class="required font-regular mb-2 block text-sm text-gray-500">Pada
                                Tanggal</label>
                            <input type="date" id="receive_date" name="receive_date" class="@error('receive_date') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('receive_date') }}" autocomplete="off" />
                            @error('receive_date')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="graduation_date" class="font-regular mb-2 block text-sm text-gray-500">Tanggal
                                Lulus</label>
                            <input type="date" id="graduation_date" name="graduation_date" class="@error('graduation_date') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('graduation_date') }}" autocomplete="off" />
                            @error('graduation_date')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
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
            $('.form-checkbox-student').click(function() {
                if ($(this).is(':checked')) {
                    $('.form-password-student').attr('type', 'text');
                } else {
                    $('.form-password-student').attr('type', 'password');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-checkbox-guardian').click(function() {
                if ($(this).is(':checked')) {
                    $('.form-password-guardian').attr('type', 'text');
                } else {
                    $('.form-password-guardian').attr('type', 'password');
                }
            });
        });
    </script>
@endsection
