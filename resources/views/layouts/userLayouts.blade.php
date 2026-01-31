<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About Us - Bach Multi Global</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <div class="nav-wrapper">
        <div class="main-nav">
            <a href="/homee" class="active">Home</a>
            <a href="/about">About Us</a>
            <a href="/genset">Genset</a>
            <a href="/service">Service</a>
            <a href="/blog">Blog</a>
            <a href="/contact">Contact</a>
        </div>
    </div>

@yield('content')


<!-- ===== BRANDS ===== -->
    <div class="brands text-center mt-5">
        <div class="fw-bold mb-3">Powered by</div>
        <img src="{{ asset('genset-website/img/brand/perkins.png') }}" alt="Perkins">
        <img src="{{ asset('genset-website/img/brand/kubota.png') }}" alt="Kubota">
        <img src="{{ asset('genset-website/img/brand/mitsubishi.png') }}" alt="Mitsubishi">
        <img src="{{ asset('genset-website/img/brand/mtu.png') }}" alt="MTU">
        <img src="{{ asset('genset-website/img/brand/himoinsa.png') }}" alt="Himoinsa">
        <img src="{{ asset('genset-website/img/brand/doosan.png') }}" alt="Doosan">
        <img src="{{ asset('genset-website/img/brand/yanmar.png') }}" alt="Yanmar">
    </div>

    <!-- ===== WHATSAPP FLOAT ===== -->
    <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20tanya%20tentang%20produk" 
    class="wa-float" 
    target="_blank">

        <span class="wa-tooltip">Chat via WhatsApp</span>

        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" 
            alt="WhatsApp">
    </a>
