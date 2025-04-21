@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 px-5 py-6 bg-white rounded-lg">
        <div class="flex flex-col items-center justify-between gap-5 pb-5 border-b header md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Ubah Jadwal Mata
                    Pelajaran</h1>
            </div>
            <div>
                <a href="/kelas"
                    class="px-3 py-2 font-semibold text-green-700 duration-150 ease-linear bg-green-100 rounded-lg ms-2 hover:bg-green-200"><i
                        class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <livewire:schedule-subjects-update :schedule="$schedule" />

        </div>
    </div>

    @livewireScripts
    @stack('js')
@endsection
