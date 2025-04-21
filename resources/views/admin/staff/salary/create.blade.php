@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 px-5 py-6 bg-white rounded-lg">
        <div class="flex flex-col items-center justify-between gap-5 pb-5 border-b header md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Bayar Gaji Guru & Staff
                </h1>
            </div>
            <div>
                <a href="/gaji-staff"
                    class="px-3 py-2 font-semibold text-green-700 duration-150 ease-linear bg-green-100 rounded-lg ms-2 hover:bg-green-200"><i
                        class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">
            <form class="my-6" action="/gaji-staff/bayar/{{ Crypt::encrypt($staff->id_staff) }}"
                enctype="multipart/form-data" method="post">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <div class="mb-3">
                            <div id="salary-deduction-section">
                                <label for="salary_deduction"
                                    class="block my-2 text-sm font-medium text-gray-600">Potongan</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" id="salary_deduction_description"
                                        name="salary_deduction_description[]"
                                        class="block w-full salary_deduction_description rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Tipe" />
                                    <input type="text" id="salary_deduction" name="salary_deduction[]" autocomplete="off"
                                        class="block money w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Nilai" />
                                </div>
                            </div>
                            <button type="button" id="add-more-deduction"
                                class="w-8 h-8 mt-3 text-lg text-white duration-150 ease-in bg-green-600 rounded-full hover:bg-green-800"><i
                                    class="bi bi-plus"></i></button>
                        </div>
                        <div class="mb-3">
                            <div id="salary-bonus-section">
                                <label for="salary_bonus" class="block my-2 text-sm font-medium text-gray-600">Bonus</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" id="salary_bonus_description" name="salary_bonus_description[]"
                                        class="block w-full salary_bonus_description rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Tipe" />
                                    <input type="text" id="salary_bonus" name="salary_bonus[]" autocomplete="off"
                                        class="block w-full money rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Nilai" />
                                </div>
                            </div>
                            <button type="button" id="add-more-bonus"
                                class="w-8 h-8 mt-3 text-lg text-white duration-150 ease-in bg-green-600 rounded-full hover:bg-green-800"><i
                                    class="bi bi-plus"></i></button>
                        </div>
                        <div class="flex justify-end mb-3">
                            <button type="button" id="calculate"
                                class="p-2 text-sm font-bold text-white bg-orange-500 rounded">=Jumlahkan</button>
                        </div>
                        <div class="w-full p-3 bg-blue-100 rounded info">
                            <div class="pb-3 border-b border-blue-400">
                                <h1 class="text-sm font-semibold text-blue-600">ℹ️ Tips untuk kamu!</h1>
                            </div>
                            <p class="pt-3 text-xs font-medium text-blue-500">Silahkan klik tombol jumlahkan, untuk
                                menjumlahkan secara
                                otomatis potongan, bonus, dan
                                dibayar.</p>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label for="nip" class="block mb-2 text-sm font-medium text-gray-600">NIP</label>
                            <input type="number" id="nip" name="nip" disabled
                                class="@error('nip') border-red-600 @enderror disabled:bg-gray-200 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                placeholder="NIP..." value="{{ $staff->nip }}" />
                            @error('nip')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Nama</label>
                            <input type="text" id="name" name="name" disabled
                                class="@error('name') border-red-600 @enderror disabled:bg-gray-200 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ $staff->name }}" />
                            @error('name')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="block mb-2 text-sm font-medium text-gray-600">Gaji</label>
                            <input type="text" id="salary" name="salary" disabled
                                class="money @error('salary') border-red-600 @enderror disabled:bg-gray-200 block w-full rounded-lg border p-2.5 text-sm text-gray-600 money focus:border-red-500 focus:ring-red-500"
                                value="{{ $staff->salary }}" />
                            @error('salary')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="salary_deduction_total"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Potongan</label>
                            <input type="number" id="salary_deduction_total" name="salary_deduction_total"
                                class="money @error('salary_deduction_total') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ old('salary_deduction_total') }}" />
                            @error('salary_deduction_total')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="salary_bonus_total"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Bonus</label>
                            <input type="number" id="salary_bonus_total" name="salary_bonus_total"
                                class="money @error('salary_bonus_total') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ old('salary_bonus_total') }}" />
                            @error('salary_bonus_total')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tax" class="block mb-2 text-sm font-medium text-gray-600">Pajak (%)</label>
                            <input type="number" id="tax" name="tax"
                                class="@error('tax') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ old('tax') }}" />
                            @error('tax')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="paid"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Dibayar</label>
                            <input type="number" id="paid" name="paid"
                                class="money @error('paid') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ old('paid') }}" />
                            @error('paid')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="month"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Bulan</label>
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

                            @error('gender')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="year"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Tahun</label>
                            <input type="number" id="year" name="year"
                                class="@error('year') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="{{ $currentYear }}" />
                            @error('year')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="payment_method1"
                                class="block mb-2 text-sm font-medium text-gray-600 required">Metode pembayaran</label>
                        </div>
                        <div class="flex gap-3 mb-3">
                            <input type="radio" id="payment_method1" name="payment_method"
                                class="@error('payment_method') border-red-600 @enderror  border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="tunai" />
                            <label for="payment_method1"
                                class="block mb-2 text-sm font-medium text-gray-600">Tunai</label>
                            <input type="radio" id="payment_method2" name="payment_method"
                                class="@error('payment_method') border-red-600 @enderror  border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="transfer" />
                            <label for="payment_method2"
                                class="block mb-2 text-sm font-medium text-gray-600">Transfer</label>
                            <input type="radio" id="payment_method3" name="payment_method"
                                class="@error('payment_method') border-red-600 @enderror  border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                value="debit" />
                            <label for="payment_method3"
                                class="block mb-2 text-sm font-medium text-gray-600">Debit</label>
                        </div>
                        @error('payment_method')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <div class="mb-5">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-600">Keterangan</label>
                            <textarea id="description" name="description"
                                class="@error('description') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"></textarea>
                            @error('description')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-10">
                    <button type="submit"
                        class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#add-more-deduction').click(function() {
            $('#salary-deduction-section').append(`
                                <div class="grid grid-cols-2 gap-2 my-3">
                                    <input type="text" id="salary_deduction_description"
                                        name="salary_deduction_description[]"
                                        class="block w-full salary_deduction_description rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Tipe" />
                                    <input type="text" id="salary_deduction" name="salary_deduction[]" autocomplete="off"
                                        class="block money w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Nilai" />
                                </div>`)
        })

        $('#add-more-bonus').click(function() {
            $('#salary-bonus-section').append(`
                                <div class="grid grid-cols-2 gap-2 my-3">
                                    <input type="text" id="salary_bonus_description" name="salary_bonus_description[]"
                                        class="block w-full salary_bonus_description rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Tipe" />
                                    <input type="text" id="salary_bonus" name="salary_bonus[]" autocomplete="off" 
                                        class="block w-full money rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Nilai" />
                                </div>`)
        })

        $('#tax').on('keyup', function() {
            let tax = parseFloat($('#tax').val()) || 0;
            let paid = parseFloat($('#paid').val().replace(/\./g, '')) || 0;

            // Hitung jumlah pajak
            let taxAmount = (tax !== 0) ? (paid * tax) / 100 : 0;


            // Hitung total setelah dikurangi pajak
            let finalAmount = parseInt(`{{ $staff->salary }}`) - taxAmount;

            // Format angka sebelum dimasukkan kembali
            $("#paid").val(finalAmount);
        });

        $("#calculate").click(function() {
            // Ambil nilai pajak
            let tax = parseInt($('#tax').val()) || 0;
            let salary = parseInt($('#salary').val().replace(/\./g, '')) || 0;

            // Reset nilai potongan dan bonus setiap kali tombol ditekan
            let totalDeduction = 0;
            let totalBonus = 0;

            // Ambil semua nilai potongan
            $('input[name="salary_deduction[]"]').each(function() {
                totalDeduction += parseInt($(this).val().replace(/\./g, '')) || 0;
            });

            // Ambil semua nilai bonus
            $('input[name="salary_bonus[]"]').each(function() {
                totalBonus += parseInt($(this).val().replace(/\./g, '')) || 0;
            });

            // Hitung total gaji sebelum pajak
            let total = (salary - totalDeduction) + totalBonus;

            // Hitung pajak
            let taxAmount = (tax !== 0) ? (total * tax) / 100 : 0;

            // Hitung jumlah akhir yang harus dibayar
            let finalAmount = total - taxAmount;

            // Masukkan hasil ke input "Dibayar"
            $("#salary_deduction_total").val(totalDeduction);
            $("#salary_bonus_total").val(totalBonus);
            $("#paid").val(finalAmount);
        });
    </script>
@endsection
