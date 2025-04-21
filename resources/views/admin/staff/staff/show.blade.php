@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Detail Data Guru &
                    Staff</h1>
            </div>
            <div>
                @if ($staff->user->status == 'Aktif')
                    <a href="/staff" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @else
                    <a href="/staff-non-aktif" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @endif
            </div>
        </div>
        <div class="body">
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2">
                <div class="mt-5 flex items-center gap-4">
                    <img src="{{ $staff->image != null ? 'data:image/' . $fileExt . ';base64,' . $fileData : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}" alt="Foto Staff" class="h-20 w-20 rounded-full object-cover">
                    <div>
                        <h1 class="pb-2 text-xl font-bold text-slate-700">{{ $staff->name }} <span class="{{ $staff->user->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} ms-2 rounded-md px-2.5 py-0.5 text-xs font-light"><i class="bi bi-{{ $staff->user->status == 'Aktif' ? 'unlock' : 'lock' }}"></i>
                                {{ $staff->user->status }}</span>

                        </h1>
                        <h2 class="text-xs font-light capitalize text-slate-500">
                            {{ implode(', ', $selectedLevels) ?: 'Belum ada level yang dipilih' }}
                        </h2>
                    </div>
                </div>
                <div class="flex items-end justify-end">
                    <a href="/staff/{{ Crypt::encrypt($staff->id_staff) }}/edit">
                        <button class="rounded border p-2 text-sm text-slate-600 hover:bg-slate-100">Edit Profil</button>
                    </a>
                </div>
            </div>

            <div class="card mb-5 rounded">
                <div class="rounded bg-slate-100 p-3">
                    <h1 class="text-slate-800">Informasi Dasar</h1>
                </div>
                <div class="grid grid-cols-1 p-3 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">NIP</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->nip }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Nama Lengkap</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->name }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Username</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->user->username }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">No KTP</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->no_ktp }}</td>
                        </tr>
                    </table>
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Tempat/Tgl.Lahir</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->place_birth }},
                                {{ $staff->birth_date }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Jenis Kelamin</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->gender }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Pendidikan Terakhir</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->education }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Status</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->status }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-5 rounded">
                <div class="rounded bg-slate-100 p-3">
                    <h1 class="text-slate-800">Pekerjaan</h1>
                </div>
                <div class="grid grid-cols-1 p-3 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Divisi</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->division->name }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Gaji</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">Rp. {{ number_format($staff->salary) }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Bagian</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->part }}</td>
                        </tr>
                    </table>
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Tanggal Bergabung</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->join_date }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Tanggal Berakhir</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->end_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-5 rounded">
                <div class="rounded bg-slate-100 p-3">
                    <h1 class="text-slate-800">Kontak</h1>
                </div>
                <div class="grid grid-cols-1 p-3 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">No Telpon</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->phone }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat Email</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->user->email }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $staff->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
