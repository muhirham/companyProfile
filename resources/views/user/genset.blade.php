@extends('layouts.userLayouts')
@section('content')
    <!-- ===== PAGE CONTENT ===== -->
    <div class="page-section">

        <div class="genset-title">
            <h1>Genset</h1>
        </div>

        <div class="genset-grid">

            <a href="genset-detail.html?brand=himoinsa" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/himoinsa.png') }}" alt="Himoinsa">
                </div>
                <div class="genset-label">Himoinsa</div>
            </a>

            <a href="genset-detail.html?brand=yanmar" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/yanmar.png') }}" alt="Yanmar">
                </div>
                <div class="genset-label">Yanmar</div>
            </a>

            <a href="genset-detail.html?brand=kubota" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/kubota.png') }}" alt="Kubota">
                </div>
                <div class="genset-label">Kubota</div>
            </a>

            <a href="genset-detail.html?brand=perkins" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/perkins.png') }}" alt="Perkins">
                </div>
                <div class="genset-label">Perkins</div>
            </a>

            <a href="genset-detail.html?brand=cummins" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/cummins.png') }}" alt="Cummins">
                </div>
                <div class="genset-label">Cummins</div>
            </a>

            <a href="genset-detail.html?brand=doosan" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/doosan.png') }}" alt="Doosan">
                </div>
                <div class="genset-label">Doosan</div>
            </a>

            <a href="genset-detail.html?brand=mitsubishi" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/mitsubishi.png') }}" alt="Mitsubishi">
                </div>
                <div class="genset-label">Mitsubishi</div>
            </a>

            <a href="genset-detail.html?brand=mtu" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/mtu.png') }}" alt="MTU">
                </div>
                <div class="genset-label">MTU</div>
            </a>

            <a href="genset-detail.html?brand=fpt" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ asset('genset-website/img/brand/fpt.png') }}" alt="FPT Iveco">
                </div>
                <div class="genset-label">FPT Iveco</div>
            </a>

        </div>
    </div>


@endsection