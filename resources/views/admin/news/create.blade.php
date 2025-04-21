@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Tambah Berita/Pengumuman
                </h1>
            </div>
            <div>
                <a href="/berita-pengumuman" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">

            <form class="my-6" action="/berita-pengumuman" method="post" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <div>
                            <label for="title" class="mb-2 mt-4 block text-sm font-medium text-gray-600">Judul</label>
                            <input type="text" id="title" name="title" class="@error('title') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Judul..." value="{{ old('title') }}" autocomplete="off" />
                            @error('title')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="mb-2 mt-4 block text-sm font-medium text-gray-600">Status</label>
                            <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                <option selected value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                            @error('status')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="mb-2 mt-4 block text-sm font-medium text-gray-600">Tipe</label>
                            <select name="type" id="type" name="type" class="@error('type') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                                <option selected value="">-- Pilih Tipe --</option>
                                <option value="Berita">📢 Berita</option>
                                <option value="Pengumuman">📝 Pengumuman</option>
                            </select>
                            @error('type')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="short_desc" class="mb-2 mt-4 block text-sm font-medium text-gray-600">Keterangan</label>
                            <input type="text" id="short_desc" name="short_desc" class="@error('short_desc') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Keterangan..." value="{{ old('short_desc') }}" autocomplete="off" />
                            @error('short_desc')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="description" id="hidden-input" placeholder="asdf">
                        <label for="" class="mb-2 mt-4 block text-sm font-medium text-gray-600">Isi Konten</label>
                        <div id="editor" class="rounded bg-gray-50" name="description" style="height: 150px !important">
                        </div>

                        <div>
                            <label for="image" class="mb-2 mt-4 block text-sm font-medium text-gray-600">Foto</label>
                            <input type="file" id="image" name="image" class="block w-full rounded-lg p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" />
                            @error('image')
                                <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit" class="dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 sm:w-auto">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        quill.on('text-change', function() {
            document.querySelector('#hidden-input').value = quill.root.innerHTML;
        });
    </script>
@endsection
