@extends('layouts.admin')

@section('content')
    <div class="section-header">
        <h1>Homepage</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Homepage</a></div>
        </div>
    </div>

    <div class="section-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan Homepage</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editHomepage">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($homepage)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Hero Title</th>
                                    <td>{{ $homepage->hero_title ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Hero Subtitle</th>
                                    <td>{{ $homepage->hero_subtitle ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Years Experience</th>
                                    <td>{{ $homepage->years_experience ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Projects Completed</th>
                                    <td>{{ $homepage->projects_completed ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Support Service</th>
                                    <td>{{ $homepage->support_service ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <p>Belum ada data homepage.</p>
                    @endif
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Service Homepage</h4>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editServices">
                            Edit
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="row text-center">
                            @foreach ($services as $service)
                                <div class="col-md-3">
                                    <div class="service-icon fs-3">{{ $service->icon }}</div>
                                    <strong>{{ $service->title }}</strong>
                                    <p class="text-muted">{{ $service->subtitle }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if (!empty($homepage->hero_images))
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Hero Slider (Yang Tampil di User)</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @foreach ($homepage->hero_images as $index => $slide)
                                    <div class="col-md-3 mb-4">
                                        <div class="border rounded p-2 text-center">
                                            <img src="{{ Storage::url($slide['image']) }}" class="img-fluid rounded mb-2"
                                                style="height:120px; object-fit:cover;">

                                            <div class="small text-muted">
                                                Slide {{ $index + 1 }}
                                            </div>
                                            <button class="btn btn-sm btn-danger mt-2" data-toggle="modal"
                                                data-target="#deleteHeroModal" data-id="{{ $slide['id'] }}"
                                                data-image="{{ Storage::url($slide['image']) }}">
                                                Hapus
                                            </button>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endsection

    <div class="modal fade" id="editHomepage" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Edit Homepage</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <h6>Hero Section</h6>

                        <div class="form-group">
                            <label>Hero Title</label>
                            <input type="text" name="hero_title" class="form-control"
                                value="{{ $homepage->hero_title ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label>Hero Subtitle</label>
                            <textarea name="hero_subtitle" class="form-control">{{ $homepage->hero_subtitle ?? '' }}</textarea>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label>Hero Slider Images</label>
                            <input type="file" name="hero_images[]" class="form-control" multiple>
                        </div>
                        <hr>

                        <h6>Trust Counter</h6>

                        <div class="form-group">
                            <label>Years Experience</label>
                            <input type="number" name="years_experience" class="form-control"
                                value="{{ $homepage->years_experience ?? 15 }}">
                        </div>

                        <div class="form-group">
                            <label>Projects Completed</label>
                            <input type="number" name="projects_completed" class="form-control"
                                value="{{ $homepage->projects_completed ?? 500 }}">
                        </div>

                        <div class="form-group">
                            <label>Support Service</label>
                            <input type="number" name="support_service" class="form-control"
                                value="{{ $homepage->support_service ?? 24 }}">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteHeroModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{ route('admin.homepage.hero.delete') }}" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" name="image_id" id="delete-image-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">
                            <i class="fas fa-trash"></i> Hapus Slide
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body text-center">
                        <p>Yakin mau hapus gambar ini?</p>

                        <img id="delete-image-preview" src="" class="img-fluid rounded border"
                            style="max-height:180px">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button class="btn btn-danger">
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editServices" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('admin.homepage.services.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Service Homepage</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded">
                                    <input type="text"
                                        name="services[{{ $service->id }}][icon]"
                                        class="form-control mb-2"
                                        placeholder="Icon"
                                        value="{{ $service->icon }}">

                                    <input type="text"
                                        name="services[{{ $service->id }}][title]"
                                        class="form-control mb-2"
                                        placeholder="Judul"
                                        value="{{ $service->title }}">

                                    <input type="text"
                                        name="services[{{ $service->id }}][subtitle]"
                                        class="form-control"
                                        placeholder="Subtitle"
                                        value="{{ $service->subtitle }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>



    @push('scripts')
        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');

                    setTimeout(() => alert.remove(), 300);
                }
            }, 3000); // 3 detik
        </script>
    @endpush
    @push('scripts')
        <script>
            $('#deleteHeroModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget)
                const imageId = button.data('id')
                const imageUrl = button.data('image')

                $('#delete-image-id').val(imageId)
                $('#delete-image-preview').attr('src', imageUrl)
            })

            // auto close success alert
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 300);
                }
            }, 3000);
        </script>
    @endpush

