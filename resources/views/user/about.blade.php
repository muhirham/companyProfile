@extends('layouts.userLayouts')
<style>
    /* ===== ABOUT ===== */
.about-image-wrap {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.about-img {
    width: 100%;
    max-width: 420px;   /* kontrol BESAR gambar */
    height: auto;
    object-fit: contain;
    border-radius: 12px;
}

</style>

@section('content')
    <div class="page-section">
        <div class="row align-items-center">

            {{-- IMAGE --}}
            <div class="col-md-5 mb-4 mb-md-0 text-center">
                <div class="about-image-wrap">
                    @if ($profile && $profile->about_image)
                        <img src="{{ asset('storage/' . $profile->about_image) }}" class="about-img" alt="About Us">
                    @else
                        <img src="{{ asset('genset-website/imgGenset/4.jpg') }}" class="about-img" alt="About Us">
                    @endif
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="col-md-7">
                <h2>About Us</h2>

                @if ($profile)
                    {!! $profile->description !!}
                @else
                    <p>Konten belum tersedia.</p>
                @endif
            </div>

        </div>
    </div>
@endsection
