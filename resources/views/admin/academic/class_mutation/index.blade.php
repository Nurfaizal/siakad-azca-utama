@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 px-5 py-6 bg-white rounded-lg">
        <div class="flex flex-col items-center justify-between gap-5 pb-5 border-b header md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Mutasi kelas</h1>
            </div>
            <div>
            </div>
        </div>
        <div class=" body">
            <livewire:class-mutation />

        </div>
    </div>
    @livewireScripts
    @stack('js')
@endsection
