@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6 mb-10">

        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Absensi Kehadiran</h1>
            </div>
            <div class="flex">

            </div>
        </div>
        <div class="body mt-5">
            <div class="mb-16">
                <div class="flex justify-center mb-8">
                    <div id="clock"
                        class="flex gap-2 justify-center bg-gray-200 p-4 rounded-2xl text-slate-800 w-fit mx-auto">
                        <div class="flex flex-col items-center px-4 py-2">
                            <span id="hours" class="text-3xl font-semibold">00</span>
                            <span class="text-sm mt-1">Jam</span>
                        </div>
                        <div class="flex flex-col items-center px-4 py-2 border-l border-slate-600">
                            <span id="minutes" class="text-3xl font-semibold">00</span>
                            <span class="text-sm mt-1">Menit</span>
                        </div>
                        <div class="flex flex-col items-center px-4 py-2 border-l border-slate-600">
                            <span id="seconds" class="text-3xl font-semibold">00</span>
                            <span class="text-sm mt-1">Detik</span>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2  focus:outline-none "
                        type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                        aria-controls="drawer-example">
                        Informasi Absensi
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
                <div class="flex justify-center items-center flex-col">
                    <img src="{{ asset('assets/img/signin-icon.png') }}" alt="attendance" class="w-20 object-cover">
                    <h1 class="font-bold text-slate-600 text-2xl py-5 text-center">Absensi Masuk</h1>

                    <button id="modal-checkin" data-modal-target="checkin-modal" data-modal-toggle="checkin-modal"
                        type="button" {{ $attendanceToday && $attendanceToday->check_in ? 'disabled' : '' }}
                        class="disabled:bg-green-400  bg-green-600 text-white w-36 h-10 rounded uppercase font-semibold hover:bg-green-500 ease-linear duration-150">Masuk</button>

                </div>
                <div class="flex justify-center items-center flex-col">
                    <img src="{{ asset('assets/img/warning-icon.png') }}" alt="attendance" class="w-20 object-cover">
                    <h1 type="button" class="font-bold text-slate-600 text-2xl py-5 text-center">Izin/Sakit</h1>
                    <button {{ $attendanceToday && $attendanceToday->check_in ? 'disabled' : '' }}
                        data-modal-target="izinsakit-modal" data-modal-toggle="izinsakit-modal"
                        class="disabled:bg-orange-400 bg-orange-600 text-white w-36 h-10 rounded uppercase font-semibold hover:bg-orange-500 ease-linear duration-150">Konfirmasi</button>
                </div>
                <div class="flex justify-center items-center flex-col">
                    <img src="{{ asset('assets/img/signout-icon.png') }}" alt="attendance" class="w-20 object-cover">
                    <h1 class="font-bold text-slate-600 text-2xl py-5 text-center">Absensi Pulang</h1>
                    <form action="/absen-lokasi/checkout" method="post">
                        @csrf
                        <button {{ !$attendanceToday ? 'disabled' : '' }}
                            class="disabled:bg-red-400 bg-red-600 text-white w-36 h-10 rounded uppercase font-semibold hover:bg-red-500 ease-linear duration-150">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">

        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Rekap Absensi</h1>
            </div>
            <div class="flex">

            </div>
        </div>
        <div class="body mt-5">
            <table id="pagination-table" class="w-full">
                <thead>
                    <tr>
                        <th class="border" style="width: 15px !important;">
                            <div class="flex h-full items-center justify-center">No</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Hari/Tanggal</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam Masuk</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam Keluar</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Gambar</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Deskripsi</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Status</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attend)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">1</td>
                            <td>{{ \Carbon\Carbon::parse($attend->created_at)->translatedFormat('l, d F Y') }}</td>
                            @php
                                $checkInTime = \Carbon\Carbon::parse($attend->check_in);
                                $startTime = \Carbon\Carbon::parse($attend->gpsLocation->start_time)->addMinutes(
                                    $attend->gpsLocation->late_tolerance,
                                );
                                $isLate = $checkInTime->gt($startTime);
                            @endphp

                            <td class="{{ $isLate ? 'text-red-600' : '' }}">
                                {{ $attend->check_in }} @if ($isLate)
                                    <i class="bi bi-alarm"></i>
                                @endif
                            </td>
                            <td>{{ $attend->check_out ?? 'Belum absensi keluar' }}</td>
                            <td>
                                @php
                                    $fileData = null;
                                    $fileExt = null;

                                    if ($attend->image != null) {
                                        try {
                                            $foto = \Yaza\LaravelGoogleDriveStorage\Gdrive::get(
                                                'attendances-location/' . $attend->image,
                                            );
                                            if ($foto) {
                                                $fileData = base64_encode($foto->file);
                                                $fileExt = $foto->ext;
                                            }
                                        } catch (\Exception $e) {
                                            \Log::error('Gagal mengambil gambar dari Gdrive: ' . $e->getMessage());
                                        }
                                    }
                                @endphp

                                @if ($fileData && $fileExt)
                                    <img src="data:image/{{ $fileExt }};base64,{{ $fileData }}" alt="Foto Staff"
                                        class="object-cover w-52 h-32 my-2">
                                @endif
                            </td>
                            <td>{{ $attend->description }}</td>
                            <td>
                                <h1>
                                    @if ($attend->status == 'hadir')
                                        <i class="bi bi-check-circle-fill text-green-600"></i>
                                    @elseif ($attend->status == 'sakit')
                                        <i class="bi bi-info-circle-fill text-sky-600"></i>
                                    @elseif ($attend->status == 'izin')
                                        <i class="bi bi-exclamation-circle-fill text-orange-600"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-red-600"></i>
                                    @endif
                                </h1>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Main modal -->
    <div id="checkin-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="bi bi-calendar-week pe-2"></i> Form Absensi Kehadiran
                    </h3>
                    <button type="button"
                        class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="checkin-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="/absen-lokasi" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-3 grid-cols-2">
                        <div class="col-span-2">
                            <div class="flex justify-center mb-3">
                                <video id="camera" autoplay playsinline class="rounded-md border" width="100%"
                                    height="auto"></video>
                            </div>

                            <div class="flex justify-center mb-3">
                                <button type="button" id="capture"
                                    class="bg-teal-500 hover:bg-teal-600 text-white w-12 h-12 rounded-full text-2xl shadow-lg">
                                    <i class="bi bi-camera text-white text-lg"></i>
                                </button>
                            </div>

                            <canvas id="canvas" class="hidden w-full mb-4"></canvas>

                            <div class="flex justify-center mb-3">
                                <button type="button" id="retake"
                                    class="bg-teal-500 hidden hover:bg-teal-600 text-white h-12 w-12 rounded-full text-2xl shadow-lg">
                                    <i class="bi bi-arrow-clockwise text-white text-lg"></i>
                                </button>
                            </div>

                            <input type="file" name="image" required id="image-data" class="hidden">
                            @error('image')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">

                            <input type="hidden" name="status" value="hadir">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                        </div>
                    </div>
                    <p id="locationDisplay" class="text-center text-slate-700 font-light mb-3">🔃 Mengambil lokasi...</p>
                    <p class="text-slate-500 text-xs font-light text-center italic mb-5"><span
                            class="text-red-600">*</span>
                        Jika lokasi tidak sesuai,
                        silahkan refresh halaman.</p>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" data-modal-toggle="checkin-modal"
                            class="close-modal text-gray-700 inline-flex justify-center items-center border bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                            Batalkan
                        </button>
                        <button type="submit"
                            class="text-white inline-flex justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="izinsakit-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="bi bi-calendar-week pe-2"></i> Form Absensi Kehadiran
                    </h3>
                    <button type="button"
                        class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="izinsakit-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="/absen-lokasi" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-3 grid-cols-2">
                        <div class="col-span-2">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select id="category" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                            </select>
                            @error('status')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="image"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surat
                                Izin/Sakit</label>
                            <input type="file" name="image" id="image"
                                class="bg-gray-50  text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                required="">
                            @error('image')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                            <h6 class="text-slate-500 font-light italic text-xs">Format gambar: jpeg, png, jpg</h6>
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Deskripsi Keterangan</label>
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Tuliskan deskripsi disini"></textarea>
                            @error('decsription')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" data-modal-toggle="izinsakit-modal"
                            class="close-modal text-gray-700 inline-flex justify-center items-center border bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                            Batalkan
                        </button>
                        <button type="submit"
                            class="text-white inline-flex justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- drawer component -->
    <div id="drawer-example" style="z-index: 99999 !important;"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-96"
        tabindex="-1" aria-labelledby="drawer-label">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500"><svg
                class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>Info</h5>
        <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center ">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <h1 class="text-center text-slate-700 font-semibold my-5">{{ $gpsLocation->name }}</h1>
        <iframe width="100%" height="250" class="rounded-md mb-5" style="border:0;" loading="lazy" allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps?q={{ $gpsLocation->latitude }},{{ $gpsLocation->longitude }}&z=18&output=embed">
        </iframe>


        <table class="tables w-full mb-5">
            <tr>
                <td class="text-sm text-slate-600 font-light" width="100">Jam Masuk</td>
                <td class="text-sm text-slate-600 font-light" width="20">:</td>
                <td class="text-sm text-slate-600 font-light">{{ $gpsLocation->start_time }} (WITA)</td>
            </tr>
            <tr>
                <td class="text-sm text-slate-600 font-light">Jam Keluar</td>
                <td class="text-sm text-slate-600 font-light">:</td>
                <td class="text-sm text-slate-600 font-light">{{ $gpsLocation->end_time }} (WITA)</td>
            </tr>
            <tr>
                <td class="text-sm text-slate-600 font-light">Alamat</td>
                <td class="text-sm text-slate-600 font-light">:</td>
                <td class="text-sm text-slate-600 font-light">{{ $gpsLocation->address }}</td>
            </tr>
            <tr>
                <td class="text-sm text-slate-600 font-light">Toleransi Terlambat</td>
                <td class="text-sm text-slate-600 font-light">:</td>
                <td class="text-sm text-slate-600 font-light">{{ $gpsLocation->late_tolerance }} menit</td>
            </tr>
            <tr>
                <td class="text-sm text-slate-600 font-light">Hari Aktif</td>
                <td class="text-sm text-slate-600 font-light">:</td>
                <td class="text-sm text-slate-600 font-light">
                    {{ $gpsLocation->days->pluck('day')->implode(', ') }}
                </td>
            </tr>

        </table>

        <p class="mb-6 text-sm text-gray-500 ">{{ $gpsLocation->description }}
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('error') }}!",
                icon: "error"
            });
        </script>
    @endif

    <script>
        function updateClock() {
            const now = new Date();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            document.getElementById("hours").textContent = hours;
            document.getElementById("minutes").textContent = minutes;
            document.getElementById("seconds").textContent = seconds;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>

    <script>
        let stream = null;

        function toggleCamera(video, type) {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "user"
                        },
                        audio: false
                    })
                    .then(stream => {
                        if (type === "on") {
                            stream = stream;
                            video.srcObject = stream;
                        } else {
                            stream.getTracks().forEach(track => track.stop());
                            video.srcObject = null;
                        }
                    })
                    .catch(err => {
                        alert("Gagal mengakses kamera: " + err.message);
                    });
            } else {
                alert("Browser ini tidak mendukung akses kamera.");
            }
        }





        $('#modal-checkin').on('click', () => {
            const video = document.getElementById('camera');
            const canvas = document.getElementById('canvas');
            const captureBtn = document.getElementById('capture');
            const imageInput = document.getElementById('image-data');


            toggleCamera(video, "on");

            captureBtn.addEventListener('click', () => {
                const context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                const imageData = canvas.toDataURL('image/jpeg');
                $('#canvas').removeClass("hidden");
                $('#retake').removeClass("hidden");
                $('#camera').hide();
                $('#capture').hide();

                // Convert to blob and inject to file input
                canvas.toBlob(blob => {
                    const file = new File([blob], `photo-${Date.now()}.jpeg`, {
                        type: "image/jpeg"
                    });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    imageInput.files = dataTransfer.files;
                }, "image/jpeg");

                toggleCamera(video, "off");
            });

            $('#retake').on('click', () => {
                toggleCamera(video, "on");
                $('#camera').show();
                $('#capture').show();
                $('#canvas').addClass("hidden");
                $('#retake').toggleClass("hidden");
            })

            $('#close-modal').on('click', () => {
                toggleCamera(video, "off");
            })
        })

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                document.getElementById("locationDisplay").innerText = "Geolocation tidak didukung browser.";
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const long = position.coords.longitude;


            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${long}&format=json`)
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name;
                    document.getElementById("locationDisplay").innerText = `🗺️ ${address}`;
                })
                .catch(error => console.error("Error:", error));


            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = long;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Akses lokasi ditolak!");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan lokasi timeout.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan tidak diketahui.");
                    break;
            }
        }

        $(document).ready(() => {
            getLocation();
        })
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}!",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}!",
                icon: "error"
            });
        </script>
    @endif

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
