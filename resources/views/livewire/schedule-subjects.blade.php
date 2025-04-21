<div>
    <form class="my-6" action="/jadwal-mapel" enctype="multipart/form-data" method="post">
        @csrf
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="mt-2">
                <label for="id_class" class="required mb-2 block text-sm font-medium text-gray-600">Kelas</label>
                <select name="id_class" id="id_class" name="id_class"
                    class="@error('id_class') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="">-- Pilih Kelas --</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id_class }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('id_class')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="id_subject" class="required mb-2 block text-sm font-medium text-gray-600">Mata
                    Pelajaran</label>
                <select name="id_subject" id="id_subject" name="id_subject"
                    class="@error('id_subject') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="">-- Pilih Mapel --</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id_subject }}">{{ $subject->subject_code }} - {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_subject')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="id_staff" class="required mb-2 block text-sm font-medium text-gray-600">Guru</label>
                <select name="id_staff" id="id_staff" name="id_staff"
                    class="@error('id_staff') border-red-600 @enderror js-select2 block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="">-- Pilih Guru --</option>
                    @foreach ($staff as $st)
                        <option value="{{ $st->id_staff }}">{{ $st->name }}</option>
                    @endforeach
                </select>
                @error('id_staff')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="day" class="required mb-2 block text-sm font-medium text-gray-600">Hari</label>
                <select name="day" id="day" name="day"
                    class="@error('day') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="">-- Pilih Hari --</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                    <option value="ahad">Ahad</option>
                </select>
                @error('day')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="location" class="required mb-2 block text-sm font-medium text-gray-600">Lokasi</label>
                <input type="text" id="location" name="location"
                    class="@error('location') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    placeholder="Lokasi..." value="{{ old('location') }}" />
                @error('location')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="link" class="mb-2 block text-sm font-medium text-gray-600">Link</label>
                <input type="text" id="link" name="link"
                    class="@error('link') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                    placeholder="Link Google meet, Zoom, dll" value="{{ old('link') }}" />
                @error('link')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="relative">
                    <label for="start_time" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                        Masuk</label>
                    <input type="time" id="start_time" name="start_time"
                        class="@error('start_time') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                        value="{{ old('start_time') }}" />
                    <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                    @error('start_time')
                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative">
                    <label for="end_time" class="required mb-2 block text-sm font-medium text-gray-600">Jam
                        Keluar</label>
                    <input type="time" id="end_time" name="end_time"
                        class="@error('end_time') border-red-600 @enderror w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                        alue="{{ old('end_time') }}" />
                    <i class="bi bi-alarm absolute right-4 top-1/2"></i>
                    @error('end_time')
                        <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <label for="status" class="required mb-2 block text-sm font-medium text-gray-600">Status</label>
                <select name="status" id="status" name="status"
                    class="@error('status') border-red-600 @enderror block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                    <option selected value="">-- Pilih Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Tidak Aktif</option>
                </select>
                @error('status')
                    <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-10 flex justify-end">
            <button type="submit"
                class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Simpan</button>
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

            $('#id_class').change(function() {
                $wire.dispatch('setLevel', {
                    id_class: $(this).val()
                })
            });

            Livewire.on('refreshData', function() {
                setTimeout(initSelect2, 500);
            });

        })
    </script>
@endscript
