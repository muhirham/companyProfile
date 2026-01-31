@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>Galeri</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Galeri</a></div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Foto</h4>
            <div class="card-header-action">
                <button class="btn btn-primary" id="btn-add-gallery">
                    <i class="fas fa-images"></i> Upload Foto
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-galleries">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:60px;">#</th>
                            <th class="text-center" style="width:120px;">Thumbnail</th>
                            <th>Judul</th>
                            <th class="text-center" style="width:120px;">Status</th>
                            <th class="text-center" style="width:130px;">Dibuat</th>
                            <th class="text-center" style="width:150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="gallery-table-body">
                        @foreach($galleries as $g)
                            @php
                                $thumb = $g->image_path
                                    ? asset('storage/' . $g->image_path)
                                    : asset('compe/imgExample/images.png');
                            @endphp
                            <tr id="row-{{ $g->id }}">
                                <td class="text-center">{{ $g->id }}</td>
                                <td class="text-center">
                                    <img src="{{ $thumb }}"
                                         alt="thumb"
                                         class="img-thumbnail"
                                         style="height:60px;width:80px;object-fit:cover;">
                                </td>
                                <td>{{ $g->title ?? '-' }}</td>
                                <td class="text-center">
                                    @if($g->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $g->created_at?->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button"
                                                class="btn btn-primary btn-detail-gallery"
                                                data-id="{{ $g->id }}"
                                                title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-warning btn-edit-gallery"
                                                data-id="{{ $g->id }}"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-danger btn-delete-gallery"
                                                data-id="{{ $g->id }}"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL ADD (MULTI UPLOAD) --}}
