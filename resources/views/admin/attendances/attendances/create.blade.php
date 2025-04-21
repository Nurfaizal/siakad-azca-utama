@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Lokasi Absensi</h1>
            </div>
            <div>
                <a href="/lokasi-gps" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
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
                                <label class="block text-sm font-medium text-gray-600">Latitude: <input type="text" class="@error('latitude') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 read-only:bg-slate-100 focus:border-red-500 focus:ring-red-500" name="latitude" id="latitude" readonly></label><br>
                                <label class="block text-sm font-medium text-gray-600">Longitude: <input type="text" class="@error('longitude') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 read-only:bg-slate-100 focus:border-red-500 focus:ring-red-500" name="longitude" id="longitude" readonly></label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label for="name" class="required mb-2 block text-sm font-medium text-gray-600">Nama
                                Lokasi</label>
                            <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama Lokasi..." value="{{ old('name') }}" autocomplete="off" />
                            @error('name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="distance" class="required mb-2 block text-sm font-medium text-gray-600">Jarak Radius
                                (meter)</label>
                            <input type="number" id="distance" name="distance" class="@error('distance') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Jarak Radius..." value="{{ old('distance') }}" autocomplete="off" />
                            @error('distance')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="required mb-2 block text-sm font-medium text-gray-600">Alamat</label>
                            <textarea name="address" id="address" rows="3" class="@error('address') border-red-600 @enderror mt-2 w-full rounded-lg border p-2 text-sm text-slate-600" placeholder="Alamat...">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="mb-2 block text-sm font-medium text-gray-600">Deskripsi</label>
                            <textarea name="description" id="description" rows="3" class="@error('description') border-red-600 @enderror mt-2 w-full rounded-lg border p-2 text-sm text-slate-600" placeholder="Deskripsi...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 grid grid-cols-1 gap-3 md:grid-cols-2">
                            <div class="relative">
                                <label for="start_time" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                                    Masuk</label>
                                <input type="time" id="start_time" name="start_time" class="@error('start_time') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('start_time') }}" />
                                <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                                @error('start_time')
                                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="end_time" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                                    Keluar</label>
                                <input type="time" id="end_time" name="end_time" class="@error('end_time') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('end_time') }}" />
                                <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                                @error('end_time')
                                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="status" class="required mb-2 block text-sm font-medium text-gray-600">Status</label>
                            <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                <option selected value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif"> Non-Aktif</option>
                            </select>
                            @error('status')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Titik awal map (misalnya Indonesia)
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


        // Load tile (map background)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Marker awal
        let marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        // Update input saat marker digeser
        marker.on('dragend', function(e) {
            const latLng = e.target.getLatLng();
            updateLatLng(latLng.lat, latLng.lng);
        });

        // Update input saat map diklik
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            updateLatLng(lat, lng);
        });

        // Fungsi update input koordinat
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
