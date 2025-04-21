@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Edit Pengaturan Umum</h1>
            </div>

        </div>
        <div class="body">

            <form class="my-6" action="/pengaturan-umum/{{ Crypt::encrypt($general->id_general_setting) }}" method="post">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-600">Nama Sekolah</label>
                        <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama Sekolah..." value="{{ $general->name }}" autocomplete="off" />
                        @error('name')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="npsn" class="mb-2 block text-sm font-medium text-gray-600">NPSN</label>
                        <input type="text" id="npsn" name="npsn" class="@error('npsn') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="NPSN..." value="{{ $general->npsn }}" autocomplete="off" />
                        @error('npsn')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="education_form" class="mb-2 block text-sm font-medium text-gray-600">Bentuk Pendidikan</label>
                        <select name="education_form" id="education_form" name="education_form" class="@error('education_form') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $general->education_form }}">-- {{ $general->education_form }} --</option>
                            <option value="Kelompok Bermain (KB)">Kelompok Bermain (KB)</option>
                            <option value="Taman Kanak-kanak Negeri (TKN)">Taman Kanak-kanak Negeri (TKN)</option>
                            <option value="Taman Kanak-kanak Swasta (TK)">Taman Kanak-kanak Swasta (TK)</option>
                            <option value="Sekolah Dasar Negeri (SDN)">Sekolah Dasar Negeri (SDN)</option>
                            <option value="Sekolah Dasar Swasta (SD)">Sekolah Dasar Swasta (SD)</option>
                            <option value="Sekolah Dasar Islam Terpadu (SDIT)">Sekolah Dasar Islam Terpadu (SDIT)</option>
                            <option value="Sekolah Menengah Pertama Negeri (SMPN)">Sekolah Menengah Pertama Negeri (SMPN)</option>
                            <option value="Sekolah Menengah Pertama Swasta (SMP)">Sekolah Menengah Pertama Swasta (SMP)</option>
                            <option value="Sekolah Menengah Pertama Islam Terpadu (SMPIT)">Sekolah Menengah Pertama Islam Terpadu (SMPIT)</option>
                            <option value="Sekolah Menengah Atas Negeri (SMAN)">Sekolah Menengah Atas Negeri (SMAN)</option>
                            <option value="Sekolah Menengah Atas Swasta (SMA)">Sekolah Menengah Atas Swasta (SMA)</option>
                            <option value="Sekolah Menengah Atas Islam Terpadu (SMAIT)">Sekolah Menengah Atas Islam Terpadu (SMAIT)</option>
                            <option value="Sekolah Menengah Kejuruan Negeri (SMKN)">Sekolah Menengah Kejuruan Negeri (SMKN)</option>
                            <option value="Sekolah Menengah Kejuruan Swasta (SMK)">Sekolah Menengah Kejuruan Swasta (SMK)</option>
                            <option value="Sekolah Menengah Kejuruan Islam Terpadu (SMKIT)">Sekolah Menengah Kejuruan Islam Terpadu (SMKIT)</option>
                            <option value="Pusat Kegiatan Belajar Masyarakat (PKBM)">Pusat Kegiatan Belajar Masyarakat (PKBM)</option>
                            <option value="Bimbingan Belajar (BIMBEL)">Bimbingan Belajar (BIMBEL)</option>
                            <option value="Perguruan Tinggi Negeri (PTN)">Perguruan Tinggi Negeri (PTN)</option>
                            <option value="Perguruan Tinggi Swasta (PTS)">Perguruan Tinggi Swasta (PTS)</option>
                        </select>
                        @error('education_form')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="school_status" class="mb-2 block text-sm font-medium text-gray-600">Status Sekolah</label>
                        <input type="text" id="school_status" name="school_status" class="@error('school_status') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Status Sekolah..." value="{{ $general->school_status }}" autocomplete="off" />
                        @error('school_status')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="ownership_status" class="mb-2 block text-sm font-medium text-gray-600">Status Kepemilikan</label>
                        <input type="text" id="ownership_status" name="ownership_status" class="@error('ownership_status') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Status Sekolah..." value="{{ $general->ownership_status }}" autocomplete="off" />
                        @error('ownership_status')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_year" class="mb-2 block text-sm font-medium text-gray-600">Tahun Ajaran</label>
                        <select name="id_year" id="id_year" name="id_year" class="@error('id_year') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $general->id_year }}">-- {{ $general->school_year->name }} --</option>
                            @foreach ($school_year as $sy)
                                <option value="{{ $sy->id_year }}">{{ $sy->name }}</option>
                            @endforeach
                        </select>
                        @error('id_year')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="neighborhood" class="mb-2 block text-sm font-medium text-gray-600">Kelurahan/desa</label>
                        <input type="text" id="neighborhood" name="neighborhood" class="@error('neighborhood') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Status Sekolah..." value="{{ $general->neighborhood }}" autocomplete="off" />
                        @error('neighborhood')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="district" class="mb-2 block text-sm font-medium text-gray-600">Kabupaten/kota</label>
                        <input type="text" id="district" name="district" class="@error('district') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Status Sekolah..." value="{{ $general->district }}" autocomplete="off" />
                        @error('district')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="province" class="mb-2 block text-sm font-medium text-gray-600">Provinsi</label>
                        <input type="text" id="province" name="province" class="@error('province') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Status Sekolah..." value="{{ $general->province }}" autocomplete="off" />
                        @error('province')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pos_code" class="mb-2 block text-sm font-medium text-gray-600">Kode Pos</label>
                        <input type="text" id="pos_code" name="pos_code" class="@error('pos_code') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Status Sekolah..." value="{{ $general->pos_code }}" autocomplete="off" />
                        @error('pos_code')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="mb-2 block text-sm font-medium text-gray-600">Alamat Lengkap Sekolah</label>
                        <input type="text" id="address" name="address" class="@error('address') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Status Sekolah..." value="{{ $general->address }}" autocomplete="off" />
                        @error('address')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-600">No.Telp</label>
                        <input type="text" id="phone" name="phone" class="@error('phone') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="No.Telp..." value="{{ $general->phone }}" autocomplete="off" />
                        @error('phone')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fax" class="mb-2 block text-sm font-medium text-gray-600">Fax</label>
                        <input type="text" id="fax" name="fax" class="@error('fax') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Fax..." value="{{ $general->fax }}" autocomplete="off" />
                        @error('fax')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-600">Email</label>
                        <input type="text" id="email" name="email" class="@error('email') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Email..." value="{{ $general->email }}" autocomplete="off" />
                        @error('email')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="website" class="mb-2 block text-sm font-medium text-gray-600">Website</label>
                        <input type="text" id="website" name="website" class="@error('website') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Website..." value="{{ $general->website }}" autocomplete="off" />
                        @error('website')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="principal" class="mb-2 block text-sm font-medium text-gray-600">Kepala Sekolah</label>
                        <input type="text" id="principal" name="principal" class="@error('principal') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Kepala Sekolah..." value="{{ $general->principal }}" autocomplete="off" />
                        @error('principal')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="principal_nip" class="mb-2 block text-sm font-medium text-gray-600">NIP Kepala Sekolah</label>
                        <input type="text" id="principal_nip" name="principal_nip" class="@error('principal_nip') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="NIP Kepala Sekolah..." value="{{ $general->principal_nip }}" autocomplete="off" />
                        @error('principal_nip')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="administration_head" class="mb-2 block text-sm font-medium text-gray-600">Kepala Tata Usaha</label>
                        <input type="text" id="administration_head" name="administration_head" class="@error('administration_head') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Kepala Tata Usaha..." value="{{ $general->administration_head }}" autocomplete="off" />
                        @error('administration_head')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="vision" class="mb-2 block text-sm font-medium text-gray-900">Visi</label>
                        <textarea id="vision" rows="4" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="Visi...">{{ $general->vision }}</textarea>
                        @error('vision')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mission" class="mb-2 block text-sm font-medium text-gray-900">Misi</label>
                        <textarea id="mission" rows="4" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="Visi...">{{ $general->mission }}</textarea>
                        @error('mission')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="school_day" class="mb-2 block text-sm font-medium text-gray-600">Hari Sekolah</label>
                        <select name="school_day" id="school_day" name="school_day" class="@error('school_day') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $general->school_day }}">-- {{ $general->school_day }} --</option>
                            <option value="Senin s/d Jumat">Senin s/d Jumat</option>
                            <option value="Senin s/d Sabtu">Senin s/d Sabtu</option>
                            <option value="Setiap Hari">Setiap Hari</option>
                        </select>
                        @error('school_day')
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('update'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('update') }}!",
                icon: "info"
            });
        </script>
    @endif
@endsection
