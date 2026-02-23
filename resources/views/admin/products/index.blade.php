@extends('layouts.admin')

@section('content')
    <style>
        /* ================= MODAL ================= */

        .modal-slide-right .modal-dialog {
            position: fixed;
            right: 0;
            margin: 0;
            height: 100%;
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
        }

        .modal-slide-right.show .modal-dialog {
            transform: translateX(0);
        }

        .modal-slide-right .modal-content {
            height: 100%;
            border-radius: 0;
        }

        /* ================= TABLE GLOBAL ================= */


        /* ================= IMAGE CELL ================= */

        .image-cell {
            text-align: center;
            padding-bottom: 15px;
        }

        .image-cell img {
            display: block;
            margin: 0 auto 12px;
            max-width: 120px;
            height: auto;
        }

        .image-cell input[type="file"] {
            width: 100%;
            margin-top: 10px;
        }


        /* ================= TABLE NORMAL (DESKTOP) ================= */

/* ================= DESKTOP TABLE FIX ================= */

.table {
    table-layout: fixed;
    width: 100%;
}

.table th,
.table td {
    vertical-align: middle;
    text-align: center;
}

.table td input {
    width: 100%;
}

/* IMAGE COLUMN */
.image-cell {
    width: 140px;
    text-align: center;
}

.image-cell img {
    display: block;
    margin: 0 auto 6px;
    max-height: 60px;
    object-fit: contain;
}

.image-cell .btn {
    width: 100%;
}

/* ACTION COLUMN */
.table td:last-child {
    width: 120px;
}


/* ================= MOBILE ONLY ================= */

