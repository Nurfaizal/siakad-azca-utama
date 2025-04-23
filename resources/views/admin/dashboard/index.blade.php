@extends('admin/template/temp1')
@section('content')
    <div class="relative grid grid-cols-1 overflow-hidden rounded-lg bg-white px-4 py-6">
        <h1 class="text-xl font-semibold text-slate-600">Selamat Datang, {{ Auth::user()->username }}!</h1>
        <div class="ocean absolute -bottom-10 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                </defs>
                <use xlink:href="#wave" x="48" y="18" fill="rgba(255,0,0,0.3)" />
                <use xlink:href="#wave" x="48" y="20" fill="rgba(255,0,0,0.1)" />
            </svg>
        </div>
    </div>
    <div class="my-5 grid grid-cols-1 gap-5 md:grid-cols-2">
        <div class="relative flex h-36 items-center gap-5 overflow-hidden rounded-lg bg-white px-4 py-6">
            <div class="relative z-10 flex h-14 w-14 items-center justify-center">
                <i class="bi bi-person text-5xl text-green-600"></i>
            </div>
            <div class="relative">
                <h1 class="pb-1 text-lg font-semibold text-slate-700">{{ $student_total }} Siswa</h1>
            </div>
            <div class="ocean absolute -bottom-12 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(92,194,188,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(92,194,188,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex h-36 items-center gap-5 overflow-hidden rounded-lg bg-white px-4 py-6">
            <div class="flex h-14 w-14 items-center justify-center">
                <i class="bi bi-person-workspace text-5xl text-yellow-600"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">{{ $teacher_total }} Guru</h1>
            </div>
            <div class="ocean absolute -bottom-10 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(243,172,60,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(243,172,60,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex h-36 items-center gap-5 overflow-hidden rounded-lg bg-white px-4 py-6">
            <div class="flex h-14 w-14 items-center justify-center">
                <i class="bi bi-person-vcard text-5xl text-blue-600"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">{{ $staff_total }} Staff Lainnya</h1>
            </div>
            <div class="ocean absolute -bottom-10 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(82,151,247,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(82,151,247,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex h-36 items-center gap-5 overflow-hidden rounded-lg bg-white px-4 py-6">
            <div class="flex h-14 w-14 items-center justify-center">
                <i class="bi bi-people text-5xl text-orange-600"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">{{ $guardian_total }} Wali</h1>
            </div>
            <div class="ocean absolute -bottom-10 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(255,152,0,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(255,152,0,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex h-36 items-center gap-5 overflow-hidden rounded-lg bg-white px-4 py-6">
            <div class="flex h-14 w-14 items-center justify-center">
                <i class="bi bi-megaphone text-5xl text-violet-600"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">{{ $announcement_total }} Pengumuman</h1>
            </div>
            <div class="ocean absolute -bottom-10 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(129,83,243,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(129,83,243,0.1)" />
                </svg>
            </div>
        </div>
        <div class="relative flex h-36 items-center gap-5 overflow-hidden rounded-lg bg-white px-4 py-6">
            <div class="flex h-14 w-14 items-center justify-center">
                <i class="bi bi-newspaper text-5xl text-red-600"></i>
            </div>
            <div>
                <h1 class="pb-1 text-lg font-semibold text-slate-700">{{ $news_total }} Berita</h1>
            </div>
            <div class="ocean absolute -bottom-10 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z" />
                    </defs>
                    <use xlink:href="#wave" x="48" y="0" fill="rgba(255,0,0,0.3)" />
                    <use xlink:href="#wave" x="48" y="3" fill="rgba(255,0,0,0.1)" />
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 rounded-lg bg-white px-4 py-6">
        <h1 class="text-xl font-semibold text-slate-600">📢 Pengumuman & Berita</h1>

        <ul class="mt-10">
            @foreach ($newsWithPhotos as $item)
                <li class="mb-5 flex flex-wrap gap-3 md:flex-nowrap">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-sky-100">
                        <i class="bi bi-newspaper text-xl text-sky-900"></i>
                    </div>
                    <div class="body news-announcement w-full rounded bg-gray-50 px-5 pb-5 pt-3">
                        <div class="flex flex-wrap gap-3 md:flex-nowrap">
                            <div>
                                <h1 class="text-xl font-semibold text-slate-700">{{ $item['news']->title }}</h1>
                                <h2 class="pt-2 text-xs text-slate-500">
                                    {{ $item['news']->created_at->format('d-M-Y') . ' ∙ ' . $item['news']->created_at->diffForHumans() }}
                                </h2>
                            </div>
                            <div>
                                <span class="flex items-center rounded-sm bg-sky-100 px-3 py-2 text-xs uppercase text-sky-800">{{ $item['news']->type == 'news' ? '📢 berita' : '📝 pengumuman' }}</span>
                            </div>
                        </div>
                        @if ($item['news']->image != null)
                            <img src="data:image/{{ $item['fileExt'] }};base64,{{ $item['fileData'] }}" alt="gambar" class="my-5 h-52 w-52 rounded object-cover">
                        @endif
                        <p class="content mt-10">{!! Str::limit($item['news']->description, 250, '...') !!}</p>
                        <a href="/berita-pengumuman/{{ Crypt::encrypt($item['news']->id_news) }}" target="_blank">
                            <button class="mt-3 h-8 w-20 rounded bg-red-400 text-xs text-white hover:bg-red-600">
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
