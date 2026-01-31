@extends('layouts.userLayouts')
@section('content')
    <!-- ===== HERO ===== -->
    <div class="hero">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{ asset('genset-website/imgGenset/1.jpg') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('genset-website/imgGenset/2.jpg') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('genset-website/imgGenset/3.jpg') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('genset-website/imgGenset/4.jpg') }}" alt=""></div>
            </div>
        </div>

        <div class="hero-overlay">
            <div>
                <h1>Reliable Power Solutions</h1>
                <p>Industrial-grade genset and energy solutions</p>
            </div>
        </div>
    </div>

    <!-- ===== SERVICES ===== -->
    <div class="section">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">⚡</div>
                    <h6>Genset</h6>
                    <p>Industrial power</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">💡</div>
                    <h6>Lighting Tower</h6>
                    <p>Project lighting</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">🛠</div>
                    <h6>Maintenance</h6>
                    <p>Professional service</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">📦</div>
                    <h6>Spare Parts</h6>
                    <p>Original parts</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== VISI & MISI ===== -->
    <div class="section visi-misi">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="vm-box">
                    <h3>Visi</h3>
                    <p>
                        Menjadi perusahaan penyedia solusi energi dan genset
                        terpercaya di Indonesia dengan mengutamakan kualitas,
                        keandalan, dan kepuasan pelanggan.
                    </p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="vm-box">
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyediakan produk genset berkualitas tinggi.</li>
                        <li>Memberikan layanan service dan maintenance profesional.</li>
                        <li>Mengutamakan keselamatan dan efisiensi kerja.</li>
                        <li>Membangun hubungan jangka panjang dengan pelanggan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== TRUST ===== -->
    <div class="trust-section" id="trust">
        <div class="row text-center">
            <div class="col-md-4 trust-box">
                <h2 class="counter" data-target="15">0</h2>
                <p>Years Experience</p>
            </div>
            <div class="col-md-4 trust-box">
                <h2 class="counter" data-target="500">0</h2>
                <p>Projects Completed</p>
            </div>
            <div class="col-md-4 trust-box">
                <h2 class="counter" data-target="24">0</h2>
                <p>Support Service</p>
            </div>
        </div>
    </div>

    



</div>


<!-- ===== SCRIPT ===== -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
new Swiper('.heroSwiper',{
    loop:true,
    autoplay:{ delay:4000 }
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