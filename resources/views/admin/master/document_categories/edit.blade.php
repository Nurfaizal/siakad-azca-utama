@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Edit Kategori E-Document</h1>
            </div>
            <div>
                <a href="/kategori-e-document" class="ms-2 rounded-lg bg-green-100 px-3 py-2 font-semibold text-green-700 duration-150 ease-linear hover:bg-green-200"><i class="bi bi-caret-left pe-1"></i>
                    Kembali</a>
            </div>
        </div>
        <div class="body">


            <form class="my-6" action="/kategori-e-document/{{ Crypt::encrypt($category->id_category) }}" method="post">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-600">Nama kategori</label>
                        <input type="text" id="name" name="name" class="@error('name') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500" placeholder="Nama Kategori..." value="{{ $category->name }}" autocomplete="off" />
                        @error('name')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="type" class="mb-2 block text-sm font-medium text-gray-600">Tipe</label>
                        <select name="type" id="type" name="type" class="@error('type') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $category->type }}">-- {{ $category->type }} --</option>
                            <option value="e-document-siswa">e-document-siswa</option>
                            <option value="e-document-staff">e-document-staff</option>
                            <option value="ujian/tugas">ujian/tugas</option>
                            <option value="catatan">catatan</option>
                            <option value="pemasukan">pemasukan</option>
                            <option value="pengeluaran">pengeluaran</option>
                            <option value="barang">barang</option>
                            <option value="buku tamu">buku tamu</option>
                        </select>
                        @error('type')
                            <p class="pt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="status" name="status" class="@error('status') border-red-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500">
                            <option selected value="{{ $category->status }}">-- {{ $category->status }} --</option>
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
    </div>
@endsection
