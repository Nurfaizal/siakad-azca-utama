@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">

        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Absensi Mata Pelajaran
                </h1>
            </div>
            <div class="flex">
                <div class="flex">
                    <a href="/absensi-siswa/{{ Crypt::encrypt($schedule->id_schedule) }}"
                        class="ms-2 rounded-lg bg-red-100 px-3 py-2 font-semibold text-red-700 duration-150 ease-linear hover:bg-red-200"><i
                            class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                </div>
            </div>
        </div>
        <div class="body mt-5">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/absensi-siswa/{{ Crypt::encrypt($schedule->id_schedule) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="overflow-x-scroll">
                    <table class="tables w-full mb-10">
                        <tbody>
                            <tr>
                                <td class="text-slate-700 font-light" width="150">Mata Pelajaran</td>
                                <td class="text-slate-700 font-light" width="20">:</td>
                                <td class="text-slate-700 font-light">{{ $schedule->subject->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-slate-700 font-light">Kelas</td>
                                <td class="text-slate-700 font-light">:</td>
                                <td class="text-slate-700 font-light">{{ $schedule->class->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-slate-700 font-light">Check In</td>
                                <td class="text-slate-700 font-light">:</td>
                                <td class="text-slate-700 font-light" id="check_in_time"></td>
                            </tr>
                            <tr>
                                <td class="text-slate-700 font-light">Tanggal</td>
                                <td class="text-slate-700 font-light">:</td>
                                <td class="text-slate-700 font-light">{{ now()->format('Y-m-d') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-slate-700 font-light">Pembelajaran</td>
                                <td class="text-slate-700 font-light">:</td>
                                <td class="text-slate-700 font-light">
                                    <select name="mode" id="mode" name="mode"
                                        class="@error('mode') border-red-600 @enderror min-w-32 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                        <option selected value="offline">Luring (Offline)</option>
                                        <option value="online">Daring (Online)</option>
                                    </select>
                                    @error('mode')
                                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="text-slate-700 font-light">Gambar</td>
                                <td class="text-slate-700 font-light">:</td>
                                <td class="text-slate-700 font-light">
                                    <input type="file" id="image" name="image"
                                        class="block min-w-32 w-full rounded-lg p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" />
                                    @error('image')
                                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="text-slate-700 font-light">Deskripsi</td>
                                <td class="text-slate-700 font-light">:</td>
                                <td class="text-slate-700 font-light">
                                    <textarea name="description" id="description" rows="3"
                                        class="@error('description') border-red-600 @enderror mt-2 w-full rounded-lg border p-2" placeholder="Deskripsi...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table id="pagination-table-100" class="w-full">
                    <thead>
                        <tr>
                            <th class="border" style="width: 15px !important;">
                                <div class="flex h-full items-center justify-center">No</div>
                            </th>
                            <th class="border">
                                <div class="flex h-full items-center">Nis</div>
                            </th>
                            <th class="border">
                                <div class="flex h-full items-center">Nama</div>
                            </th>
                            <th class="border">
                                <div class="flex h-full items-center">Status</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="whitespace-nowrap text-center font-medium text-gray-900">{{ $loop->iteration }}
                                </td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <select name="status[]" id="status" name="status"
                                        class="@error('status') border-red-600 @enderror min-w-24 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                        <option sselected value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alpha">Alpha</option>
                                    </select>
                                    @error('status')
                                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5 flex justify-end">
                    <button type="submit"
                        class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function updateCheckInTime() {
            const now = new Date();
            const checkInTime = now.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('check_in_time').textContent = checkInTime;
        }

        // Update waktu setiap 1 detik
        setInterval(updateCheckInTime, 1000);

        // Inisialisasi saat halaman pertama dimuat
        updateCheckInTime();
    </script>
@endsection
