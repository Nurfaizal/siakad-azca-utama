<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lupa Password - SIAKAD AZCA</title>
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

        <section class="flex h-dvh w-screen items-center justify-center">
            <div class="box flex rounded border bg-white" style="width:70%; max-width: 90%;">
                <div class="left-box relative hidden w-8/12 px-10 py-5 lg:block">

                    <div class="mb-14 flex items-center gap-3">
                        <img class="mr-2 h-14 w-14" src="{{ asset('assets/img/logo-azca.png') }}" alt="logo">
                        <h1 class="text-slate-700">Al-Azhar Cairo <br> <span class="font-semibold">Sulawesi-Selatan</span></h1>
                    </div>
                    <h1 class="mb-5 text-2xl text-slate-700">Sistem Informasi Akademik Sekolah <span class="font-semibold">Al-Azhar Cairo</span> Sulawesi-Selatan</h1>
                    <p class="text-light text-slate-500">Akses informasi akademik Anda (nilai, jadwal, tugas, materi,
                        dan lainnya) dengan mudah di sini.</p>
                    <div class="mt-10 flex items-center justify-center gap-2">
                        <img class="mr-2 w-72 object-cover" src="{{ asset('assets/img/footerimagelogin.png') }}" alt="logo">
                    </div>

                    <img src="{{ asset('assets/img/star2login.png') }}" class="star-login absolute left-6 top-2/3" alt="star-login">
                    <img src="{{ asset('assets/img/star1login.png') }}" class="star-login absolute bottom-10 right-6 delay-75" alt="star-login">
                </div>
                <div class="flex w-full items-center justify-center px-10 py-10 pb-10">
                    <div class="w-full">
                        <div class="mb-14 flex w-full items-center justify-center gap-3 lg:hidden">
                            <img class="mr-2 h-14 w-14" src="{{ asset('assets/img/logo-azca.png') }}" alt="logo">
                            <h1 class="text-slate-700">Al-Azhar Cairo <br> <span class="font-semibold">Sulawesi-Selatan</span></h1>
                        </div>
                        <h1 class="my-10 text-center text-xl font-medium text-slate-600">Lupa Password</h1>
                        <form class="space-y-4 md:mx-14 md:space-y-6" action="/lupa-password/submit" method="post">
                            @csrf
                            <div>
                                <label for="email" class="mb-2 block text-sm font-light text-gray-700">Email</label>
                                <input type="email" name="email" class="@error('email') border-red-600 @enderror shadow-xs block w-full rounded-lg border bg-gray-50 p-2.5 py-3 text-sm text-gray-900 focus:border-blue-600 focus:ring-blue-600" placeholder="Email...">
                                @error('email')
                                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3"></div>
                            <button type="submit" class="w-full rounded-lg bg-blue-600 px-5 py-3 text-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Kirim</button>
                            <div></div>

                        </form>

                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

        @if (session()->has('success'))
            <script>
                Swal.fire({
                    title: "Sukses!",
                    text: "{{ session('success') }}!",
                    icon: "success"
                });
            </script>
        @endif

    </body>

</html>
