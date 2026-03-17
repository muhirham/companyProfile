@extends('layouts.admin')

@section('content')

    <style>
        .spec-grid-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: 0.2s ease;
        }

        .spec-grid-card:hover {
            transform: translateY(-4px);
        }

        .spec-img {
            height: 140px;
            object-fit: contain;
            margin: auto;
            display: block;
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
                    <div class="row align-items-end">

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

                        <div class="col-md-8 text-right">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addBrandModal">
                                + Add Brand
                            </button>

                            @if ($selectedBrand)
                                <button type="button" class="btn btn-danger"
                                    onclick="confirmDeleteBrand({{ $selectedBrand->id }})">
                                    Delete Brand
                                </button>
                            @endif
                        </div>

                    </div>
                </form>
            </div>
        </div>

        @if ($selectedBrand)
            {{-- ================= UPDATE BRAND ================= --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.genset.updateBrand', $selectedBrand->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row align-items-center">

                            <div class="col-md-3 text-center">
                                <img id="brandPreview" src="{{ $selectedBrand->logo_url }}" class="img-fluid mb-2"
                                    style="max-height:120px;">
                                <input type="file" name="logo" class="form-control"
                                    onchange="previewBrandImage(this)">
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

                                <button class="btn btn-primary">
                                    Update Brand
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            {{-- ================= SPEC HEADER ================= --}}
            <div class="d-flex justify-content-between mb-3">
                <h4>Specifications</h4>
                <button class="btn btn-success" data-toggle="modal" data-target="#addSpecModal">
                    Add Spec
                </button>
            </div>

            {{-- ================= SPEC GRID ================= --}}
            <div class="row">

                @foreach ($selectedBrand->specs as $spec)
                    <div class="col-md-3 mb-4">
                        <div class="spec-grid-card text-center">

                            <img src="{{ $spec->image_url }}" class="spec-img">

                            <h5 class="mt-3">{{ $spec->model }}</h5>

                            <div class="spec-action-wrap mt-3">

                                <button class="btn btn-sm btn-primary spec-btn"
                                        data-toggle="modal"
                                        data-target="#editSpecModal{{ $spec->id }}">
                                    Edit Brosur
                                </button>

                                <button class="btn btn-sm btn-primary spec-btn"
                                        data-toggle="modal"
                                        data-target="#editSpecDetailModal{{ $spec->id }}">
                                    Edit Model
                                </button>

                                <button class="btn btn-sm btn-danger spec-btn"
                                        onclick="confirmDelete('delete-form-{{ $spec->id }}')">
                                    Delete
                                </button>

                            </div>

                            <form id="delete-form-{{ $spec->id }}"
                                action="{{ route('admin.genset.deleteSpec', $spec->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>
                    </div>

                    @include('admin.products.modal-edit-spec', ['spec' => $spec])
                    @include('admin.products.modal-edit-spec-detail',['spec'=>$spec])
                @endforeach

            </div>
        @endif
    </div>

    {{-- ================= ADD BRAND MODAL ================= --}}
    <div class="modal fade" id="addBrandModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5>Add New Brand</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.genset.storeBrand') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Save Brand
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    @include('admin.products.modal-add-spec')

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.modal').appendTo('body');
        });

        function previewBrandImage(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('brandPreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewSpecImage(input, id) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(id).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmDelete(formId) {
            Swal.fire({
                title: 'Delete this spec?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((r) => {
                if (r.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        function confirmDeleteBrand(id) {
            Swal.fire({
                title: 'Delete this brand?',
                text: 'Brand must not have specs!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {

                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ url('admin/genset/brand') }}/" + id;

                    let csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = "{{ csrf_token() }}";

                    let method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';

                    form.appendChild(csrf);
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
    @if(session('success'))
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 1600,
            showConfirmButton: false
        });
        </script>
        @endif

        @if(session('error'))
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}'
        });
        </script>
        @endif

        @if($errors->any())
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
        </script>
        @endif
@endpush
