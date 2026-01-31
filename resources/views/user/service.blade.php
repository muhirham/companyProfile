@extends('layouts.userLayouts')
@section('content')
    <!-- ===== PAGE CONTENT ===== -->
    <div class="page-section">
        <h4 class="mb-4 text-primary">Service</h4>

        <div class="row g-4">

            <div class="col-md-4">
                <a href="service-detail.html?type=installation" class="service-link">
                    <div class="service-card">
                        <img src="{{ asset('genset-website/imgGenset/1.jpg') }}" alt="">
                        <div class="service-label">INSTALLATION</div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="service-detail.html?type=maintenance" class="service-link">
                    <div class="service-card">
                        <img src="{{ asset('genset-website/imgGenset/2.jpg') }}" alt="">
                        <div class="service-label">MAINTENANCE</div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="service-detail.html?type=rental" class="service-link">
                    <div class="service-card">
                        <img src="{{ asset('genset-website/imgGenset/3.jpg') }}" alt="">
                        <div class="service-label">RENTAL</div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection