@extends('layouts.admin')

@section('content')
    <div class="section-header">
        <h1>Service</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="#">Service</a>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Semua Data Service</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                    class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Service Name</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Last Update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" id="checkbox-{{ $service->id }}">
                                                    <label for="checkbox-{{ $service->id }}"
                                                        class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </td>

                                            <td>
                                                <strong>{{ $service->name }}</strong>
                                                <div class="text-muted text-small">
                                                    {{ $service->short_description }}
                                                </div>
                                            </td>

                                            <td>
                                                <img src="{{ $service->image_url }}" width="80"
                                                    style="border-radius:8px;">
                                            </td>




                                            <td>
                                                <span class="badge badge-info">
                                                    {{ ucfirst($service->type) }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($service->is_active)
                                                    <div class="badge badge-success">Active</div>
                                                @else
                                                    <div class="badge badge-secondary">Inactive</div>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $service->updated_at->format('Y-m-d') }}
                                            </td>

                                            <td>
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                    data-target="#editServiceModal{{ $service->id }}">
                                                    Edit
                                                </button>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="text-muted mt-2">
                                * Service dibatasi 3 data: Installation, Maintenance, Rental
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ================= MODALS DI LUAR TABLE ================= --}}
    @foreach ($services as $service)
        <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('admin.service.update', $service->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Service</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>

                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Service Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $service->name }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Type</label>
                                <input type="text" name="type" value="{{ $service->type }}" class="form-control"
                                    required>
                            </div>


                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="short_description" class="form-control" rows="3">{{ $service->short_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="editor-{{ $service->id }}" class="form-control">
                                    {!! $service->description !!}
                                </textarea>

                            </div>
                            <div class="form-group">
                                <label>Current Image</label><br>
                                <img src="{{ $service->image_url }}" width="150" style="border-radius:8px;">
                            </div>

                            <div class="form-group">
                                <label>Upload New Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" {{ $service->is_active ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ !$service->is_active ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- ================= END MODALS ================= --}}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.modal').appendTo('body');
        });
    </script>
@endpush

@push('scripts')
    <script>
        @foreach ($services as $service)
            let editor{{ $service->id }};

            ClassicEditor
                .create(document.querySelector('#editor-{{ $service->id }}'))
                .then(editor => {
                    editor{{ $service->id }} = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        @endforeach
    </script>
@endpush
