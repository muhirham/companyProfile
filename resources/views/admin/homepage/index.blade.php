@extends('layouts.admin')

@section('content')
<style>
/* Fix mobile table homepage */
#editHomepage .modal-dialog{
    max-width:700px;
}

#editHomepage .modal-body{
    min-height:350px;
}
@media (max-width: 768px) {

    .homepage-table table {
        font-size: 14px;
    }

    .homepage-table th {
        width: 45%;
        white-space: normal !important;
    }

    .homepage-table td {
        width: 55%;
        word-break: break-word;
    }

}
</style>
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

            {{-- ================== HOMEPAGE DATA ================== --}}
            <div class="card mb-4">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h4 class="mb-2 mb-md-0">Pengaturan Homepage</h4>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editHomepage">
                        Edit
                    </button>
                </div>

                <div class="card-body p-0">
                    @if ($homepage)
                        <div class="table-responsive homepage-table">
                            <table class="table table-striped table-bordered mb-0">
                                <tbody>
                                        <tr>
                                            <th class="text-nowrap">Hero Title</th>
                                            <td class="text-break">{{ $homepage->hero_title ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">Hero Subtitle</th>
                                            <td class="text-break">{{ $homepage->hero_subtitle ?? '-' }}</td>
                                        </tr>
                                        {{--
                                        <tr>
                                            <th class="text-nowrap">Years Experience</th>
                                            <td class="text-break">{{ $homepage->years_experience ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">Projects Completed</th>
                                            <td class="text-break">{{ $homepage->projects_completed ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">Support Service</th>
                                            <td class="text-break">{{ $homepage->support_service ?? '-' }}</td>
                                        </tr>
                                        --}}
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-3">
                            <p class="mb-0">Belum ada data homepage.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ================== SERVICES ================== 
            <div class="card mb-4">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h4 class="mb-2 mb-md-0">Service Homepage</h4>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editServices">
                        Edit
                    </button>
                </div>

                <div class="card-body">
                    <div class="row text-center">
                        @foreach ($services as $service)
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="border rounded p-3 h-100 d-flex flex-column justify-content-center">
                                    <div class="service-icon fs-3 mb-2">{{ $service->icon }}</div>
                                    <strong class="d-block">{{ $service->title }}</strong>
                                    <p class="text-muted small mb-0">{{ $service->subtitle }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            --}}

            {{-- ================== HERO SLIDER ================== --}}
            @if (!empty($homepage->hero_images))
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Hero Slider (Yang Tampil di User)</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($homepage->hero_images as $index => $slide)
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="border rounded p-2 text-center h-100 d-flex flex-column">
                                    <img src="{{ Storage::url($slide['image']) }}"
                                         class="img-fluid rounded mb-2"
                                         style="height:120px; object-fit:cover;">

                                    <div class="small text-muted">
                                        Slide {{ $index + 1 }}
                                    </div>

                                    <button class="btn btn-sm btn-danger mt-auto delete-hero"
                                        data-id="{{ $slide['id'] }}"
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
<form id="deleteHeroForm" method="POST" action="{{ route('admin.homepage.hero.delete') }}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="image_id" id="deleteHeroId">
</form>

    {{-- ================== MODAL EDIT HOMEPAGE ================== --}}
    <div class="modal fade" id="editHomepage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content">

                <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Homepage</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <h6 class="mb-3">Hero Section</h6>

                        <div class="form-group">
                            <label>Hero Title</label>
                            <input type="text"
                                name="hero_title"
                                class="form-control"
                                value="{{ $homepage->hero_title ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label>Hero Subtitle</label>
                            <textarea name="hero_subtitle"
                                    class="form-control"
                                    rows="3">{{ $homepage->hero_subtitle ?? '' }}</textarea>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label>Hero Slider Images</label>
                            <input type="file"
                                name="hero_images[]"
                                class="form-control"
                                multiple>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>

                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">
                            Batal
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>


{{-- ================== MODAL EDIT SERVICES ================== 
<div class="modal fade" id="editServices" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
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
                            <div class="col-12 col-md-6 mb-3">
                                <div class="border p-3 rounded h-100">
                                    <input type="text"
                                        name="services[{{ $service->id }}][icon]"
                                        class="form-control mb-2 icon-input"
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

                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden"
                                            name="services[{{ $service->id }}][is_active]"
                                            value="0">
                                        <input type="checkbox"
                                            name="services[{{ $service->id }}][is_active]"
                                            value="1"
                                            class="form-check-input"
                                            {{ $service->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label">
                                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                                        </label>
                                    </div>
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
--}}



@push('scripts')
<script>
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

@push('scripts')
<script>
$('#deleteHeroModal').on('show.bs.modal', function(event) {
    const button = $(event.relatedTarget)
    const imageId = button.data('id')
    const imageUrl = button.data('image')

    $('#delete-image-id').val(imageId)
    $('#delete-image-preview').attr('src', imageUrl)
})

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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.icon-input').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[a-zA-Z0-9]/g, '');
        });
        input.addEventListener('paste', function(e) {
            e.preventDefault();
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
document.querySelectorAll('.delete-hero').forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id
        let image = this.dataset.image

        Swal.fire({
            title: 'Hapus Slide?',
            text: "Gambar ini akan dihapus!",
            imageUrl: image,
            imageHeight: 150,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {

                document.getElementById('deleteHeroId').value = id
                document.getElementById('deleteHeroForm').submit()

            }

        })

    })

})
</script>

@endpush