@extends('layouts.userLayouts')
<style>
    .blog-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #eee;
    height: 100%;
}

.blog-thumb {
    width: 100%;
    height: 200px;              /* tinggi konsisten */
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    overflow: hidden;
}

.blog-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;          /* INI YANG BIKIN CAKEP */
}

</style>
@section('content')
    <div class="page-section">
        <h4 class="mb-4">Berita & Artikel</h4>

        <div class="row g-4">

            @forelse($posts as $post)
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-thumb">
                            <img src="{{ $post->image_url }}"alt="{{ $post->title }}">
                        </div>

                        <div class="blog-body">
                            <div class="blog-title">{{ $post->title }}</div>

                            <p class="blog-desc">
                                {{ $post->excerpt }}
                            </p>

                            <a href="{{ route('blog-detail', $post->slug) }}" class="blog-link">
                                Baca selengkapnya →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Belum ada artikel.</p>
            @endforelse

        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
