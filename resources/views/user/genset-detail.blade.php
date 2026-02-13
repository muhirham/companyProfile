@extends('layouts.userLayouts')
@section('content')
    <style>
        .spec-thumb {
            width: 70px;
            height: 55px;
            object-fit: cover;
            border-radius: 6px;
            transition: 0.2s ease;
        }

        .spec-thumb:hover {
            transform: scale(1.05);
        }

        .genset-top {
    margin-bottom: 30px;
}

.preview-box {
    width: 420px;
    height: 250px;
    background: #f8f9fa;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
}

.main-preview-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

    </style>
    <div class="page-section">

        <!-- BREADCRUMB -->
        <div class="breadcrumb-custom">
            Genset / <strong>{{ $brand->name }}</strong> / Capacity
        </div>

        <!-- TOP DETAIL -->
        <div class="genset-top d-flex justify-content-between align-items-start">
            <div class="powered-wrap">
                <div class="powered-text">Powered by:</div>
                <div class="powered-logo">
                    @php
                        $logo = $brand->logo
                            ? asset('storage/' . $brand->logo)
                            : asset('genset-website/img/brand/' . $brand->slug . '.png');
                    @endphp

                    <img src="{{ $logo }}" alt="{{ $brand->name }}">
                </div>
            </div>

            <!-- RIGHT SIDE (PREVIEW BESAR) -->
            <div class="preview-box text-center">
                @php
                    $firstSpec = $brand->specs->first();
                    $firstImg =
                        $firstSpec && $firstSpec->image
                            ? asset('storage/' . $firstSpec->image)
                            : asset('genset-website/imgGenset/1.jpg');
                @endphp

                <img id="mainPreview" src="{{ $firstImg }}" class="main-preview-img">
            </div>
        </div>

        <!-- TABLE -->
        <div class="spec-title">{{ $brand->name }} Series Specifications</div>

        <div class="table-responsive">
            <table class="table table-bordered table-spec align-middle">
                <thead>
                    <tr>
                        <th width="90">Image</th>
                        <th>Model</th>
                        <th>Engine</th>
                        <th>Alternator</th>
                        <th>KVA</th>
                        <th>KW</th>
                        <th>Fuel (L/H)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brand->specs as $spec)
                        <tr>
                            <td class="text-center">
                                @php
                                    $img = $spec->image
                                        ? asset('storage/' . $spec->image)
                                        : asset('genset-website/imgGenset/1.jpg');
                                @endphp

                                    <img src="{{ $img }}"
         class="spec-thumb"
         onclick="changePreview('{{ $img }}')"
         style="cursor:pointer;"
         alt="{{ $spec->model }}">
                            </td>

                            <td><strong>{{ $spec->model }}</strong></td>
                            <td>{{ $spec->engine }}</td>
                            <td>{{ $spec->alternator }}</td>
                            <td>{{ $spec->kva }}</td>
                            <td>{{ $spec->kw }}</td>
                            <td>{{ $spec->fuel }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@endsection
<script>
function changePreview(src) {
    document.getElementById('mainPreview').src = src;
}
</script>
