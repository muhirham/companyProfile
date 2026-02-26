@extends('layouts.admin')

@section('content')
    <style>
        .section-header {
            margin-bottom: 25px;
        }

        .section-body {
            margin-top: 10px;
        }

        .inquiry-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* table */
        .table thead th {
            font-size: 13px;
            text-transform: uppercase;
            color: #6b7280;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }
    </style>

    <div class="section-header">
        <h1>Genset Inquiries</h1>
    </div>

    <div class="section-body">

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th width="140">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($inquiries as $q)
                                <tr>
                                    <td>{{ $q->name }}</td>
                                    <td>{{ $q->spec->brand->name ?? '-' }}</td>
                                    <td>{{ $q->spec->model ?? '-' }}</td>
                                    <td>{{ $q->phone }}</td>
                                    <td>{{ $q->created_at->format('d M Y') }}</td>
                                    <td class="text-nowrap">

                                        <div class="btn-group btn-group-sm">

                                            <button class="btn btn-light border" onclick="viewDetail({{ $q->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <button class="btn btn-light border text-danger"
                                                onclick="deleteInquiry({{ $q->id }})">
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

    {{-- ================= MODAL ================= --}}
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Inquiry Detail</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-5 text-center mb-3">
                            <img id="modalImage" class="img-fluid"
                                style="max-height:220px;object-fit:contain;display:none;">
                        </div>

                        <div class="col-md-7">

                            <h5 id="modalModel" class="mb-3"></h5>

                            <p><strong>Engine:</strong> <span id="modalEngine"></span></p>
                            <p><strong>Alternator:</strong> <span id="modalAlternator"></span></p>

                            <hr>

                            <p><strong>Name:</strong> <span id="modalName"></span></p>
                            <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                            <p><strong>Phone:</strong> <span id="modalPhone"></span></p>

                            <p><strong>Note:</strong></p>
                            <div class="bg-light p-3 rounded" id="modalNote"></div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a id="waButton" target="_blank" class="btn btn-success">
                        Reply via WhatsApp
                    </a>

                    <button class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection


{{-- ================= SCRIPT ================= --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#detailModal').appendTo("body");
        });
    </script>

    <script>
        function viewDetail(id) {

            fetch(`/admin/requests/${id}`)
                .then(response => response.json())
                .then(data => {

                    if (!data.success) return;

                    const q = data.inquiry;

                    $('#modalModel').text(q.model ?? '-');
                    $('#modalEngine').text(q.engine ?? '-');
                    $('#modalAlternator').text(q.alternator ?? '-');

                    $('#modalName').text(q.name ?? '-');
                    $('#modalEmail').text(q.email ?? '-');
                    $('#modalPhone').text(q.phone ?? '-');
                    $('#modalNote').text(q.note ?? '-');

                    if (q.image_url) {
                        $('#modalImage')
                            .attr('src', q.image_url)
                            .show();
                    } else {
                        $('#modalImage').hide();
                    }

                    // =========================
                    // FORMAT NOMOR WA
                    // =========================
                    let cleanPhone = (q.phone || '').replace(/[^0-9]/g, '');

                    if (cleanPhone.startsWith('0')) {
                        cleanPhone = '62' + cleanPhone.substring(1);
                    }

                    // =========================
                    // AMBIL TEMPLATE DARI CRUD
                    // =========================
                    let template = @json(optional($settings)->wa_template);

                    if (!template) {
                        alert('WA Template belum diatur di Website Settings!');
                        return;
                    }

                    // =========================
                    // REPLACE PLACEHOLDER
                    // =========================
                    let message = template
                        .replaceAll('{name}', q.name ?? '')
                        .replaceAll('{brand}', q.brand ?? '')
                        .replaceAll('{model}', q.model ?? '')
                        .replaceAll('{note}', q.note ?? '-');

                    // =========================
                    // CONVERT HTML → FORMAT WA
                    // =========================

                    // Bold
                    message = message.replace(/<strong>(.*?)<\/strong>/gi, '*$1*');
                    message = message.replace(/<b>(.*?)<\/b>/gi, '*$1*');

                    // Italic
                    message = message.replace(/<em>(.*?)<\/em>/gi, '_$1_');
                    message = message.replace(/<i>(.*?)<\/i>/gi, '_$1_');

                    // List
                    message = message.replace(/<li>(.*?)<\/li>/gi, '• $1\n');

                    // Paragraf
                    message = message.replace(/<\/p>/gi, '\n\n');

                    // Line break
                    message = message.replace(/<br\s*\/?>/gi, '\n');

                    // Hapus semua tag HTML
                    message = message.replace(/<[^>]+>/g, '');

                    // Hapus &nbsp;
                    message = message.replace(/&nbsp;/gi, ' ');

                    // Hapus spasi berlebihan di awal baris
                    message = message.replace(/^[ \t]+/gm, '');

                    // Rapikan banyak newline
                    message = message.replace(/\n{3,}/g, '\n\n').trim();

                    const encodedMessage = encodeURIComponent(message);

                    const waUrl = `https://wa.me/${cleanPhone}?text=${encodedMessage}`;

                    $('#waButton').attr('href', waUrl);

                    $('#detailModal').modal('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
</script>

    <script>
        function deleteInquiry(id) {

            Swal.fire({
                title: 'Delete this inquiry?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    fetch('/admin/requests/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted',
                                    timer: 1200,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });

                            }
                        });

                }

            });

        }
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 1500,
                showConfirmButton: false
            });
        </script>
    @endif

    
@endpush
