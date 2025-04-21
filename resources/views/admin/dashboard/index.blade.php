@extends('admin/template/temp1')
@section('content')
    <div class="relative grid grid-cols-1 px-4 py-6 overflow-hidden bg-white rounded-lg">
        <h1 class="text-xl font-semibold text-slate-600">Selamat Datang, {{ Auth::user()->username }}!</h1>
        <div class="absolute left-0 w-full ocean -bottom-10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                </defs>
                <use xlink:href="#wave" x="48" y="18" fill="rgba(255,0,0,0.3)" />
                <use xlink:href="#wave" x="48" y="20" fill="rgba(255,0,0,0.1)" />
            </svg>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-5 my-5 md:grid-cols-2">
        <div class="relative flex items-center gap-5 px-4 py-6 overflow-hidden bg-white rounded-lg h-36">
            <div class="relative z-10 flex items-center justify-center h-14 w-14">
                <i class="text-5xl text-green-600 bi bi-person"></i>
            </div>
            <div class="relative">
                <h1 class="pb-1 text-lg font-semibold text-slate-700">1 Siswa</h1>
                <h3 class="text-sm text-slate-500">Total Online: 1</h3>
            </div>
            <div class="absolute left-0 w-full ocean -bottom-12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none"
                    shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(92,194,188,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(92,194,188,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex items-center gap-5 px-4 py-6 overflow-hidden bg-white rounded-lg h-36">
            <div class="flex items-center justify-center h-14 w-14">
                <i class="text-5xl text-yellow-600 bi bi-person-workspace"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">1 Guru</h1>
                <h3 class="text-sm text-slate-500">Total Online: 1</h3>
            </div>
            <div class="absolute left-0 w-full ocean -bottom-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none"
                    shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(243,172,60,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(243,172,60,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex items-center gap-5 px-4 py-6 overflow-hidden bg-white rounded-lg h-36">
            <div class="flex items-center justify-center h-14 w-14">
                <i class="text-5xl text-blue-600 bi bi-person-vcard"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">1 Staff Lainnya</h1>
                <h3 class="text-sm text-slate-500">Total Online: 1</h3>
            </div>
            <div class="absolute left-0 w-full ocean -bottom-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none"
                    shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(82,151,247,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(82,151,247,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex items-center gap-5 px-4 py-6 overflow-hidden bg-white rounded-lg h-36">
            <div class="flex items-center justify-center h-14 w-14">
                <i class="text-5xl text-orange-600 bi bi-people"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">1 Wali</h1>
                <h3 class="text-sm text-slate-500">Total Online: 1</h3>
            </div>
            <div class="absolute left-0 w-full ocean -bottom-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none"
                    shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(255,152,0,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(255,152,0,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex items-center gap-5 px-4 py-6 overflow-hidden bg-white rounded-lg h-36">
            <div class="flex items-center justify-center h-14 w-14">
                <i class="text-5xl bi bi-megaphone text-violet-600"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">1 Pengumuman</h1>
            </div>
            <div class="absolute left-0 w-full ocean -bottom-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none"
                    shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(129,83,243,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(129,83,243,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex items-center gap-5 px-4 py-6 overflow-hidden bg-white rounded-lg h-36">
            <div class="flex items-center justify-center h-14 w-14">
                <i class="text-5xl text-red-600 bi bi-newspaper"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">1 Berita</h1>
            </div>
            <div class="absolute left-0 w-full ocean -bottom-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none"
                    shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(255,0,0,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(255,0,0,0.1)" />
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 px-4 py-6 bg-white rounded-lg">
        <h1 class="text-xl font-semibold text-slate-600">📢 Pengumuman & Berita</h1>

        <ul class="mt-10">
            @foreach ($newsWithPhotos as $item)
                <li class="flex flex-wrap md:flex-nowrap gap-3 mb-5">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-sky-100">
                        <i class="text-xl bi bi-newspaper text-sky-900"></i>
                    </div>
                    <div class="w-full px-5 pt-3 pb-5 rounded body news-announcement bg-gray-50">
                        <div class="flex flex-wrap md:flex-nowrap gap-3">
                            <div>
                                <h1 class="text-xl font-semibold text-slate-700">{{ $item['news']->title }}</h1>
                                <h2 class="pt-2 text-xs text-slate-500">
                                    {{ $item['news']->created_at->format('d-M-Y') . ' ∙ ' . $item['news']->created_at->diffForHumans() }}
                                </h2>
                            </div>
                            <div>
                                <span
                                    class="flex items-center px-3 py-2 text-xs uppercase rounded-sm bg-sky-100 text-sky-800">{{ $item['news']->type == 'news' ? '📢 berita' : '📝 pengumuman' }}</span>
                            </div>
                        </div>
                        @if ($item['news']->image != null)
                            <img src="data:image/{{ $item['fileExt'] }};base64,{{ $item['fileData'] }}" alt="gambar"
                                class="object-cover my-5 rounded h-52 w-52">
                        @endif
                        <p class="mt-10 content">{!! Str::limit($item['news']->description, 250, '...') !!}</p>
                        <a href="/berita-pengumuman/{{ Crypt::encrypt($item['news']->id_news) }}" target="_blank">
                            <button class="w-20 h-8 mt-3 text-xs text-white bg-red-400 rounded hover:bg-red-600">
                                <i class="bi bi-arrow-up-right-square pe-2"></i> Baca</button>
                        </a>

                    </div>
                </li>
            @endforeach

        </ul>
        <div>
            {{-- pagination --}}
            {{-- {{ $newsWithPhotos->links() }} --}}
        </div>
    </div>
@endsection
