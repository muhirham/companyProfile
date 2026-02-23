@extends('layouts.admin')

@section('content')
    <div class="section-header">
        <h1>Berita</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Berita</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Semua Data</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" id="btn-add-post">
                        <i class="fas fa-plus"></i> Tambah Berita
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-posts">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:60px;">#</th>
                                <th style="width:120px;" class="text-center">Thumbnail</th>
                                <th>Judul</th>
                                <th class="text-center" style="width:120px;">Status</th>
                                <th class="text-center" style="width:130px;">Dibuat</th>
                                <th class="text-center" style="width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="post-table-body">
                            @foreach ($posts as $post)
                                @php
                                    $thumb = $post->image_url;
                                @endphp

                                <tr id="row-{{ $post->id }}">
                                    <td class="text-center">{{ $post->id }}</td>
                                    <td class="text-center">
                                        <img src="{{ $thumb }}" alt="thumb" class="img-thumbnail"
                                            style="height:60px;width:80px;object-fit:cover;">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td class="text-center">
                                        @if ($post->status === 'published')
                                            <span class="badge badge-success">Publish</span>
                                        @else
                                            <span class="badge badge-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $post->created_at?->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-primary btn-detail-post"
                                                data-id="{{ $post->id }}" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-edit-post"
                                                data-id="{{ $post->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-delete-post"
                                                data-id="{{ $post->id }}" title="Hapus">
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

    {{-- MODAL FORM ADD/EDIT --}}
    <div class="modal fade" id="postModal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <form id="postForm">
                @csrf
                <input type="hidden" id="post_id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postModalLabel">Tambah Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>

                        <div class="form-group">
                            <label>Slug (optional)</label>
                            <input type="text" class="form-control" name="slug" id="slug">
                            <small class="text-muted">Kalau dikosongkan akan dibuat otomatis dari judul.</small>
                        </div>

                        <div class="form-group">
                            <label>Excerpt / Ringkasan</label>
                            <textarea class="form-control" name="excerpt" id="excerpt"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Konten</label>
                            <textarea class="form-control" name="body" id="body" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="draft">Draft</option>
                                <option value="published">Publish</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input type="file" class="form-control" name="image">
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
    <div class="modal fade" id="postDetailModal" tabindex="-1" role="dialog" data-backdrop="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postDetailTitle">Detail Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="mb-2">
                        <span id="detail-status"></span>
                        <small class="text-muted ml-2" id="detail-date"></small>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">
                            Slug: <span id="detail-slug"></span>
                        </small>
                    </div>

                    <div id="detail-image-wrapper" class="mb-3" style="display:none;">
                        <img id="detail-image" src="" alt="" class="img-fluid rounded"
                            style="max-height:250px;">
                    </div>

                    <p class="text-muted" id="detail-excerpt"></p>
                    <hr>
                    <div id="detail-body" class="mb-0" style="white-space: pre-wrap;"></div>
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
    let blogEditor;

    $(document).ready(function () {

        // INIT CKEDITOR
        ClassicEditor
            .create(document.querySelector('#body'))
            .then(editor => {
                blogEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        const fallbackImage = "{{ asset('compe/imgExample/images.png') }}";

        function badgeStatus(status) {
            if (status === 'published') {
                return '<span class="badge badge-success">Publish</span>';
            }
            return '<span class="badge badge-secondary">Draft</span>';
        }

        function getImageUrl(post) {
            if (post.image_url) {
                return post.image_url;
            }
            if (post.image_path) {
                return "{{ asset('storage') }}/" + post.image_path;
            }
            return fallbackImage;
        }

        function renderRow(post) {
            const created = post.created_at || '';
            const badge = badgeStatus(post.status);
            const imageUrl = getImageUrl(post);

            return `
            <tr id="row-${post.id}">
                <td class="text-center">${post.id}</td>
                <td class="text-center">
                    <img src="${imageUrl}"
                         alt="thumb"
                         class="img-thumbnail"
                         style="height:60px;width:80px;object-fit:cover;">
                </td>
                <td>${post.title}</td>
                <td class="text-center">${badge}</td>
                <td class="text-center">${created}</td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button"
                                class="btn btn-primary btn-detail-post"
                                data-id="${post.id}"
                                title="Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button"
                                class="btn btn-warning btn-edit-post"
                                data-id="${post.id}"
                                title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button"
                                class="btn btn-danger btn-delete-post"
                                data-id="${post.id}"
                                title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        }

        // TOMBOL TAMBAH
        $('#btn-add-post').on('click', function() {
            $('#postForm')[0].reset();
            $('#post_id').val('');
            $('#postModalLabel').text('Tambah Berita');
            $('#image-preview').hide();

            if (blogEditor) {
                blogEditor.setData('');
            }

            $('#postModal').modal('show');
        });

        // DETAIL
        $(document).on('click', '.btn-detail-post', function() {
            const id = $(this).data('id');

            $.get("{{ url('admin/posts') }}/" + id, function(res) {
                if (!res || res.success === false) return;

                const p = res.post || res;

                $('#postDetailTitle').text(p.title || 'Detail Berita');
                $('#detail-status').html(badgeStatus(p.status));
                $('#detail-date').text(
                    (p.created_at ? 'Dibuat: ' + p.created_at : '') +
                    (p.updated_at ? ' | Diperbarui: ' + p.updated_at : '')
                );
                $('#detail-slug').text(p.slug || '-');
                $('#detail-excerpt').text(p.excerpt || '');

                const imgUrl = getImageUrl(p);
                if (imgUrl) {
                    $('#detail-image').attr('src', imgUrl);
                    $('#detail-image-wrapper').show();
                } else {
                    $('#detail-image-wrapper').hide();
                }

                $('#detail-body').html(p.body || '');
                $('#postDetailModal').modal('show');
            });
        });

        // EDIT
        $(document).on('click', '.btn-edit-post', function() {
            const id = $(this).data('id');

            $.get("{{ url('admin/posts') }}/" + id, function(res) {
                if (!res || res.success === false) return;

                const p = res.post || res;
                $('#post_id').val(p.id);
                $('#title').val(p.title);
                $('#slug').val(p.slug);
                $('#excerpt').val(p.excerpt);
                $('#status').val(p.status);

                if (blogEditor) {
                    blogEditor.setData(p.body || '');
                }

                const imgUrl = getImageUrl(p);
                if (imgUrl) {
                    $('#image-preview img').attr('src', imgUrl);
                    $('#image-preview').show();
                } else {
                    $('#image-preview').hide();
                }

                $('#postModalLabel').text('Edit Berita');
                $('#postModal').modal('show');
            });
        });

        // SUBMIT
        $('#postForm').on('submit', function(e) {
            e.preventDefault();

            if (blogEditor) {
                $('#body').val(blogEditor.getData());
            }

            let formData = new FormData(this);
            const id = $('#post_id').val();
            let url = "{{ route('admin.posts.store') }}";

            if (id) {
                url = "{{ url('admin/posts') }}/" + id;
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (!res) {
                        alert('Gagal menyimpan data.');
                        return;
                    }

                    const p = res.post || res;
                    const rowHtml = renderRow(p);

                    if (id) {
                        $('#row-' + id).replaceWith(rowHtml);
                    } else {
                        $('#post-table-body').prepend(rowHtml);
                    }

                    document.activeElement.blur();
                    $('#postModal').modal('hide');
                },
                error: function(xhr) {
                    let msg = 'Gagal menyimpan data.\n';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        msg += Object.values(errors).map(function(item) {
                            return item.join(' ');
                        }).join('\n');
                    }
                    alert(msg);
                }
            });
        });

        // DELETE
        $(document).on('click', '.btn-delete-post', function() {
            if (!confirm('Yakin hapus berita ini?')) return;

            const id = $(this).data('id');

            $.ajax({
                url: "{{ url('admin/posts') }}/" + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#row-' + id).fadeOut(200, function() {
                        $(this).remove();
                    });
                },
                error: function() {
                    alert('Gagal menghapus data.');
                }
            });
        });

        $('.modal').appendTo('body');

    });
</script>
@endpush
