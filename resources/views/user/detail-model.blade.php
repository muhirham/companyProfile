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
            padding: 8px 12px;
        }

        .spec-table td:first-child {
            font-weight: 600;
            width: 220px;
        }
    </style>

    <div class="page-section detail-wrapper">

        <div class="breadcrumb-custom">
            Genset /
            <a href="{{ route('user.genset.detail', $brand->slug) }}">
                {{ $brand->name }}
            </a>
            /
            <strong>{{ $spec->model }}</strong>
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

                    <h5>Output</h5>
                    <table class="table spec-table">
                        <tr>
                            <td>PRP (KVA)</td>
                            <td>{{ $spec->prp_kva }}</td>
                        </tr>
                        <tr>
                            <td>ESP (KVA)</td>
                            <td>{{ $spec->esp_kva }}</td>
                        </tr>
                        <tr>
                            <td>PRP (KW)</td>
                            <td>{{ $spec->prp_kw }}</td>
                        </tr>
                        <tr>
                            <td>ESP (KW)</td>
                            <td>{{ $spec->esp_kw }}</td>
                        </tr>
                        <tr>
                            <td>Fuel (L/H)</td>
                            <td>{{ $spec->fuel }}</td>
                        </tr>
                    </table>

                    <hr>

                    <h5>Open Type</h5>
                    <table class="table spec-table">
                        <tr>
                            <td>Dimension (L x W x H)</td>
                            <td>{{ $spec->l_open }} x {{ $spec->w_open }} x {{ $spec->h_open }} mm</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>{{ $spec->kg_open }} kg</td>
                        </tr>
                    </table>

                    <hr>

                    <h5>Silent Type</h5>
                    <table class="table spec-table">
                        <tr>
                            <td>Dimension (L x W x H)</td>
                            <td>{{ $spec->l_silent }} x {{ $spec->w_silent }} x {{ $spec->h_silent }} mm</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>{{ $spec->kg_silent }} kg</td>
                        </tr>
                    </table>
                    <hr>
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                        Send Inquiry
                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- INQUIRY MODAL -->
    <div class="modal fade" id="inquiryModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form method="POST" action="{{ route('genset.inquiry.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Genset Inquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <!-- LEFT SIDE -->
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Notes</label>
                                    <textarea name="Notes" class="form-control"></textarea>
                                </div>

                            </div>

                            <!-- RIGHT SIDE -->
                            <div class="col-md-6">

                                <!-- BRAND -->
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

                                <!-- MODEL -->
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
                                    <p><strong>Engine:</strong> <span id="previewEngine">{{ $spec->engine }}</span></p>
                                    <p><strong>Alternator:</strong> <span
                                            id="previewAlternator">{{ $spec->alternator }}</span></p>

                                    <p><strong>PRP (KVA):</strong> <span id="previewPrpKva">{{ $spec->prp_kva }}</span></p>
                                    <p><strong>ESP (KVA):</strong> <span id="previewEspKva">{{ $spec->esp_kva }}</span></p>

                                    <p><strong>Fuel:</strong> <span id="previewFuel">{{ $spec->fuel }}</span> L/H</p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Submit Inquiry
                        </button>
                    </div>

                </form>

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
@endsection
