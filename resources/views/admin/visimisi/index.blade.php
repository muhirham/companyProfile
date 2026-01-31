@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>Visi & Misi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Visi & Misi</a></div>
    </div>
</div>

<div class="section-body">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="alert-title">Terjadi kesalahan</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Pengaturan Visi & Misi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.vision-mission.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Visi</label>
                    <textarea
                        name="vision"
                        id="vision"
                        class="form-control summernote"
                    >{{ old('vision', $vm->vision) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Misi</label>
                    <textarea
                        name="mission"
                        id="mission"
                        class="form-control summernote"
                    >{{ old('mission', $vm->mission) }}</textarea>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted">
            Terakhir diperbarui:
            {{ $vm->updated_at ? $vm->updated_at->format('d-m-Y H:i') : '-' }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    // aktifkan summernote untuk kedua textarea
    $('.summernote').summernote({
        height: 200
    });
});
</script>
@endpush

