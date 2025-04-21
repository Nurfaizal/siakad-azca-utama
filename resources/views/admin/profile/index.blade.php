@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Profil Pengguna</h1>
            </div>

        </div>
        <div class="body">
            <div class="my-10 grid grid-cols-1 md:grid-cols-4">
                <div class="mb-5 w-full rounded md:col-span-3">
                    <div class="rounded bg-slate-100 p-3">
                        <h1 class="text-slate-800">Informasi Dasar</h1>
                    </div>
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800">Username</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ Auth::user()->username }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">No Hp</td>
                            <td class="text-sm text-slate-800">:</td>

                            @if (Auth::user()->staff->phone != null)
                                <td class="text-sm font-light text-slate-600">{{ Auth::user()->staff->phone }}</td>
                            @else
                                <td class="text-sm font-light text-slate-600">-</td>
                            @endif

                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Email</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ Auth::user()->email }}</td>
                        </tr>
                    </table>
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}" alt="Foto Staff" class="h-44 w-44 rounded object-cover">
                </div>
            </div>

            <div class="flex items-end justify-end">
                <a href="/profile/{{ Crypt::encrypt(Auth::user()->id_user) }}/edit">
                    <button class="rounded border p-2 text-sm text-slate-600 hover:bg-slate-100">Ubah Password</button>
                </a>
            </div>

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