<div class="modal fade" id="galleryAddModal" tabindex="-1" role="dialog" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <form id="galleryAddForm" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Foto Galeri</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="alert alert-info mb-3">
            Pilih beberapa gambar sekaligus (multi upload).  
            Judul akan otomatis diambil dari nama file (bisa diedit nanti).
          </div>
          <div class="form-group">
            <label>File Gambar</label>
            <input type="file"
                   class="form-control"
                   name="images[]"
                   id="images"
                   multiple
                   accept="image/*"
                   required>
            <small class="text-muted">
                Tahan <b>Ctrl</b> / <b>Shift</b> untuk pilih banyak gambar sekaligus.
            </small>
          </div>
        </div>

        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="galleryEditModal" tabindex="-1" role="dialog" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <form id="galleryEditForm" enctype="multipart/form-data">
      @csrf
      <input type="hidden" id="edit_id" name="id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Foto Galeri</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Judul</label>
            <input type="text" class="form-control" name="title" id="edit_title">
          </div>

          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="is_active" id="edit_is_active">
              <option value="1">Aktif</option>
              <option value="0">Nonaktif</option>
            </select>
          </div>

          <div class="form-group">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
            <div id="edit-image-preview" class="mt-2" style="display:none;">
              <p class="mb-1">Gambar sekarang:</p>
              <img src="" alt="" class="img-thumbnail" style="max-height:150px;">
            </div>
          </div>
        </div>

        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="galleryDetailModal" tabindex="-1" role="dialog" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detail_title">Detail Foto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <div class="mb-2">
                  <span id="detail_status"></span>
                  <small class="text-muted ml-2" id="detail_date"></small>
              </div>

              <div id="detail-image-wrapper" class="mb-3" style="text-align:center;">
                  <img id="detail_image" src="" alt="" class="img-fluid rounded">
              </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {

    const fallbackImage = "{{ asset('compe/imgExample/images.png') }}";

    function badgeActive(isActive) {
        if (isActive) {
            return '<span class="badge badge-success">Aktif</span>';
        }
        return '<span class="badge badge-secondary">Nonaktif</span>';
    }

    function renderRow(item) {
        const created  = item.created_at || '';
        const status   = badgeActive(item.is_active);
        const imageUrl = item.image_url || fallbackImage;
        const title    = item.title || '-';

        return `
        <tr id="row-${item.id}">
            <td class="text-center">${item.id}</td>
            <td class="text-center">
                <img src="${imageUrl}"
                     alt="thumb"
                     class="img-thumbnail"
                     style="height:60px;width:80px;object-fit:cover;">
            </td>
            <td>${title}</td>
            <td class="text-center">${status}</td>
            <td class="text-center">${created}</td>
            <td class="text-center">
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button"
                            class="btn btn-primary btn-detail-gallery"
                            data-id="${item.id}"
                            title="Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button"
                            class="btn btn-warning btn-edit-gallery"
                            data-id="${item.id}"
                            title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button"
                            class="btn btn-danger btn-delete-gallery"
                            data-id="${item.id}"
                            title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>`;
    }

    // === ADD (MULTI UPLOAD) ===
    $('#btn-add-gallery').on('click', function () {
        $('#galleryAddForm')[0].reset();
        $('#galleryAddModal').modal('show');
    });

    $('#galleryAddForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.gallery.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (!res.success || !res.items) {
                    alert('Gagal upload gambar.');
                    return;
                }

                res.items.forEach(function (item) {
                    $('#gallery-table-body').prepend(renderRow(item));
                });

                $('#galleryAddModal').modal('hide');
                $('#galleryAddForm')[0].reset();
            },
            error: function (xhr) {
                let msg = 'Gagal upload gambar.\n';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    msg += Object.values(errors).map(function (item) {
                        return item.join(' ');
                    }).join('\n');
                }
                alert(msg);
            }
        });
    });

    // === DETAIL ===
    $(document).on('click', '.btn-detail-gallery', function () {
        const id = $(this).data('id');

        $.get("{{ route('admin.gallery.index') }}/" + id, function (res) {
            if (!res.success) return;

            const g = res.gallery;

            $('#detail_title').text(g.title || 'Detail Foto');
            $('#detail_status').html(badgeActive(g.is_active));

            let dateText = '';
            if (g.created_at) dateText += 'Dibuat: ' + g.created_at;
            if (g.updated_at) dateText += ' | Diupdate: ' + g.updated_at;
            $('#detail_date').text(dateText);

            const img = g.image_url || fallbackImage;
            $('#detail_image').attr('src', img);

            $('#galleryDetailModal').modal('show');
        });
    });

    // === EDIT: LOAD DATA ===
    $(document).on('click', '.btn-edit-gallery', function () {
        const id = $(this).data('id');

        $.get("{{ route('admin.gallery.index') }}/" + id, function (res) {
            if (!res.success) return;

            const g = res.gallery;

            $('#edit_id').val(g.id);
            $('#edit_title').val(g.title || '');
            $('#edit_is_active').val(g.is_active ? 1 : 0);

            if (g.image_url) {
                $('#edit-image-preview img').attr('src', g.image_url);
                $('#edit-image-preview').show();
            } else {
                $('#edit-image-preview').hide();
            }

            $('#galleryEditModal').modal('show');
        });
    });

    // === EDIT: SUBMIT ===
    $('#galleryEditForm').on('submit', function (e) {
        e.preventDefault();

        const id = $('#edit_id').val();
        let formData = new FormData(this);
        formData.append('_method', 'PUT');

        $.ajax({
            url: "{{ route('admin.gallery.index') }}/" + id,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (!res.success || !res.gallery) {
                    alert('Gagal menyimpan perubahan.');
                    return;
                }

                const rowHtml = renderRow(res.gallery);
                $('#row-' + id).replaceWith(rowHtml);

                $('#galleryEditModal').modal('hide');
            },
            error: function (xhr) {
                let msg = 'Gagal menyimpan perubahan.\n';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    msg += Object.values(errors).map(function (item) {
                        return item.join(' ');
                    }).join('\n');
                }
                alert(msg);
            }
        });
    });

    // === DELETE ===
    $(document).on('click', '.btn-delete-gallery', function () {
        if (!confirm('Yakin hapus foto ini dari galeri?')) return;

        const id = $(this).data('id');

        $.ajax({
            url: "{{ route('admin.gallery.index') }}/" + id,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                if (!res.success) {
                    alert('Gagal menghapus data.');
                    return;
                }
                $('#row-' + id).fadeOut(200, function () {
                    $(this).remove();
                });
            },
            error: function () {
                alert('Gagal menghapus data.');
            }
        });
    });

});
</script>
@endpush
