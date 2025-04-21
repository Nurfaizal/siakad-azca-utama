@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Daftar Penetapan Jam Masuk Personal</h1>
            </div>
            <div class="flex">
                <a href="/divisi" class="ms-2 rounded-l-lg rounded-bl-lg bg-orange-100 px-3 py-2 font-semibold text-orange-700 duration-150 ease-linear hover:bg-orange-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
                <button class="h-10 min-w-28 rounded-r-lg rounded-br-lg bg-green-100 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-journal-arrow-down pe-1"></i>
                    Ekspor</button>
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
                            <div class="flex h-full items-center">Nama Lengkap</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Divisi</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center">Jam Masuk</div>
                        </th>
                        <th class="border">
                            <div class="flex h-full items-center justify-center">Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personal as $p)
                        <tr>
                            <td class="whitespace-nowrap text-center font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td>{{ $p->staff->name }}</td>
                            <td>{{ $p->staff->division->name }}</td>
                            <td>
                                <ul>
                                    <li>Senin : {{ $p->monday_in }} - {{ $p->monday_out }}
                                    </li>
                                    <li>
                                        Selasa : {{ $p->tuesday_in }} - {{ $p->tuesday_out }}
                                    </li>
                                    <li>
                                        Rabu : {{ $p->wednesday_in }} - {{ $p->wednesday_out }}
                                    </li>
                                    <li>
                                        Kamis : {{ $p->thursday_in }} - {{ $p->thursday_out }}
                                    </li>
                                    <li>
                                        Jumat : {{ $p->friday_in }} - {{ $p->friday_out }}
                                    </li>
                                    <li>
                                        @if ($p->saturday_in == null && $p->saturday_out == null)
                                            Sabtu : Libur
                                        @else
                                            Sabtu : {{ $p->saturday_in }} - {{ $p->saturday_out }}
                                        @endif
                                    </li>
                                    <li>
                                        @if ($p->sunday_in == null && $p->sunday_out == null)
                                            Minggu : Libur
                                        @else
                                            Minggu : {{ $p->sunday_in }} - {{ $p->sunday_out }}
                                        @endif
                                    </li>
                                </ul>
                            </td>
                            <td class="flex justify-center gap-2">
                                <a href="/penetapan-jam-personal/{{ Crypt::encrypt($p->id_personal) }}/edit">
                                    <i class="bi bi-pencil-square text-lg text-green-600 hover:text-green-900"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
