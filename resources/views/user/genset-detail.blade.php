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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .main-preview-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .table-spec th {
            text-align: center;
            font-size: 13px;
        }

        .table-spec td {
            text-align: center;
            font-size: 13px;
        }

        .align-top {
            vertical-align: top !important;
            padding-top: 35px !important;
        }

        .table-spec th {
            text-align: center;
            vertical-align: top !important;
            padding-top: 18px !important;
        }

        .table-spec thead th[rowspan="3"] {
            vertical-align: top !important;
            padding-top: 40px !important;
        }

        .spec-title {
            background: #4a4a4a;
            color: #fff;
            padding: 10px 18px;
            font-weight: 600;
            border-radius: 12px 12px 0 0;
            display: inline-block;
        }

        .table-spec thead tr:first-child th {
            background: #0dcaf0;
            color: #000;
            font-weight: 600;
        }

        .table-spec thead tr:nth-child(2) th,
        .table-spec thead tr:nth-child(3) th {
            background: #0dcaf0;
        }

        .table-spec th {
            text-align: center;
            vertical-align: middle;
            font-size: 13px;
        }

        .table-spec td {
            text-align: center;
            font-size: 13px;
        }

        .spec-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .pdf-download-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #dc3545;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            transition: .2s ease;
        }

        .pdf-download-btn:hover {
            background: #b02a37;
            color: #fff;
        }
    /* ================= Breadcrumb ================= */

    .breadcrumb-custom{
        text-align:center;
        font-size:20px;
        margin:25px 0 35px;
    }

    .breadcrumb-custom span{
        margin:0 6px;
        color:#132aff;
    }

    /* item yang bukan halaman aktif */
    .breadcrumb-item{
        color:#555;
        text-decoration:none;
        font-weight:500;
    }

    .breadcrumb-item:hover{
        color:#0d6efd;
    }

    /* halaman aktif */
    .breadcrumb-active{
        color:#0d6efd;
        font-weight:600;
    }

        /* ================= MOBILE TABLE FIX ================= */

        @media (max-width:768px) {

            .table-spec thead {
                display: none;
            }

            .table-spec,
            .table-spec tbody,
            .table-spec tr,
            .table-spec td {
                display: block;
                width: 100%;
            }

            .table-spec tr {
                background: #fff;
                margin-bottom: 15px;
                border-radius: 10px;
                padding: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            }

            .table-spec td {
                border: none;
                display: flex;
                justify-content: space-between;
                padding: 6px 10px;
                font-size: 13px;
            }

            .table-spec td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #444;
            }

            .spec-thumb {
                width: 60px;
                height: 45px;
            }

            .spec-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .pdf-download-btn {
                font-size: 12px;
                padding: 6px 10px;
            }
        }
    </style>

    <div class="page-section">

        <!-- BREADCRUMB -->
            <div class="breadcrumb-custom">

                <a href="{{ route('user.genset') }}" class="breadcrumb-item">
                    Genset
                </a>

                <span>/</span>

                <a href="{{ route('user.genset.detail', $brand->slug) }}" class="breadcrumb-item">
                    {{ $brand->name }}
                </a>

                <span>/</span>

                <span class="breadcrumb-active">
                    Capacity
                </span>

            </div>

        <!-- TOP DETAIL -->
        <div class="genset-top d-flex justify-content-between align-items-start">
            <div class="powered-wrap">
                <div class="powered-text">Powered by:</div>
                <div class="powered-logo">
                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}">
                </div>
            </div>

            <div class="preview-box text-center">
                @php
                    $firstSpec = $brand->specs->first();
                    $firstImg = $firstSpec ? $firstSpec->image_url : asset('genset-website/imgGenset/1.jpg');
                @endphp

                <img id="mainPreview" src="{{ $firstImg }}" class="main-preview-img">
            </div>
        </div>

        <!-- TABLE -->
        <div class="spec-header">

            <div class="spec-title">
                {{ $brand->name }} Series Specifications
            </div>

            <a href="{{ route('genset.download.pdf', $brand->slug) }}" class="pdf-download-btn">
                <i class="fas fa-file-pdf"></i>
                Download PDF
            </a>

        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-spec">

                <thead>

                    <!-- ROW 1 -->
                    <tr>
                        <th rowspan="3" class="align-top">Image</th>
                        <th rowspan="3" class="align-top">Model</th>
                        <th rowspan="3" class="align-top">Engine</th>
                        <th rowspan="3" class="align-top">Alternator</th>

                        <th colspan="4">
                            Output<br>
                            <small>400/230V 50Hz 1500rpm</small>
                        </th>

                        <th rowspan="3" class="align-top">
                            100% Load<br>
                            Fuel Consumption (L/h)
                        </th>

                        <th colspan="4">OPEN TYPE</th>
                        <th colspan="4">SILENT TYPE</th>
                    </tr>

                    <!-- ROW 2 -->
                    <tr>
                        <th colspan="2">KVA</th>
                        <th colspan="2">KW</th>

                        <th colspan="3">L x W x H (mm)</th>
                        <th>Weight (Kg)</th>

                        <th colspan="3">L x W x H (mm)</th>
                        <th>Weight (Kg)</th>

                    </tr>

                    <!-- ROW 3 -->
                    <tr>
                        <th>PRP</th>
                        <th>ESP</th>
                        <th>PRP</th>
                        <th>ESP</th>

                        <th>L</th>
                        <th>W</th>
                        <th>H</th>
                        <th>(Kg)</th>

                        <th>L</th>
                        <th>W</th>
                        <th>H</th>
                        <th>(Kg)</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($brand->specs as $spec)
                        <tr>

                            <td data-label="Image">
                                <img src="{{ $spec->image_url }}" class="spec-thumb"
                                    onclick="changePreview('{{ $spec->image_url }}')" style="cursor:pointer;">
                            </td>

                            <td data-label="Model">
                                <a href="{{ route('user.genset.model.detail', [
                                    'brandSlug' => $brand->slug,
                                    'modelSlug' => strtolower($spec->model),
                                ]) }}"
                                    style="color:#0d6efd;font-weight:600;text-decoration:none;">
                                    {{ $spec->model }}
                                </a>
                            </td>

                            <td data-label="Engine">{{ $spec->engine }}</td>

                            <td data-label="Alternator">{{ $spec->alternator }}</td>

                            <td data-label="PRP KVA">{{ $spec->prp_kva }}</td>

                            <td data-label="ESP KVA">{{ $spec->esp_kva }}</td>

                            <td data-label="PRP KW">{{ $spec->prp_kw }}</td>

                            <td data-label="ESP KW">{{ $spec->esp_kw }}</td>

                            <td data-label="Fuel Consumption">{{ $spec->fuel }}</td>

                            <td data-label="Open L">{{ $spec->l_open }}</td>

                            <td data-label="Open W">{{ $spec->w_open }}</td>

                            <td data-label="Open H">{{ $spec->h_open }}</td>

                            <td data-label="Open Weight">{{ $spec->kg_open }}</td>

                            <td data-label="Silent L">{{ $spec->l_silent }}</td>

                            <td data-label="Silent W">{{ $spec->w_silent }}</td>

                            <td data-label="Silent H">{{ $spec->h_silent }}</td>

                            <td data-label="Silent Weight">{{ $spec->kg_silent }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

    <script>
        function changePreview(src) {
            document.getElementById('mainPreview').src = src;
        }
    </script>
@endsection
