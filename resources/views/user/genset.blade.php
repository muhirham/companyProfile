@extends('layouts.userLayouts')
@section('content')

<div class="page-section">

    <div class="genset-title">
        <h1>Genset</h1>
    </div>

    <div class="genset-grid">

        @foreach($brands as $brand)

            @php
                // fallback logo kalau kosong
                $logo = $brand->logo 
                    ? asset('storage/' . $brand->logo)
                    : asset('genset-website/img/brand/' . $brand->slug . '.png');
            @endphp

            <a href="{{ route('user.genset.detail', $brand->slug) }}" class="genset-item">
                <div class="genset-img-box">
                    <img src="{{ $logo }}" alt="{{ $brand->name }}">
                </div>
                <div class="genset-label">{{ $brand->name }}</div>
            </a>

        @endforeach

    </div>
</div>

@endsection
