@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>About Us</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Konten About (Tampilan User)</h4>
            <button class="btn btn-primary" id="btn-edit">
                <i class="fas fa-edit"></i> Edit
            </button>
        </div>

        <div class="card-body">
            <div class="row align-items-center">

                {{-- GAMBAR --}}
                <div class="col-md-5 mb-4 mb-md-0">
                    @if($profile->about_image)
                        <img
                            src="{{ asset('storage/'.$profile->about_image) }}"
                            class="img-fluid rounded"
                            style="object-fit:cover;max-height:320px;"
                        >
                    @else
                        <div class="text-muted fst-italic">
                            Belum ada gambar
                        </div>
                    @endif
                </div>

                {{-- KONTEN --}}
                <div class="col-md-7">
                    <h2>About Us</h2>

                    @if($profile->description)
                        {!! $profile->description !!}
                    @else
                        <p class="text-muted">Konten belum diisi.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

{{-- MODAL EDIT --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form
            method="POST"
            action="{{ route('admin.about.update', $profile->id) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit About Us</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    {{-- IMAGE --}}
                    <div class="form-group">
                        <label>Gambar About (kiri)</label>
                        <input type="file" name="about_image" class="form-control-file">
                        <small class="text-muted">
                            Landscape • max 2MB • akan mengganti gambar lama
                        </small>
                    </div>

                    {{-- CONTENT --}}
                    <div class="form-group mt-3">
                        <label>Konten About</label>
                        <textarea
                            id="about-editor"
                            class="form-control"
                            rows="6"
                        >{!! $profile->description !!}</textarea>

                        <textarea name="description" hidden></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
let editor;

$('#btn-edit').on('click', () => {
    $('#editModal').modal('show');
});

ClassicEditor
    .create(document.querySelector('#about-editor'))
    .then(e => editor = e);

$('form').on('submit', function () {
    $('textarea[name="description"]').val(editor.getData());
});
</script>
@endpush
