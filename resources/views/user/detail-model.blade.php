@extends('layouts.userLayouts')

@section('content')
    <style>
        .detail-wrapper {
            padding: 40px 0;
        }

        .detail-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .detail-img {
            width: 100%;
            max-height: 420px;
            object-fit: contain;
        }

        .spec-table td {
            padding: 10px 12px;
            vertical-align: middle;
        }

        .spec-table td:first-child {
            font-weight: 600;
            width: 230px;
            white-space: nowrap;
        }

        .spec-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }

        .spec-table td:last-child {
            padding-left: 18px;
        }

        /* ================= Breadcrumb ================= */

        .breadcrumb-custom {
            text-align: center;
            font-size: 20px;
            margin: 25px 0;
        }

        /* item biasa */
        .breadcrumb-item {
            color: #666;
            text-decoration: none;
            font-weight: 500;
        }

        /* hover */
        .breadcrumb-item:hover {
            color: #0d6efd;
        }

        /* item aktif */
        .breadcrumb-active {
            color: #0d6efd;
            font-weight: 600;
        }

        /* separator */
        .breadcrumb-custom span {
            margin: 0 6px;
            color: #062bff;
        }
    </style>

    <div class="page-section detail-wrapper">

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
                {{ $spec->model }}
            </span>

        </div>

        <div class="detail-card">

            <div class="row">

                <div class="col-md-6 text-center">
                    <img src="{{ $spec->image_url }}" class="detail-img">
                </div>

                <div class="col-md-6">

                    <h2>{{ $spec->model }}</h2>
                    <p><strong>Engine:</strong> {{ $spec->engine }}</p>
                    <p><strong>Alternator:</strong> {{ $spec->alternator }}</p>

                    <hr>

                    <h5>Engine Data</h5>
                    <hr>
                    <table class="table spec-table">
                        <tr>
                            <td>Tipe Mesin</td>
                            <td>:</td>
                            <td>{{ optional($spec->modelDetail)->tipe_mesin }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Silinder</td>
                            <td>:</td>
                            <td>{{ optional($spec->modelDetail)->nomor_silinder }}</td>
                        </tr>
                        <tr>
                            <td>Ukuran Silinder</td>
                            <td>:</td>
                            <td>{{ optional($spec->modelDetail)->ukuran_silinder }}</td>
                        </tr>
                        <tr>
                            <td>Bore x Stroke</td>
                            <td>:</td>
                            <td>{{ optional($spec->modelDetail)->bore_stroke }}</td>
                        </tr>
                        <tr>
                            <td>Displacement</td>
                            <td>:</td>
                            <td>{{ optional($spec->modelDetail)->displacement }}</td>
                        </tr>
                        <tr>
                            <td>Konsumsi Bahan Bakar</td>
                            <td>:</td>
                            <td>{{ $spec->fuel }}</td>
                        </tr>
                        <tr>
                            <td>Kapasitas Minyak</td>
                            <td>:</td>
                            <td>{{ optional($spec->modelDetail)->kapasitas_minyak }}</td>
                        </tr>
                        <tr>
                            <td>Generator</td>
                            <td>:</td>
                            <td>{{ optional($spec->modelDetail)->generator }}</td>
                        </tr>
                    </table>

                    <h5 class="mt-4 mb-3">
                        Permintaan Penawaran
                    </h5>
                    <hr>
                    {{-- 
                    <form method="POST" action="{{ route('genset.inquiry.store') }}" id="inquiryForm"
                        style="display:none;">
                    --}}
                    <form method="POST" action="{{ route('genset.inquiry.store') }}" id="inquiryForm">
                        @csrf
                        <input type="hidden" name="genset_spec_id" value="{{ $spec->id }}">

                        <div class="mt-4">

                            <div class="row">

                                <div class="col-md-9">

                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Alamat email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>No. Telp</label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Alamat</label>
                                        <textarea name="address" class="form-control"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label>Permintaan</label>
                                        <textarea name="note" class="form-control"></textarea>
                                    </div>

                                </div>

                                {{-- 
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label>Brand</label>

                                        <select id="brandSelect" class="form-control">

                                            @foreach (App\Models\Brand::where('is_active', 1)->get() as $b)
                                                <option value="{{ $b->id }}"
                                                    {{ $b->id == $brand->id ? 'selected' : '' }}>
                                                    {{ $b->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>


                                    <div class="mb-3">

                                        <label>Model</label>

                                        <select name="genset_spec_id" id="specSelect" class="form-control" required>

                                            @foreach ($brand->specs as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ $s->id == $spec->id ? 'selected' : '' }}>
                                                    {{ $s->model }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>


                                    <hr>


                                    <div id="specPreview">

                                        <div class="text-center mb-3">
                                            <img id="previewImage" src="{{ $spec->image_url }}"
                                                style="max-height:150px;object-fit:contain;">
                                        </div>

                                        <h6 id="previewModel">{{ $spec->model }}</h6>

                                        <p><strong>Engine:</strong>
                                            <span id="previewEngine">{{ $spec->engine }}</span>
                                        </p>

                                        <p><strong>Alternator:</strong>
                                            <span id="previewAlternator">{{ $spec->alternator }}</span>
                                        </p>

                                        <p><strong>PRP (KVA):</strong>
                                            <span id="previewPrpKva">{{ $spec->prp_kva }}</span>
                                        </p>

                                        <p><strong>ESP (KVA):</strong>
                                            <span id="previewEspKva">{{ $spec->esp_kva }}</span>
                                        </p>

                                        <p><strong>Fuel:</strong>
                                            <span id="previewFuel">{{ $spec->fuel }}</span> L/H
                                        </p>

                                    </div>

                                </div>
                                --}}

                            </div>

                            <button type="submit" class="btn btn-dark mt-3">
                                Kirim Permintaan
                            </button>

                        </div>

                    </form>
                </div>

            </div>

        </div>

    </div>


    <script>
        let allSpecs = [];

        /* ===============================
           GET SPECS WHEN BRAND CHANGE
        ================================ */
        document.getElementById('brandSelect')
            .addEventListener('change', function() {

                let brandId = this.value;

                fetch(`/genset-specs/${brandId}`)
                    .then(response => response.json())
                    .then(data => {

                        allSpecs = data;

                        let specSelect = document.getElementById('specSelect');
                        specSelect.innerHTML = '';

                        data.forEach(spec => {
                            let option = document.createElement('option');
                            option.value = spec.id;
                            option.text = spec.model;
                            specSelect.appendChild(option);
                        });

                        // Auto select first spec
                        if (data.length > 0) {
                            updatePreview(data[0]);
                        }

                    });

            });


        /* ===============================
           UPDATE WHEN MODEL CHANGE
        ================================ */
        document.getElementById('specSelect')
            .addEventListener('change', function() {

                let selectedId = this.value;

                let selectedSpec = allSpecs.find(spec => spec.id == selectedId);

                if (selectedSpec) {
                    updatePreview(selectedSpec);
                }

            });


        /* ===============================
           UPDATE PREVIEW FUNCTION
        ================================ */
        function updatePreview(spec) {

            document.getElementById('previewModel').innerText = spec.model;
            document.getElementById('previewEngine').innerText = spec.engine;
            document.getElementById('previewAlternator').innerText = spec.alternator;
            document.getElementById('previewPrpKva').innerText = spec.prp_kva;
            document.getElementById('previewEspKva').innerText = spec.esp_kva;
            document.getElementById('previewFuel').innerText = spec.fuel;

            if (spec.image) {
                document.getElementById('previewImage').src = '/storage/' + spec.image;
            }
        }

    </script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Tutup modal kalau masih terbuka
                let modal = bootstrap.Modal.getInstance(document.getElementById('inquiryModal'));
                if (modal) {
                    modal.hide();
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
@endsection
