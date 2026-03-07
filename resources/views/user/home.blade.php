@extends('layouts.userLayouts')
@section('content')
    <!-- ===== HERO ===== -->

    <div class="hero-section">

        <!-- tombol kiri -->
        <div class="hero-nav hero-prev swiper-button-prev"></div>
        <!-- tombol kanan -->
        <div class="hero-nav hero-next swiper-button-next"></div>
                    <!-- pagination -->
            <div class="swiper-pagination hero-pagination"></div>

        <!-- HERO -->
        <div class="hero">

            <div class="swiper heroSwiper">

                <div class="swiper-wrapper">

                    @php
                        $heroImages = $homepage->hero_images ?? [];
                    @endphp

                    @if (!empty($heroImages))
                        @foreach ($heroImages as $slide)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url($slide['image']) }}">
                            </div>
                        @endforeach
                    @else
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="swiper-slide">
                                <img src="{{ asset('genset-website/imgGenset/' . $i . '.jpg') }}">
                            </div>
                        @endfor
                    @endif

                </div>

            </div>

            <div class="hero-overlay">
                <div>
                    <h1>{{ $homepage->hero_title ?? 'Reliable Power Solutions' }}</h1>
                    <p>{{ $homepage->hero_subtitle ?? 'Industrial-grade genset and energy solutions' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SERVICES =====
    <div class="section">
        <div class="row g-4 justify-content-center">

            @foreach ($services as $service)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                    <div class="service-card w-100 text-center">
                        <div class="service-icon">{{ $service->icon }}</div>
                        <h6>{{ $service->title }}</h6>
                        <p>{{ $service->subtitle }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    
    @if ($visionMission)
        <div class="section visi-misi">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="vm-box">
                        <h3>Visi</h3>
                        {!! $visionMission->vision ?? '-' !!}
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="vm-box">
                        <h3>Misi</h3>
                        {!! $visionMission->mission ?? '-' !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Visi misi belum di buat</p>
    @endif

    
    <div class="trust-section" id="trust">
        <div class="row text-center">
            <div class="col-md-4 trust-box">
                <h2 class="counter" data-target="{{ $homepage->years_experience ?? 15 }}">0</h2>
                <p>Years Experience</p>
            </div>
            <div class="col-md-4 trust-box">
                <h2 class="counter" data-target="{{ $homepage->projects_completed ?? 500 }}">0</h2>
                <p>Projects Completed</p>
            </div>
            <div class="col-md-4 trust-box">
                <h2 class="counter" data-target="{{ $homepage->support_service ?? 24 }}">0</h2>
                <p>Support Service</p>
            </div>
        </div>
    </div>
    -->

</div>


    <!-- ===== SCRIPT ===== -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.heroSwiper', {
        loop: true, // matikan loop

        grabCursor: true,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true // bullet mengikuti jumlah slide
        }
    });

        const counters = document.querySelectorAll('.counter');
        let started = false;

        window.addEventListener('scroll', () => {
            if (started) return;

            const trust = document.getElementById('trust');
            if (trust.getBoundingClientRect().top < window.innerHeight - 100) {
                started = true;
                counters.forEach(c => {
                    const t = +c.dataset.target;
                    let n = 0;
                    const step = t / 100;
                    const run = () => {
                        n += step;
                        c.innerText = n < t ? Math.ceil(n) : (t + (t == 24 ? '/7' : '+'));
                        if (n < t) requestAnimationFrame(run);
                    };
                    run();
                });
            }
        });
    </script>
@endsection
