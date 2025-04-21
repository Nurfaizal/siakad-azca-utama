<div>

    <div class="grid grid-cols-2 gap-3 mb-3">
        <div>
            <label for="month" class="block mb-2 text-sm font-medium text-gray-600">Bulan</label>
            @php
                use Carbon\Carbon;
                $currentMonth = Carbon::now()->month;
                $currentYear = Carbon::now()->year;

            @endphp

            <select name="month" id="month"
                class="@error('month') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                <option value="">-- Pilih bulan --</option>
                @foreach ([
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ] as $num => $name)
                    <option value="{{ $num }}" {{ $num == $currentMonth ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

        </div>
        <div>
            <label for="year" class="block mb-2 text-sm font-medium text-gray-600">Tahun</label>
            <input type="number" placeholder="2025" id="year" name="year"
                class="@error('year') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                value="{{ $currentYear }}" />
            @error('year')
                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div>
        <table id="pagination-table" class="w-full">
            <thead>
                <tr>
                    <th class="border" style="width: 30px !important;">
                        <div class="flex items-center justify-center h-full text-sm text-slate-500">No</div>
                    </th>
                    <th class="border">
                        <div class="flex items-center justify-center h-full text-sm text-slate-500">NIP</div>
                    </th>
                    <th class="border">
                        <div class="flex items-center justify-center h-full text-sm text-slate-500">Nama Lengkap</div>
                    </th>
                    <th class="border">
                        <div class="flex items-center justify-center h-full text-sm text-slate-500">Divisi</div>
                    </th>
                    <th class="border">
                        <div class="flex items-center justify-center h-full text-sm text-slate-500">Status</div>
                    </th>
                    <th class="border">
                        <div class="flex items-center justify-center h-full text-sm text-slate-500">Tanggal Proses</div>
                    </th>
                    <th class="border">
                        <div class="flex items-center justify-center h-full text-sm text-slate-500">Action</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staff as $row)
                    @php
                        $salaries_created = $row->salaries->created_at ?? null;
                    @endphp
                    <tr class="py-3">
                        <td class="text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}</td>
                        <td class="text-sm text-slate-700">{{ $row->nip }}</td>
                        <td class="text-sm text-slate-700">{{ $row->name }}</td>
                        <td class="text-sm text-slate-700">{{ $row->division->name }}</td>
                        <td class="text-sm text-slate-700">{{ $row->status }}</td>
                        <td class="text-sm text-slate-700">{{ $row->salaries->created_at ?? 'Belum diproses' }}</td>
                        <td class="text-center">
                            @if ($salaries_created !== null)
                                <a
                                    href="/gaji-staff/pembayaran/{{ Crypt::encrypt($row->id_staff) }}/{{ $currentMonth }}/{{ $currentYear }}"><i
                                        class="bi bi-cash-stack text-lg {{ $salaries_created ? 'text-green-600' : 'text-red-600' }} "></i></a>
                            @else
                                <a href="/gaji-staff/bayar/{{ Crypt::encrypt($row->id_staff) }}"><i
                                        class="bi bi-cash-stack text-lg {{ $salaries_created ? 'text-green-600' : 'text-red-600' }} "></i></a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $staff->links() }} --}}
    </div>
</div>


{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
@script
    <script>
        setTimeout(() => {
            $wire.dispatch('setMonth', {
                month: parseInt($(this).val())
            })

            $wire.dispatch('setYear', {
                month: parseInt($(this).val())
            })
        }, 150);

        $(document).ready(function() {
            $('#month').click(function() {
                $wire.dispatch('setMonth', {
                    month: parseInt($(this).val())
                })
            });

            $('#year').on('keyup', function() {
                $wire.dispatch('setYear', {
                    year: parseInt($(this).val())
                })

            })

        })

        function initDataTable() {
            if (document.getElementById("pagination-table") && typeof simpleDatatables.DataTable !==
                'undefined') {
                const dataTable = new simpleDatatables.DataTable("#pagination-table", {
                    paging: true,
                    perPage: 10,
                    perPageSelect: [5, 10, 15, 20, 25],
                    sortable: false
                });
            }
        }

        $(document).ready(() => {
            initDataTable();

            Livewire.on('refreshTable', function() {
                setTimeout(initDataTable, 100);
            });
        });
    </script>
@endscript
