@extends('layouts.admin')

@section('content')
    <div class="section-header">
        <h1>Pesan Kontak</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pesan Kontak</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Pesan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-messages">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:40px;">#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $index => $msg)
                                        <tr id="row-{{ $msg->id }}"
                                            class="{{ !$msg->is_read ? 'table-warning' : '' }}">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $msg->name }}</td>
                                            <td>{{ $msg->email }}</td>
                                            <td>{{ $msg->created_at->format('d M Y H:i') }}</td>
                                            <td>
                                                <span id="status-{{ $msg->id }}"
                                                    class="badge {{ $msg->is_read ? 'badge-success' : 'badge-secondary' }}">
                                                    {{ $msg->is_read ? 'Dibaca' : 'Belum Dibaca' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info open-message"
                                                    data-id="{{ $msg->id }}" data-name="{{ $msg->name }}"
                                                    data-email="{{ $msg->email }}"
                                                    data-date="{{ $msg->created_at->format('d M Y H:i') }}"
                                                    data-subject="{{ $msg->subject }}" data-message="{{ $msg->message }}">
                                                    Detail
                                                </button>

                                                <button class="btn btn-danger btn-sm delete-message"
                                                    data-id="{{ $msg->id }}">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="messageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Pesan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="150">Nama</th>
                        <td id="modalName"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td id="modalEmail"></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td id="modalDate"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge badge-info" id="modalStatus"></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Subjek</th>
                        <td id="modalSubject"></td>
                    </tr>
                    <tr>
                        <th>Pesan</th>
                        <td id="modalMessage"></td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        let currentId = null;

        // =======================
        // OPEN DETAIL + MARK READ
        // =======================
        $(document).on('click', '.open-message', function() {
            currentId = $(this).data('id');

            $('#modalName').text($(this).data('name'));
            $('#modalEmail').text($(this).data('email'));
            $('#modalDate').text($(this).data('date'));
            $('#modalSubject').text($(this).data('subject'));
            $('#modalMessage').text($(this).data('message'));
            $('#modalStatus').text('Dibaca');

            $('#messageModal').modal('show');

            $.post('/admin/messages/read/' + currentId, {
                _token: '{{ csrf_token() }}'
            }, function() {
                $('#status-' + currentId)
                    .removeClass('badge-secondary')
                    .addClass('badge-success')
                    .text('Dibaca');

                $('#row-' + currentId).removeClass('table-warning');
            });
        });

        // =======================
        // DELETE MESSAGE (SWEETALERT2)
        // =======================
        $(document).on('click', '.delete-message', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus Pesan?',
                text: 'Pesan yang dihapus tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/messages/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            $('#row-' + id).fadeOut(300, function() {
                                $(this).remove();
                            });

                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: 'Pesan berhasil dihapus.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
