<form method="post" action="/mutasi-kelas">
    @method('put')
    @csrf
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <div>
            <div class="flex items-center justify-center h-12 bg-red-400">
                <h1 class="font-semibold text-white">Kelas Asal</h1>
            </div>

            <div class="flex gap-2 my-4">
                <select name="from_id_year" id="from_id_year" name="id_year"
                    class="block w-1/2 rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    required>
                    <option value="">~ Pilih Tahun Ajaran</option>
                    @foreach ($schoolYears as $sy)
                        <option value="{{ $sy->id_year }}">{{ $sy->name }}</option>
                    @endforeach
                </select>
                <select name="from_id_class" id="from_id_class" name="id_class"
                    class="block w-full rounded-lg border js-select2 border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    required>
                    <option value="">~ Pilih Kelas</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id_class }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                <input type="text" id="from_name" name="from_name" autocomplete="off"
                    class="block w-1/2 rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    placeholder="Cari nama...." />
            </div>


            <div class="flex mb-4">
                <button type="button"
                    class="check-all px-5 py-2 font-medium text-indigo-700 duration-150 ease-in bg-indigo-200 rounded-l rounded-bl hover:bg-indigo-300"><i
                        class="bi bi-check-square pe-2"></i> Pilih semua</button>
                <button type="button"
                    class="uncheck-all px-5 py-2 font-medium text-orange-700 duration-150 ease-in bg-orange-200 hover:bg-orange-300"><i
                        class="bi bi-dash-square pe-2"></i> Batal Pilih</button>
                <button type="submit" id="apply"
                    class="px-5 py-2 font-medium text-green-700 duration-150 ease-in bg-green-200 rounded-r rounded-tr hover:bg-green-300"><i
                        class="bi bi-arrow-right-square pe-2"></i> Terapkan</button>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="p-4">
                                Pilih
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nisn
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="from_id_student[]" id="from_id_student"
                                            class="border" value="{{ $student->id_student }}">
                                    </div>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $student->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $student->nisn }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->classes->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div>
            <div class="flex items-center justify-center h-12 bg-indigo-400">
                <h1 class="font-semibold text-white">Kelas Baru</h1>
            </div>
            <div class="flex gap-2 my-4">
                <select name="to_id_year" id="to_id_year" name="id_year"
                    class="block w-1/2 rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    required>
                    <option value="">~ Pilih Tahun Ajaran</option>
                    @foreach ($schoolYears as $sy)
                        <option value="{{ $sy->id_year }}">{{ $sy->name }}</option>
                    @endforeach
                </select>
                <select name="to_id_class" id="to_id_class" name="to_id_class"
                    class="block w-full rounded-lg border js-select2 border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    required>
                    <option value="">~ Pilih Kelas</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id_class }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                <input type="text" id="to_name" name="to_name" autocomplete="off"
                    class="block w-1/2 rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    placeholder="Cari nama...." />
            </div>
            <div class="py-4 my-5"></div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nisn
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toStudents as $toStudent)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $toStudent->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $toStudent->nisn }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $toStudent->classes->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</form>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session()->has('success'))
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "Kamu telah melakukan mutasi kelas!",
            icon: "success"
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Gagal melakukan mutasi data!",
        });
    </script>
@endif

@script
    <script>
        $(document).ready(function() {
            function initSelect2() {
                $('.js-select2').select2();

                $('.select2-selection__rendered').addClass(
                    'block w-full rounded-lg border border-gray-300 bg-gray-50 px-2.5 py-1.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500'
                )
            }

            // Fungsi Pilih Semua
            $(".check-all").click(function() {
                $("input[type='checkbox']").prop("checked", true);
            });

            // Fungsi Batal Pilih
            $(".uncheck-all").click(function() {
                $("input[type='checkbox']").prop("checked", false);
            });

            $('#from_id_year').change(function() {
                $wire.dispatch('setFromIdYear', {
                    id_year: parseInt($(this).val())
                });
            });

            $("select[name='from_id_class']").change(function() {
                $wire.dispatch('setFromIdClass', {
                    id_class: parseInt($(this).val())
                })
            });

            $("input[name='from_name']").on('keyup', function() {
                $wire.dispatch('searchByFromName', {
                    name: $(this).val()
                })
            });

            $('#to_id_year').change(function() {
                $wire.dispatch('setToIdYear', {
                    id_year: parseInt($(this).val())
                })
            });

            $("select[name='to_id_class']").change(function() {
                $wire.dispatch('setToIdClass', {
                    id_class: parseInt($(this).val())
                })
            });

            $("input[name='to_name']").on('keyup', function() {
                $wire.dispatch('searchByToName', {
                    name: $(this).val()
                })
            });

            Livewire.on('refreshData', function() {
                setTimeout(initSelect2, 200);
            });

        });
    </script>
@endscript
