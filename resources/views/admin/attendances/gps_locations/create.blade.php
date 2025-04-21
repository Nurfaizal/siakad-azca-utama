@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Mata Pelajaran</h1>
            </div>
            <div>
                <a href="/lokasi-gps"
                    class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i
                        class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/lokasi-gps" method="post">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <div>
                            <div id="map" class="rounded-lg"></div>
                            <div style="margin-top: 1rem;">
                                <label class=" block text-sm font-medium text-gray-600 ">Latitude: <input type="text"
                                        class="@error('latitude') border-red-600 @enderror read-only:bg-slate-100 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        name="latitude" id="latitude" readonly></label><br>
                                <label class=" block text-sm font-medium text-gray-600 ">Longitude: <input type="text"
                                        class="@error('longitude') border-red-600 @enderror read-only:bg-slate-100 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        name="longitude" id="longitude" readonly></label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-600 required">Nama
                                Lokasi</label>
                            <input type="text" id="name" name="name"
                                class="@error('name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="Nama Lokasi..." value="{{ old('name') }}" autocomplete="off" />
                            @error('name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                            <div>
                                <label for="distance" class="mb-2 block text-sm font-medium text-gray-600 required">Jarak
                                    Radius
                                    (meter)</label>
                                <input type="number" id="distance" name="distance"
                                    class="@error('distance') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                    placeholder="Jarak Radius..." value="{{ old('distance') }}" autocomplete="off" />
                                @error('distance')
                                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="late_tolerance"
                                    class="mb-2 block text-sm font-medium text-gray-600 required">Toleransi Terlambat
                                    (menit)</label>
                                <input type="number" id="late_tolerance" name="late_tolerance"
                                    class="@error('late_tolerance') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                    placeholder="15" value="{{ old('late_tolerance') }}" autocomplete="off" />
                                @error('late_tolerance')
                                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Alamat</label>
                            <textarea name="address" id="address" rows="3"
                                class="@error('address') border-red-600 @enderror text-slate-600 text-sm mt-2 w-full rounded-lg border p-2"
                                placeholder="Alamat...">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-600">Deskripsi</label>
                            <textarea name="description" id="description" rows="3"
                                class="@error('description') border-red-600 @enderror text-slate-600 text-sm mt-2 w-full rounded-lg border p-2"
                                placeholder="Deskripsi...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5">
                            <div class="relative">
                                <label for="start_time" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                                    Masuk</label>
                                <input type="time" id="start_time" name="start_time"
                                    class="@error('start_time') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                    value="{{ old('start_time') }}" />
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
                                    value="{{ old('end_time') }}" />
                                <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                                @error('end_time')
                                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-3 mb-3">
                            <label for="senin" class="required block text-sm font-medium text-gray-600">Hari</label>
                            <div class="flex flex-wrap gap-2">
                                <input type="checkbox" name="days[]" value="senin" id="senin"
                                    class="hidden peer/senin" />
                                <label for="senin"
                                    class="cursor-pointer px-4 py-2 rounded border border-gray-300 bg-white text-gray-700 
                                        hover:bg-teal-500 hover:text-white 
                                        peer-checked/senin:bg-teal-500 peer-checked/senin:text-white transition">
                                    Senin
                                </label>
                                <input type="checkbox" name="days[]" value="selasa" id="selasa"
                                    class="hidden peer/selasa" />
                                <label for="selasa"
                                    class="cursor-pointer px-4 py-2 rounded border border-gray-300 bg-white text-gray-700 
                                        hover:bg-teal-500 hover:text-white 
                                        peer-checked/selasa:bg-teal-500 peer-checked/selasa:text-white transition">
                                    Selasa
                                </label>
                                <input type="checkbox" name="days[]" value="rabu" id="rabu"
                                    class="hidden peer/rabu" />
                                <label for="rabu"
                                    class="cursor-pointer px-4 py-2 rounded border border-gray-300 bg-white text-gray-700 
                                        hover:bg-teal-500 hover:text-white 
                                        peer-checked/rabu:bg-teal-500 peer-checked/rabu:text-white transition">
                                    Rabu
                                </label>
                                <input type="checkbox" name="days[]" value="kamis" id="kamis"
                                    class="hidden peer/kamis" />
                                <label for="kamis"
                                    class="cursor-pointer px-4 py-2 rounded border border-gray-300 bg-white text-gray-700 
                                        hover:bg-teal-500 hover:text-white 
                                        peer-checked/kamis:bg-teal-500 peer-checked/kamis:text-white transition">
                                    Kamis
                                </label>
                                <input type="checkbox" name="days[]" value="jumat" id="jumat"
                                    class="hidden peer/jumat" />
                                <label for="jumat"
                                    class="cursor-pointer px-4 py-2 rounded border border-gray-300 bg-white text-gray-700 
                                        hover:bg-teal-500 hover:text-white 
                                        peer-checked/jumat:bg-teal-500 peer-checked/jumat:text-white transition">
                                    Jumat
                                </label>
                                <input type="checkbox" name="days[]" value="sabtu" id="sabtu"
                                    class="hidden peer/sabtu" />
                                <label for="sabtu"
                                    class="cursor-pointer px-4 py-2 rounded border border-gray-300 bg-white text-gray-700 
                                        hover:bg-teal-500 hover:text-white 
                                        peer-checked/sabtu:bg-teal-500 peer-checked/sabtu:text-white transition">
                                    Sabtu
                                </label>
                                <input type="checkbox" name="days[]" value="minggu" id="minggu"
                                    class="hidden peer/minggu" />
                                <label for="minggu"
                                    class="cursor-pointer px-4 py-2 rounded border border-gray-300 bg-white text-gray-700 
                                        hover:bg-teal-500 hover:text-white 
                                        peer-checked/minggu:bg-teal-500 peer-checked/minggu:text-white transition">
                                    Minggu
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-10 flex justify-end">
                    <button type="submit"
                        class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const defaultLat = -5.165882;
        const defaultLng = 119.486128;

        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.Control.geocoder({
                defaultMarkGeocode: false
            })
            .on('markgeocode', function(e) {
                const latlng = e.geocode.center;
                map.setView(latlng, 16);
                marker.setLatLng(latlng);
                updateLatLng(latlng.lat, latlng.lng);
            })
            .addTo(map);


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        marker.on('dragend', function(e) {
            const latLng = e.target.getLatLng();
            updateLatLng(latLng.lat, latLng.lng);
        });

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            updateLatLng(lat, lng);
        });

        function updateLatLng(lat, lng) {
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name || 'Alamat tidak ditemukan';
                    document.getElementById('address').value = address;
                })
                .catch(error => {
                    console.error('Gagal mendapatkan alamat:', error);
                    document.getElementById('address').value = 'Gagal memuat alamat';
                });
        }

        // Inisialisasi nilai awal input
        updateLatLng(defaultLat, defaultLng);
    </script>
@endsection
