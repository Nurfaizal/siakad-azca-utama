@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Detail Data Guru &
                    Staff</h1>
            </div>
            <div>
                @if ($student->status == 'Aktif')
                    <a href="/siswa" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @else
                    <a href="/siswa/non-aktif" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                        Kembali</a>
                @endif
            </div>
        </div>
        <div class="body">
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2">
                <div class="mt-5 flex items-center gap-4">
                    <img src="{{ $student->image != null ? 'data:image/' . $fileExt . ';base64,' . $fileData : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}" alt="Foto Staff" class="h-20 w-20 rounded-full object-cover">
                    <div>
                        <h1 class="pb-2 text-xl font-bold text-slate-700">{{ $student->name }} <span class="{{ $student->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} ms-2 rounded-md px-2.5 py-0.5 text-xs font-light"><i class="bi bi-{{ $student->status == 'Aktif' ? 'unlock' : 'lock' }}"></i>
                                {{ $student->status }}</span>

                        </h1>
                        <h2 class="text-xs font-light capitalize text-slate-500">
                            {{ implode(', ', $selectedLevels) ?: 'Belum ada level yang dipilih' }}
                        </h2>
                    </div>
                </div>
                <div class="flex items-end justify-end">
                    <a href="/staff/{{ Crypt::encrypt($student->id_staff) }}/edit">
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
                            <td class="text-sm text-slate-800" width="200">NIS</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->nis }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">NISN</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->nisn == null)
                                    -
                                @else
                                    {{ $student->nisn }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Nama Lengkap</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->name }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Username</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->user->username }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Status Keluarga</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->family_status }}</td>
                        </tr>
                    </table>
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Anak ke-</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->child_order }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Tempat/Tgl.Lahir</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->place_birth }},
                                {{ $student->birth_date }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Tempat/Tgl.Lahir</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->place_birth }},
                                {{ $student->birth_date }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Jenis Kelamin</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->gender }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-5 rounded">
                <div class="rounded bg-slate-100 p-3">
                    <h1 class="text-slate-800">Sekolah</h1>
                </div>
                <div class="grid grid-cols-1 p-3 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Kelas</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->classes->name }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Sekolah Sebelumnya</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->prev_school == null)
                                    -
                                @else
                                    {{ $student->prev_school }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Program Studi/Jurusan</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->study_program == null)
                                    -
                                @else
                                    {{ $student->study_program }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Kartu Ujian</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->card_number == null)
                                    -
                                @else
                                    {{ $student->card_number }}
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Nomor Peserta Ujian</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->examinee_number == null)
                                    -
                                @else
                                    {{ $student->examinee_number }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Tanggal Bergabung</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->receive_date }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Tanggal Lulus</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->graduation_date == null)
                                    -
                                @else
                                    {{ $student->graduation_date }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-5 rounded">
                <div class="rounded bg-slate-100 p-3">
                    <h1 class="text-slate-800">Orang Tua</h1>
                </div>
                <div class="grid grid-cols-1 p-3 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Nama Ayah</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->father_name == null)
                                    -
                                @else
                                    {{ $student->parent->father_name }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Pekerjaan Ayah</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->father_job == null)
                                    -
                                @else
                                    {{ $student->parent->father_job }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Telpon Ayah</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->father_phone == null)
                                    -
                                @else
                                    {{ $student->parent->father_phone }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat Ayah</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->father_address == null)
                                    -
                                @else
                                    {{ $student->parent->father_address }}
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Nama Ibu</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->mother_name == null)
                                    -
                                @else
                                    {{ $student->parent->mother_name }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Pekerjaan Ibu</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->mother_job == null)
                                    -
                                @else
                                    {{ $student->parent->mother_job }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Telpon Ibu</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->mother_phone == null)
                                    -
                                @else
                                    {{ $student->parent->mother_phone }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat Ibu</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->parent->mother_address == null)
                                    -
                                @else
                                    {{ $student->parent->mother_address }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-5 rounded">
                <div class="rounded bg-slate-100 p-3">
                    <h1 class="text-slate-800">Data Wali</h1>
                </div>
                <div class="grid grid-cols-1 p-3 md:grid-cols-2">
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Nama Wali</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->guardian->guardian_name }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Pekerjaan</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->guardian->guardian_job }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->guardian->guardian_address }}</td>
                        </tr>
                    </table>
                    <table class="w-full" cellpadding="10">
                        <tr height="40">
                            <td class="text-sm text-slate-800" width="200">Telpon</td>
                            <td class="text-sm text-slate-800" width="12">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->guardian->guardian_phone }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alternatif Telpon</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">
                                @if ($student->guardian->alt_phone == null)
                                    -
                                @else
                                    {{ $student->guardian->alt_phone }}
                                @endif
                            </td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat Email</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $guardian->user->email }}</td>
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
                            <td class="text-sm font-light text-slate-600">{{ $student->phone }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat Email</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->user->email }}</td>
                        </tr>
                        <tr height="40">
                            <td class="text-sm text-slate-800">Alamat</td>
                            <td class="text-sm text-slate-800">:</td>
                            <td class="text-sm font-light text-slate-600">{{ $student->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
