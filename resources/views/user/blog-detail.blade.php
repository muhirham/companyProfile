@extends('layouts.userLayouts')

@section('content')
<div class="page-section">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb-custom mb-3">
        <a href="{{ route('blog') }}">Blog</a>
        / <strong>{{ $post->title }}</strong>
    </div>

    {{-- IMAGE --}}
    <img
        src="{{ $post->image_path
            ? asset('storage/'.$post->image_path)
            : asset('genset-website/imgGenset/1.jpg') }}"
        class="blog-img"
        alt="{{ $post->title }}">

    {{-- TITLE --}}
    <div class="blog-title mb-2">
        {{ $post->title }}
    </div>

    {{-- META --}}
    <p class="text-muted mb-3">
        Diposting pada {{ $post->created_at->format('d M Y') }}
    </p>

    {{-- CONTENT --}}
    <div class="blog-content">
        {!! $post->body !!}
    </div>

</div>
@endsection
