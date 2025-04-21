@extends('admin/template/temp1')
@section('content')
    <div class="grid grid-cols-1 rounded-lg bg-white px-5 py-6">
        <div class="header flex flex-col items-center justify-between gap-5 border-b pb-5 md:flex-row">
            <div>
                <h1 class="text-lg font-semibold text-red-600"><i class="bi bi-book-half pe-2"></i> Baca <span class="capitalize">{{ $news->type == 'Berita' ? 'Berita' : 'Pengumuman' }}</span>
                </h1>
            </div>
            <div>

            </div>
        </div>
        <div class="body news-announcement pt-10">
            <h2 class="pb-3 text-sm uppercase text-slate-400">{{ $news->type == 'Berita' ? '📢 Berita' : '📝 Pengumuman' }}
            </h2>
            <h1 class="text-xl font-semibold text-slate-700">{{ $news->title }}</h1>
            <h2 class="pt-2 text-xs text-slate-500">
                {{ $news->created_at->format('d-M-Y') . ' ∙ ' . $news->created_at->diffForHumans() }}</h2>
            @if ($news->image != null)
                <img src="data:image/{{ $fileExt }};base64,{{ $fileData }}" alt="Google Drive Image" class="my-5 h-96 w-full rounded object-cover">
            @endif
            <p class="content mt-10">{!! $news->description !!}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
