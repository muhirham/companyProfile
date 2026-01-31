@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>About Us</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">About Us</a></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Profil Perusahaan</h4>
                    <button type="button" class="btn btn-primary" id="btn-edit-profile">
                        <i class="fas fa-edit"></i> Edit Profil
                    </button>
                </div>
                <div class="card-body">
                    @if($profile)
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6 class="mb-2">Gambar About</h6>
                                @if($profile->about_image)
                                    <img src="{{ asset('storage/'.$profile->about_image) }}"
                                         alt="About Image"
                                         class="img-fluid rounded border"
                                         style="max-height:260px;object-fit:cover;">
                                @else
                                    <div class="text-muted">
                                        Belum ada gambar. Silakan upload di menu edit.
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th style="width: 220px;">Nama Perusahaan</th>
                                                <td>{{ $profile->company_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tagline</th>
                                                <td>{{ $profile->tagline }}</td>
                                            </tr>
                                            <tr>
                                                <th>Deskripsi Singkat</th>
                                                <td>{!! $profile->short_description !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Deskripsi</th>
                                                <td>{!! $profile->description !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>{!! $profile->address !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Telepon</th>
                                                <td>{{ $profile->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $profile->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Website</th>
                                                <td>{{ $profile->website }}</td>
                                            </tr>
                                            <tr>
                                                <th>Facebook</th>
                                                <td>{{ $profile->facebook_url }}</td>
                                            </tr>
                                            <tr>
                                                <th>Instagram</th>
                                                <td>{{ $profile->instagram_url }}</td>
                                            </tr>
                                            <tr>
                                                <th>LinkedIn</th>
                                                <td>{{ $profile->linkedin_url }}</td>
                                            </tr>
                                            <tr>
                                                <th>YouTube</th>
                                                <td>{{ $profile->youtube_url }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if($profile->map_embed_url)
                            <hr>
                            <h5 class="mb-3">Lokasi di Peta</h5>
                            <div class="embed-responsive embed-responsive-16by9">
                                {!! $profile->map_embed_url !!}
                            </div>
                        @endif
                    @else
                        <p>Belum ada data profil perusahaan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT PROFIL --}}
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document" id="profile-modal-dialog">
        <form id="profileForm"
              method="POST"
              action="{{ route('admin.about.update', $profile->id ?? 1) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profil Perusahaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        {{-- Kiri --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input type="text"
                                       name="company_name"
                                       class="form-control"
                                       value="{{ old('company_name', $profile->company_name ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>Tagline</label>
                                <input type="text"
                                       name="tagline"
                                       class="form-control"
                                       value="{{ old('tagline', $profile->tagline ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Singkat</label>
                                <textarea name="short_description"
                                          class="form-control"
                                          rows="3">{{ old('short_description', $profile->short_description ?? '') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Gambar About (Landscape)</label>
                                <input type="file" name="about_image" class="form-control-file">
                                <small class="text-muted d-block">
                                    Rekomendasi rasio 16:9, max 2MB. Jika diisi, gambar lama akan diganti.
                                </small>
                            </div>

                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       value="{{ old('phone', $profile->phone ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ old('email', $profile->email ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>Website</label>
                                <input type="text"
                                       name="website"
                                       class="form-control"
                                       value="{{ old('website', $profile->website ?? '') }}">
                            </div>
                        </div>

                        {{-- Kanan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description"
                                          id="description-editor"
                                          class="form-control"
                                          rows="5">{!! old('description', $profile->description ?? '') !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address"
                                          id="address-editor"
                                          class="form-control"
                                          rows="4">{!! old('address', $profile->address ?? '') !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Facebook URL</label>
                                <input type="text"
                                       name="facebook_url"
                                       class="form-control"
                                       value="{{ old('facebook_url', $profile->facebook_url ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>Instagram URL</label>
                                <input type="text"
                                       name="instagram_url"
                                       class="form-control"
                                       value="{{ old('instagram_url', $profile->instagram_url ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>LinkedIn URL</label>
                                <input type="text"
                                       name="linkedin_url"
                                       class="form-control"
                                       value="{{ old('linkedin_url', $profile->linkedin_url ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>YouTube URL</label>
                                <input type="text"
                                       name="youtube_url"
                                       class="form-control"
                                       value="{{ old('youtube_url', $profile->youtube_url ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>Map Embed (Iframe Google Maps)</label>
                                <textarea name="map_embed_url"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Paste iframe embed code dari Google Maps di sini...">{{ old('map_embed_url', $profile->map_embed_url ?? '') }}</textarea>
                                <small class="text-muted">
                                    Contoh: &lt;iframe src="..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"&gt;&lt;/iframe&gt;
                                </small>
                            </div>
                        </div>
                    </div> {{-- row --}}
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    let descriptionEditor, addressEditor;

    $(function () {
        $('#btn-edit-profile').on('click', function () {
            $('#profileModal').modal('show');
        });

        ClassicEditor
            .create(document.querySelector('#description-editor'))
            .then(editor => { descriptionEditor = editor; })
            .catch(error => { console.error(error); });

        ClassicEditor
            .create(document.querySelector('#address-editor'))
            .then(editor => { addressEditor = editor; })
            .catch(error => { console.error(error); });

        $('#profileForm').on('submit', function () {
            if (descriptionEditor) {
                $('textarea[name="description"]').val(descriptionEditor.getData());
            }
            if (addressEditor) {
                $('textarea[name="address"]').val(addressEditor.getData());
            }
        });
    });
</script>
@endpush
