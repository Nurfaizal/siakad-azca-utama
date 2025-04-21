<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Masuk - SIAKAD AZCA</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-azca.png') }}">

    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet" />


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: "Poppins", serif;
        }

        body {
            background-size: cover;
            background-repeat: no-repeat;
            background: url({{ asset('assets/img/bglogin2.jpg') }});
        }

        .box .left-box {
            background: rgb(200, 210, 233);
            background: linear-gradient(38deg, rgba(200, 210, 233, 1) 0%, rgba(234, 238, 247, 1) 39%, rgba(248, 244, 235, 1) 100%);
        }

        img.star-login {
            animation: staranimation .5s ease-in infinite alternate;
            width: 28px;
        }

        @keyframes staranimation {
            0% {
                transform: scale(1)
            }

            100% {
                transform: scale(1.4)
            }
        }
    </style>
</head>

<body class="">

    <section class="flex items-center justify-center w-screen h-dvh">
        <div class="flex bg-white border rounded box" style="width:80%; max-width: 90%;">
            <div class="relative hidden w-8/12 px-10 py-5 left-box lg:block">

                <div class="flex items-center gap-3 mb-14">
                    <img class="mr-2 h-14 w-14" src="{{ asset('assets/img/logo-azca.png') }}" alt="logo">
                    <h1 class="text-slate-700 text-sm md:text-md">Al-Azhar Cairo <br> <span
                            class="font-semibold">Sulawesi-Selatan</span>
                    </h1>
                </div>
                <h1 class="mb-5 text-2xl text-slate-700">Sistem Informasi Akademik Sekolah <span
                        class="font-semibold">Al-Azhar Cairo</span> Sulawesi-Selatan</h1>
                <p class="text-light text-slate-500">Akses informasi akademik Anda (nilai, jadwal, tugas, materi, dan
                    lainnya) dengan mudah di sini.</p>
                <div class="flex items-center justify-center gap-2 mt-10">
                    <img class="object-cover mr-2 w-72" src="{{ asset('assets/img/footerimagelogin.png') }}"
                        alt="logo">
                </div>

                <img src="{{ asset('assets/img/star2login.png') }}" class="absolute star-login left-6 top-2/3"
                    alt="star-login">
                <img src="{{ asset('assets/img/star1login.png') }}"
                    class="absolute delay-75 star-login bottom-10 right-6" alt="star-login">
            </div>
            <div class="flex items-center justify-center w-full px-5 md:px-10 py-10 pb-10">
                <div class="w-full">
                    <div class="flex items-center justify-center w-full gap-3 mb-14 lg:hidden">
                        <img class="mr-2 h-14 w-14" src="{{ asset('assets/img/logo-azca.png') }}" alt="logo">
                        <h1 class="text-slate-700">Al-Azhar Cairo <br> <span
                                class="font-semibold">Sulawesi-Selatan</span></h1>
                    </div>
                    <h1 class="mb-10 text-md md:text-xl font-medium text-center text-slate-600">Silahkan masukkan akun
                        anda tes</h1>
                    <form class="space-y-4 md:mx-14 md:space-y-6" action="/login/autentikasi" method="post">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-light text-gray-700">Email</label>
                            <input type="email" name="email"
                                class="@error('email') border-red-600 @enderror shadow-xs block w-full rounded-lg border bg-gray-50 p-2.5 py-3 text-sm text-gray-900 focus:border-blue-600 focus:ring-blue-600"
                                placeholder="Email..." autofocus>
                            @error('email')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-light text-gray-700">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password..."
                                class="@error('password') border-red-600 @enderror form-password shadow-xs block w-full rounded-lg border bg-gray-50 p-2.5 py-3 text-sm text-gray-900 focus:border-blue-600 focus:ring-blue-600">
                            @error('password')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center mb-4">
                            <input id="default-checkbox" type="checkbox"
                                class="w-4 h-4 mt-1 text-blue-600 bg-gray-100 border-gray-300 rounded-sm form-checkbox focus:ring-2 focus:ring-blue-500">
                            <label for="default-checkbox" class="mt-1 text-sm font-medium text-gray-900 ms-2">Tampilkan
                                Password</label>
                        </div>

                        <button type="submit"
                            class="w-full px-5 py-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Login</button>
                        <div class="flex items-center justify-between">
                            <a href="/lupa-password" class="text-sm font-medium text-blue-600 hover:underline">Lupa
                                password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}!",
                icon: "success"
            });
        </script>
    @endif

    @if (session()->has('loginError'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: `{{ session('loginError') }}`,
            });
        </script>
    @endif

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

</body>

</html>
