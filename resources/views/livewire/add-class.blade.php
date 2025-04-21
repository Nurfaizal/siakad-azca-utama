<div>

    <form class="my-6" action="/kelas" method="post">
        @csrf
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label for="name" class="required mb-2 block text-sm font-medium text-gray-600">Nama
                    Kelas</label>
                <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Kelas..." value="{{ old('name') }}" />
                @error('name')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="level" class="required mb-2 block text-sm font-medium text-gray-600">Tingkat</label>
                <select name="level" id="level" name="level" class="@error('level') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option value="">-- Pilih Tingkat --</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                </select>
                @error('level')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="id_skill" class="mb-2 block text-sm font-medium text-gray-600">Program Keahlian</label>
                <select name="id_skill" id="id_skill" name="id_skill" class="@error('id_skill') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="{{ null }}">-- Pilih Program Keahlian (Jika Ada) --</option>
                    @foreach ($skill as $s)
                        <option value="{{ $s->id_skill }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                @error('id_skill')
                    <p class="pt-5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="relative">
                    <label for="time_in" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                        Masuk</label>
                    <input type="time" id="time_in" name="time_in" class="@error('time_in') border-red-600 @enderror w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('time_in') }}" />
                    <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                    @error('time_in')
                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative">
                    <label for="time_out" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                        Keluar</label>
                    <input type="time" id="time_out" name="time_out" class="@error('time_out') border-red-600 @enderror w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" value="{{ old('time_out') }}" />
                    <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                    @error('time_out')
                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label for="id_staff" class="required mb-2 block text-sm font-medium text-gray-600">Wali
                    Kelas</label>
                <select name="id_staff" id="id_staff" name="id_staff" class="@error('id_staff') border-red-600 @enderror js-select2 block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="">-- Pilih Wali --</option>
                    @foreach ($staff as $s)
                        <option value="{{ $s->id_staff }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                @error('id_staff')
                    <p class="pt-5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="status" class="required mb-2 block text-sm font-medium text-gray-600">Status</label>
                <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="">-- Pilih Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                </select>
                @error('status')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-10 flex justify-end">
            <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@script
    <script>
        $(document).ready(function() {
            function initSelect2() {
                $('.js-select2').select2();

                $('.select2-selection__rendered').addClass(
                    'block w-full rounded-lg border border-gray-300 bg-gray-50 px-2.5 py-1.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500'
                )
            }

            $('#level').change(function() {
                $wire.dispatch('setLevel', {
                    level: $(this).val()
                })
            });

            Livewire.on('refreshData', function() {
                setTimeout(initSelect2, 500);
            });

        })
    </script>
@endscript
