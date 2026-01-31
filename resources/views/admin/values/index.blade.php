@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>Nilai Perusahaan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Nilai Perusahaan</a></div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Nilai</h4>
            <div class="card-header-action">
                <button class="btn btn-primary" id="btn-add-value">
                    <i class="fas fa-plus"></i> Tambah Nilai
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-values">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:40px;">#</th>
                            <th class="text-center" style="width:120px;">Thumbnail</th>
                            <th>Nama Nilai</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width:80px;">Urutan</th>
                            <th class="text-center" style="width:150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="value-table-body">
                        @foreach ($values as $index => $value)
                            @php
                                $thumb = $value->image_path
                                    ? asset('storage/' . $value->image_path)
                                    : asset('compe/imgExample/images.png');
                            @endphp
                            <tr id="row-{{ $value->id }}">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    <img src="{{ $thumb }}" alt="thumb"
                                         class="img-thumbnail"
                                         style="height:60px;width:80px;object-fit:cover;">
                                </td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->description }}</td>
                                <td class="text-center">{{ $value->order }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button"
                                                class="btn btn-primary btn-detail-value"
                                                data-id="{{ $value->id }}"
                                                title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-warning btn-edit-value"
                                                data-id="{{ $value->id }}"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-danger btn-delete-value"
                                                data-id="{{ $value->id }}"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if($values->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">
                                    Belum ada data nilai perusahaan.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL ADD / EDIT --}}
<div class="modal fade" id="valueModal" tabindex="-1" role="dialog" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <form id="valueForm" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" id="value_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="valueModalLabel">Tambah Nilai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Nama Nilai</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" class="form-control" name="order" id="order" min="0" value="0">
          </div>

          <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" class="form-control" name="image" accept="image/*">
            <div id="image-preview" class="mt-2" style="display:none;">
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
<div class="modal fade" id="valueDetailModal" tabindex="-1" role="dialog" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detail_name">Detail Nilai</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div id="detail-image-wrapper" class="mb-3" style="text-align:center; display:none;">
                  <img id="detail_image" src="" alt="" class="img-fluid rounded">
              </div>

              <p id="detail_description" class="mb-0" style="white-space: pre-wrap;"></p>

              <hr>
              <small class="text-muted" id="detail_date"></small>
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

    function renderRow(v) {
        const imageUrl = v.image_url || fallbackImage;

        return `
        <tr id="row-${v.id}">
            <td class="text-center">${v.id}</td>
            <td class="text-center">
                <img src="${imageUrl}"
                     alt="thumb"
                     class="img-thumbnail"
                     style="height:60px;width:80px;object-fit:cover;">
            </td>
            <td>${v.name ?? ''}</td>
            <td>${v.description ?? ''}</td>
            <td class="text-center">${v.order ?? 0}</td>
            <td class="text-center">
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button"
                            class="btn btn-primary btn-detail-value"
                            data-id="${v.id}"
                            title="Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button"
                            class="btn btn-warning btn-edit-value"
                            data-id="${v.id}"
                            title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button"
                            class="btn btn-danger btn-delete-value"
                            data-id="${v.id}"
                            title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>`;
    }

    // ADD
    $('#btn-add-value').on('click', function () {
        $('#valueForm')[0].reset();
        $('#value_id').val('');
        $('#image-preview').hide();
        $('#valueModalLabel').text('Tambah Nilai');
        $('#valueModal').modal('show');
    });

    // EDIT (load)
    $(document).on('click', '.btn-edit-value', function () {
        const id = $(this).data('id');

        $.get("{{ route('admin.values.index') }}/" + id, function (res) {
            if (!res.success) return;
            const v = res.value;

            $('#value_id').val(v.id);
            $('#name').val(v.name ?? '');
            $('#description').val(v.description ?? '');
            $('#order').val(v.order ?? 0);

            if (v.image_url) {
                $('#image-preview img').attr('src', v.image_url);
                $('#image-preview').show();
            } else {
                $('#image-preview').hide();
            }

            $('#valueModalLabel').text('Edit Nilai');
            $('#valueModal').modal('show');
        });
    });

    // DETAIL
    $(document).on('click', '.btn-detail-value', function () {
        const id = $(this).data('id');

        $.get("{{ route('admin.values.index') }}/" + id, function (res) {
            if (!res.success) return;
            const v = res.value;

            $('#detail_name').text(v.name ?? 'Detail Nilai');
            $('#detail_description').text(v.description ?? '');

            if (v.image_url) {
                $('#detail_image').attr('src', v.image_url);
                $('#detail-image-wrapper').show();
            } else {
                $('#detail-image-wrapper').hide();
            }

            let dateTxt = '';
            if (v.created_at) dateTxt += 'Dibuat: ' + v.created_at;
            if (v.updated_at) {
                dateTxt += (dateTxt ? ' | ' : '') + 'Diupdate: ' + v.updated_at;
            }
            $('#detail_date').text(dateTxt);

            $('#valueDetailModal').modal('show');
        });
    });

    // SUBMIT (add / update)
    $('#valueForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        const id = $('#value_id').val();
        let url = "{{ route('admin.values.store') }}";

        if (id) {
            url = "{{ route('admin.values.index') }}/" + id;
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (!res.success || !res.value) {
                    alert('Gagal menyimpan data.');
                    return;
                }

                const rowHtml = renderRow(res.value);

                if (id) {
                    $('#row-' + id).replaceWith(rowHtml);
                } else {
                    $('#value-table-body').prepend(rowHtml);
                }

                $('#valueModal').modal('hide');
            },
            error: function (xhr) {
                let msg = 'Gagal menyimpan data.\n';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    msg += Object.values(errors).map(i => i.join(' ')).join('\n');
                }
                alert(msg);
            }
        });
    });

    // DELETE
    $(document).on('click', '.btn-delete-value', function () {
        if (!confirm('Yakin hapus nilai ini?')) return;

        const id = $(this).data('id');

        $.ajax({
            url: "{{ route('admin.values.index') }}/" + id,
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

