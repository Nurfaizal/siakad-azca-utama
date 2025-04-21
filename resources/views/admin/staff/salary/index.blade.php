@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 px-5 py-6 bg-white rounded-lg">

        <div class="flex flex-col items-center justify-between gap-5 pb-5 border-b header md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Gaji Guru & Staff</h1>
            </div>
            <div>

            </div>
        </div>
        <div class="mt-5 body">

            <livewire:staff-salary />

        </div>
    </div>



    @livewireScripts
    @stack('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}!",
                icon: "success"
            });
        </script>
    @endif
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
