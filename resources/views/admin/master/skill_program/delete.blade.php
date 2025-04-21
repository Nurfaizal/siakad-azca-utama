@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Hapus Program Keahlian</h1>
            </div>
            <div>
                <a href="/program-keahlian" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/program-keahlian/{{ Crypt::encrypt($skill->id_skill) }}" method="post">
                @csrf
                @method('DELETE')

                <p class="mb-5">Yakin Ingin Menghapus Data Berikut ini : </p>

                <table>
                    <tr height="40">
                        <td width="160"><b>Program Keahlian</b></td>
                        <td width="12">:</td>
                        <td>{{ $skill->name }}</td>
                    </tr>
                    <tr height="40">
                        <td><b>Status</b></td>
                        <td>:</td>
                        <td>
                            @if ($skill->status == 'Aktif')
                                <span class="me-2 rounded-sm bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-800">{{ $skill->status }}</span>
                            @else
                                <span class="me-2 rounded-sm bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800">{{ $skill->status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection
