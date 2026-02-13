<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>About Us - Bach Multi Global</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Swiper CSS (WAJIB) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('genset-website/css/style.css') }}">

</head>

<body>

    <div class="container">

        <!-- ===== TOP HEADER ===== -->
        <div class="row top-header align-items-center">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('genset-website/imgGenset/logo.png') }}" alt="Bach Multi Global">
            </div>
            <div class="col-md-6 header-right">
                <strong>Sales & Service:</strong> 021-3862351<br>
                PT. BACH MULTI GLOBAL<br>
                Jakarta Pusat<br>
            </div>
        </div>

        <!-- ===== NAV ===== -->
        <nav class="navbar navbar-expand-lg nav-wrapper">
            <div class="container-fluid">

                <!-- TOGGLER -->
                <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar">
                    ☰
                </button>

                <!-- MENU -->
                <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                    <ul class="navbar-nav gap-lg-4 text-center">

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                href="{{ route('about') }}">
                                About Us
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.genset*') ? 'active' : '' }}"
                                href="{{ route('user.genset') }}">
                                Genset
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('service*') ? 'active' : '' }}"
                                href="{{ route('service') }}">
                                Service
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}"
                                href="{{ route('blog') }}">
                                Blog
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">
                                Contact
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>


        @yield('content')


        <!-- ===== BRANDS ===== -->
        <div class="brands text-center mt-5">
            <div class="fw-bold mb-4">Powered by</div>

            <div class="brand-footer-wrapper">
                @foreach ($footerBrands as $brand)
                    @php
                        $logo = $brand->logo
                            ? asset('storage/' . $brand->logo)
                            : asset('genset-website/img/brand/' . $brand->slug . '.png');
                    @endphp

                    <a href="{{ route('user.genset.detail', $brand->slug) }}" class="brand-footer-item">
                        <img src="{{ $logo }}" alt="{{ $brand->name }}">
                    </a>
                @endforeach
            </div>
        </div>


        <!-- ===== WHATSAPP FLOAT ===== -->
        <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20tanya%20tentang%20produk" class="wa-float"
            target="_blank">

            <span class="wa-tooltip">Chat via WhatsApp</span>

            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
        </a>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