@media (max-width: 768px) {

    .table thead {
        display: none;
    }

    .table tbody tr {
        display: block;
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .table tbody td {
        display: block;
        width: 100%;
        border: none !important;
        padding: 6px 0;
    }

    .table tbody td::before {
        content: attr(data-label);
        font-size: 12px;
        font-weight: 600;
        color: #666;
        display: block;
        margin-bottom: 4px;
    }

    .table tbody td:last-child::before {
        display: none;
    }

    .table tbody td:last-child {
        display: flex;
        gap: 8px;
        margin-top: 8px;
    }

    .table tbody td:last-child .btn {
        flex: 1;
    }

    .image-cell img {
        max-height: 90px;
        margin-bottom: 10px;
    }

}

    </style>

    <div class="section-header">
        <h1>Genset Management</h1>
    </div>

    <div class="section-body">

        {{-- ================= BRAND SELECTOR ================= --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('admin.genset.index') }}">
                    <div class="row align-items-center">

                        <div class="col-md-4">
                            <label>Select Brand</label>
                            <select name="brand" class="form-control" onchange="this.form.submit()">

                                @foreach ($brands as $b)
                                    <option value="{{ $b->id }}"
                                        {{ $selectedBrand && $selectedBrand->id == $b->id ? 'selected' : '' }}>
                                        {{ $b->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                </form>

            </div>
        </div>


        @if ($selectedBrand)
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ $selectedBrand->name }}</h4>
                    <span class="badge badge-info">
                        {{ $selectedBrand->specs->count() }} Specs
                    </span>
                </div>

                <div class="card-body">

                    {{-- BRAND UPDATE --}}
                    <form action="{{ route('admin.genset.updateBrand', $selectedBrand->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-3 text-center">

                                <img src="{{ $selectedBrand->logo_url }}" id="brandLogoPreview" class="img-fluid mb-2"
                                    style="max-height:120px; object-fit:contain;">

                                <input type="file" name="logo" class="form-control"
                                    onchange="previewBrandLogo(event)">
                            </div>


                            <div class="col-md-9">

                                <div class="form-group">
                                    <label>Brand Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $selectedBrand->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ $selectedBrand->is_active ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ !$selectedBrand->is_active ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>

                                <button class="btn btn-primary btn-sm">
                                    Update Brand
                                </button>

                            </div>

                        </div>
                    </form>

                    <hr>

                    {{-- ADD SPEC --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $selectedBrand->name }}</h4>

                        <div>
                            <span class="badge badge-info mr-3">
                                {{ $selectedBrand->specs->count() }} Specs
                            </span>

                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addSpecModal">
                                <i class="fas fa-plus"></i> Add Spec
                            </button>
                        </div>
                    </div>


                    <hr>

                    {{-- SPEC TABLE --}}
                    <div class="mobile-table-wrapper">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th>Model</th>
                                    <th>Engine</th>
                                    <th>Alternator</th>
                                    <th>Image</th>
                                    <th>KVA</th>
                                    <th>KW</th>
                                    <th>Fuel</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($selectedBrand->specs as $spec)
                                    <tr>

                                        <td data-label="Model">
                                            <input type="text" name="model" value="{{ $spec->model }}"
                                                class="form-control form-control-sm"
                                                list="modelList{{ $selectedBrand->id }}"
                                                form="update-form-{{ $spec->id }}" required>
                                        </td>

                                        <td data-label="Engine">
                                            <input type="text" name="engine" value="{{ $spec->engine }}"
                                                class="form-control form-control-sm"
                                                form="update-form-{{ $spec->id }}">
                                        </td>

                                        <td data-label="Alternator">
                                            <input type="text" name="alternator" value="{{ $spec->alternator }}"
                                                class="form-control form-control-sm"
                                                form="update-form-{{ $spec->id }}">
                                        </td>

                                        <td data-label="Image" class="image-cell">
                                            <div class="mb-2 text-center">
                                                <img src="{{ $spec->image_url }}" id="preview_{{ $spec->id }}"
                                                    style="height:60px; object-fit:cover; border-radius:6px;">
                                            </div>

                                            <div class="custom-file-wrapper">
                                                <input type="file" name="image" id="file_{{ $spec->id }}"
                                                    style="display:none"
                                                    onchange="previewImage(this, 'preview_{{ $spec->id }}')"
                                                    form="update-form-{{ $spec->id }}">

                                                <label for="file_{{ $spec->id }}"
                                                    class="btn btn-outline-primary btn-sm btn-block">
                                                    <i class="fas fa-image"></i> Change Image
                                                </label>
                                            </div>

                                        </td>
                                        

                                        <td data-label="KVA">
                                            <input type="number" name="kva" value="{{ $spec->kva }}"
                                                class="form-control form-control-sm"
                                                form="update-form-{{ $spec->id }}">
                                        </td>

                                        <td data-label="KW">
                                            <input type="number" name="kw" value="{{ $spec->kw }}"
                                                class="form-control form-control-sm"
                                                form="update-form-{{ $spec->id }}">
                                        </td>

                                        <td data-label="Fuel">
                                            <input type="number" step="0.1" name="fuel"
                                                value="{{ $spec->fuel }}" class="form-control form-control-sm"
                                                form="update-form-{{ $spec->id }}">
                                        </td>

                                        <td data-label="Action">
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="gap:8px;">

                                                {{-- SAVE --}}
                                                <button type="button" class="btn btn-sm btn-primary px-3"
                                                    onclick="confirmUpdate('update-form-{{ $spec->id }}')">
                                                    <i class="fas fa-save"></i>
                                                </button>

                                                {{-- DELETE --}}
                                                <button type="button" class="btn btn-sm btn-danger px-3"
                                                    onclick="confirmDelete('delete-form-{{ $spec->id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </div>
                                        </td>

                                    </tr>

                                    {{-- UPDATE FORM --}}
                                    <form id="update-form-{{ $spec->id }}"
                                        action="{{ route('admin.genset.updateSpec', $spec->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                    </form>

                                    {{-- DELETE FORM --}}
                                    <form id="delete-form-{{ $spec->id }}"
                                        action="{{ route('admin.genset.deleteSpec', $spec->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach


                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        @endif
        <!-- ================= ADD SPEC MODAL ================= -->
        <div class="modal fade modal-slide-right" id="addSpecModal" tabindex="-1" role="dialog">

            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            Add Specification - {{ $selectedBrand->name }}
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('admin.genset.storeSpec') }}" method="POST">
                        @csrf
                        <input type="hidden" name="brand_id" value="{{ $selectedBrand->id }}">

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" name="model" class="form-control" list="modelList"
                                    placeholder="Enter or select model">

                                <datalist id="modelList">
                                    @foreach ($models as $model)
                                        <option value="{{ $model }}">
                                    @endforeach
                                </datalist>

                            </div>

                            <div class="form-group">
                                <label>Engine</label>
                                <input type="text" name="engine" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Alternator</label>
                                <input type="text" name="alternator" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Image</label>

                                <img id="previewImage" src="#" style="display:none;height:120px;"
                                    class="mb-2 rounded shadow">

                                <input type="file" name="image" class="form-control"
                                    onchange="previewSpecImage(event)">
                            </div>



                            <div class="row">
                                <div class="col-md-4">
                                    <label>KVA</label>
                                    <input type="number" name="kva" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label>KW</label>
                                    <input type="number" name="kw" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label>Fuel (L/H)</label>
                                    <input type="number" step="0.1" name="fuel" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success">
                                <i class="fas fa-save"></i> Save Specification
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        window.addEventListener('error', function(e) {
            console.warn('Ignored JS error:', e.message);
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.modal').appendTo('body');
        });

        function confirmUpdate(formId) {
            Swal.fire({
                title: 'Save changes?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, save!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        function confirmDelete(formId) {
            Swal.fire({
                title: 'Delete this spec?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }



        function previewBrandLogo(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('brandLogoPreview').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewSpecImage(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let output = document.getElementById('previewImage');
                output.src = e.target.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: @json(session('error'))
                });
            });
        </script>
    @endif
@endpush
