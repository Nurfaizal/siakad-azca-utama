@php
    $activeMenu ?? 'dashboard';
@endphp

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    {{-- datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

    {{-- select2 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('/src/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    @if ($activeMenu == 'attendance')
        {{-- map --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    @endif

    <link rel="stylesheet" href="{{ asset('src/css/temp.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* width */
        #ysidebar::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        #ysidebar::-webkit-scrollbar-track {
            background: #f7f7f7;
        }

        /* Handle */
        #ysidebar::-webkit-scrollbar-thumb {
            background: #e3e1e1;
            border-radius: 2px;
        }

        /* Handle on hover */
        #ysidebar::-webkit-scrollbar-thumb:hover {
            background: #b7b7b7;
            cursor: grab
        }

        #map {
            height: 400px;
        }
    </style>
</head>

<body class="bg-slate-200">



    <nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-white">
        <div class="px-3 py-5 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 sm:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="#" class="ms-2 flex md:me-24">
                        <img src="{{ asset('assets/img/logo-azca.png') }}" class="me-3 h-8" alt="FlowBite Logo" />
                        <span class="self-center whitespace-nowrap text-xl font-semibold sm:text-2xl">SIAKAD AZCA</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="ms-3 flex items-center">
                        <div>
                            <button type="button"
                                class="flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded-sm bg-white text-base shadow-sm"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    {{ Auth::user()->username }}
                                </p>
                                <p class="truncate text-sm font-medium text-gray-900" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">

                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                    <form id="logout-form" action="/logout" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white pt-20 transition-transform sm:translate-x-0"
        aria-label="Sidebar">
        <div id="ysidebar" class="h-full overflow-y-auto bg-white px-3 pb-4">

            @php
                $user = Auth::user();
                $level = $user->level->pluck('level')->toArray();
            @endphp

            <ul class="font-reguler space-y-2">
                <li>
                    <a href="/dashboard"
                        class="{{ $activeMenu == 'dashboard' ? 'bg-red-100' : '' }} group flex items-center rounded-lg p-2 text-sm text-gray-900 hover:bg-red-100">
                        <i class="bi bi-pie-chart text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/profile"
                        class="{{ $activeMenu == 'profile' ? 'bg-red-100' : '' }} group flex items-center rounded-lg p-2 text-sm text-gray-900 hover:bg-red-100">
                        <i class="bi bi-person-badge text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true"></i>
                        <span class="ms-3">Profile</span>
                    </a>
                </li>

                @if (in_array('admin', $level) || in_array('staff', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'academic' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <i class="bi bi-backpack4 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Akademik</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden space-y-2 py-2">
                            <li>
                                <a href="/kelas"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">Data
                                    Kelas</a>
                            </li>
                            <li>
                                <a href="/mutasi-kelas"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">Mutasi
                                    Kelas</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'staff' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-gurustaff" data-collapse-toggle="dropdown-gurustaff">
                            <i class="bi bi-person-lines-fill text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Guru
                                & Staff</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-gurustaff" class="hidden space-y-2 py-2">
                            <li>
                                <a href="/staff"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Data Guru & Staff</a>
                            </li>
                            <li>
                                <a href="/staff-non-aktif"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Guru & Staff Non Aktif</a>
                            </li>
                            <li>
                                <a href="/gaji-staff"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Gaji Guru & Staff</a>
                            </li>
                            <li>
                                <a href="/divisi"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Divisi</a>
                            </li>
                            <li>
                                <a href="/e-dokumen-staff"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    E-Document</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level) ||
                        in_array('staff', $level) ||
                        in_array('guru tk', $level) ||
                        in_array('guru sd', $level) ||
                        in_array('guru smp', $level) ||
                        in_array('guru sma', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'students' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-datasiswa" data-collapse-toggle="dropdown-datasiswa">
                            <i class="bi bi-person text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Data
                                Siswa</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-datasiswa" class="hidden space-y-2 py-2">
                            <li>
                                <a href="/siswa"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Data Siswa</a>
                            </li>
                            <li>
                                <a href="/siswa/non-aktif"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Siswa Non Aktif</a>
                            </li>
                            <li>
                                <a href="/e-dokumen-siswa"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    E-Document</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level) ||
                        in_array('staff', $level) ||
                        in_array('guru tk', $level) ||
                        in_array('guru sd', $level) ||
                        in_array('guru smp', $level) ||
                        in_array('guru sma', $level) ||
                        in_array('siswa', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'subjects' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-subjects" data-collapse-toggle="dropdown-subjects">
                            <i class="bi bi-book text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Mata
                                Pelajaran</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-subjects" class="hidden space-y-2 py-2">
                            @if (in_array('admin', $level) || in_array('staff', $level))
                                <li>
                                    <a href="/mapel"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Data Mata Pelajaran</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level) ||
                                    in_array('staff', $level) ||
                                    in_array('guru tk', $level) ||
                                    in_array('guru sd', $level) ||
                                    in_array('guru smp', $level) ||
                                    in_array('guru sma', $level) ||
                                    in_array('siswa', $level))
                                <li>
                                    <a href="/jadwal-mapel"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Jadwal Mata Pelajaran</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level))
                                <li>
                                    <a href="/muatan-mapel"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Muatan Mata Pelajaran</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level) || in_array('staff', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'dues' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-dues" data-collapse-toggle="dropdown-dues">
                            <i class="bi bi-cash-coin text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Iuran
                                Siswa</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-dues" class="hidden space-y-2 py-2">
                            <li>
                                <a href="/grup-iuran"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Grup Iuran</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level) ||
                        in_array('staff', $level) ||
                        in_array('guru tk', $level) ||
                        in_array('guru sd', $level) ||
                        in_array('guru smp', $level) ||
                        in_array('guru sma', $level) ||
                        in_array('siswa', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'attendance' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-attandance" data-collapse-toggle="dropdown-attandance">
                            <i class="bi bi-calendar-check text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Absensi</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-attandance" class="hidden space-y-2 py-2">

                            @if (in_array('admin', $level) ||
                                    in_array('guru tk', $level) ||
                                    in_array('guru sd', $level) ||
                                    in_array('guru smp', $level) ||
                                    in_array('guru sma', $level))
                                <li>
                                    <a href="/absensi-siswa"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Absensi Siswa</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level) ||
                                    in_array('staff', $level) ||
                                    in_array('guru tk', $level) ||
                                    in_array('guru sd', $level) ||
                                    in_array('guru smp', $level) ||
                                    in_array('guru sma', $level) ||
                                    in_array('siswa', $level))
                                <li>
                                    <a href="/absen-lokasi"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Absensi Lokasi</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level))
                                <li>
                                    <a href="/laporan-absensi"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Laporan Absensi</a>
                                </li>
                                <li>
                                    <a href="/lokasi-gps"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Lokasi GPS</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level) ||
                        in_array('staff', $level) ||
                        in_array('guru tk', $level) ||
                        in_array('guru sd', $level) ||
                        in_array('guru smp', $level) ||
                        in_array('guru sma', $level) ||
                        in_array('siswa', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'exam' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-exam" data-collapse-toggle="dropdown-exam">
                            <i class="bi bi-journal-text text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Data
                                Ujian/Quiz</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-exam" class="hidden space-y-2 py-2">

                            @if (in_array('admin', $level) ||
                                    in_array('guru tk', $level) ||
                                    in_array('guru sd', $level) ||
                                    in_array('guru smp', $level) ||
                                    in_array('guru sma', $level) ||
                                    in_array('siswa', $level))
                                <li>
                                    <a href="/ujian-quiz"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Ujian/Quiz</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level) || in_array('staff', $level))
                                <li>
                                    <a href="/kategori-ujian"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Kategori Ujian</a>
                                </li>
                                <li>
                                    <a href="/ruangan"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Ruangan</a>
                                </li>
                                <li>
                                    <a href="/cetak-kartu"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Cetak Kartu Ujian</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level) ||
                                    in_array('guru tk', $level) ||
                                    in_array('guru sd', $level) ||
                                    in_array('guru smp', $level) ||
                                    in_array('guru sma', $level))
                                <li>
                                    <a href="/bank-soal"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Bank Soal</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level) || in_array('staff', $level))
                    <li>
                        <a href="/berita-pengumuman"
                            class="{{ $activeMenu == 'announce' ? 'bg-red-100' : '' }} group flex items-center rounded-lg p-2 text-sm text-gray-900 hover:bg-red-100">
                            <i class="bi bi-newspaper text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span class="ms-3">Berita/Pengumuman</span>
                        </a>
                    </li>
                @endif

                @if (in_array('admin', $level) ||
                        in_array('guru tk', $level) ||
                        in_array('guru sd', $level) ||
                        in_array('guru smp', $level) ||
                        in_array('guru sma', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'notes' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-note" data-collapse-toggle="dropdown-note">
                            <i class="bi bi-journals text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">
                                Buku Penghubung</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-note" class="hidden space-y-2 py-2">

                            @if (in_array('admin', $level) ||
                                    in_array('guru tk', $level) ||
                                    in_array('guru sd', $level) ||
                                    in_array('guru smp', $level) ||
                                    in_array('guru sma', $level))
                                <li>
                                    <a href="/catatan-siswa"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Catatan Siswa</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level))
                                <li>
                                    <a href="/catatan-staff"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Catatan Staff</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level) || in_array('staff', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'print-e-raport' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-raport" data-collapse-toggle="dropdown-raport">
                            <i class="bi bi-printer text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Cetak
                                E-Raport</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-raport" class="hidden space-y-2 py-2">

                            @if (in_array('admin', $level) ||
                                    in_array('guru tk', $level) ||
                                    in_array('guru sd', $level) ||
                                    in_array('guru smp', $level) ||
                                    in_array('guru sma', $level))
                                <li>
                                    <a href="/data-rapot"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Data Rapot</a>
                                </li>
                            @endif

                            @if (in_array('admin', $level) || in_array('staff', $level))
                                <li>
                                    <a href="/semester"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Semester</a>
                                </li>
                                <li>
                                    <a href="/jenis-semester"
                                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                        Jenis Semester</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level))
                    <li>
                        <button type="button"
                            class="{{ $activeMenu == 'master' ? 'bg-red-100' : '' }} group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-red-100"
                            aria-controls="dropdown-master" data-collapse-toggle="dropdown-master">
                            <i class="bi bi-bricks text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span
                                class="ms-3 flex-1 whitespace-nowrap text-left text-sm text-gray-900 rtl:text-right">Master</span>
                            <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-master" class="hidden space-y-2 py-2">
                            <li>
                                <a href="/kategori-e-document"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Kategori E-Document</a>
                            </li>
                            <li>
                                <a href="/tahun-ajaran"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Tahun Ajaran</a>
                            </li>
                            <li>
                                <a href="/agama"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Agama</a>
                            </li>
                            <li>
                                <a href="/program-keahlian"
                                    class="group flex w-full items-center rounded-lg p-2 pl-11 text-sm text-gray-700 transition duration-75 hover:bg-red-100">
                                    Program Keahlian</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array('admin', $level))
                    <li>
                        <a href="/pengaturan-umum/profil-sekolah"
                            class="{{ $activeMenu == 'setting' ? 'bg-red-100' : '' }} group flex items-center rounded-lg p-2 text-sm text-gray-900 hover:bg-red-100">
                            <i class="bi bi-gear text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true"></i>
                            <span class="ms-3">Pengaturan Umum</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="mt-14 p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{-- JS For Format Rupiah --}}
    <script src="{{ asset('/src/js/jquery.mask.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // Format mata uang.
            $('.money').mask('000.000.000.000.000', {
                reverse: true
            });

        })
    </script>
    {{-- Akhir JS For Format Rupiah --}}

    <script>
        if (document.getElementById("pagination-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#pagination-table", {
                paging: true,
                perPage: 10,
                perPageSelect: [5, 10, 15, 20, 25],
                sortable: false
            });
        }

        if (document.getElementById("pagination-table-100") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#pagination-table-100", {
                paging: true,
                perPage: 100,
                perPageSelect: [5, 10, 15, 20, 25, 100],
                sortable: false
            });
        }

        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-select2').select2();

            $('.select2-selection__rendered').addClass(
                'block w-full rounded-lg border border-gray-300 bg-gray-50 px-2.5 py-1.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500'
            )
        });

        $(document).ready(function() {
            $(".bi-alarm").on("click", function() {
                $(this).closest(".relative").find("input[type='time']").get(0).showPicker();
            });
        });
    </script>
</body>

</html>
