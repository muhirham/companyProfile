@extends('layouts.userLayouts')
@section('content')
    <!-- ===== BLOG LIST ===== -->
    <div class="page-section">
        <h4 class="mb-4">Berita & Artikel</h4>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="blog-card">
                    <img src="{{ asset('genset-website/imgGenset/1.jpg') }}" alt="">
                    <div class="blog-body">
                        <div class="blog-title">Tips Memilih Genset untuk Industri</div>
                        <p class="blog-desc">
                            Panduan memilih genset yang sesuai untuk kebutuhan industri dan proyek besar.
                        </p>
                        <a href="blog-detail.html?id=1" class="blog-link">
                            Baca selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="blog-card">
                    <img src="{{ asset('genset-website/imgGenset/2.jpg') }}" alt="">
                    <div class="blog-body">
                        <div class="blog-title">Perawatan Genset Agar Awet</div>
                        <p class="blog-desc">
                            Langkah-langkah perawatan genset agar tetap optimal dan tahan lama.
                        </p>
                        <a href="blog-detail.html?id=2" class="blog-link">
                            Baca selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="blog-card">
                    <img src="{{ asset('genset-website/imgGenset/3.jpg') }}" alt="">
                    <div class="blog-body">
                        <div class="blog-title">Genset Silent vs Open Type</div>
                        <p class="blog-desc">
                            Perbedaan genset silent dan open type serta penggunaannya.
                        </p>
                        <a href="blog-detail.html?id=3" class="blog-link">
                            Baca selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection