<style>
    .modal-detail-custom {
        max-width: 900px;
        width: 90%;
    }

    .modal-detail-custom .modal-content {
        border-radius: 14px;
        border: none;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .modal-detail-custom .modal-header {
        background: #6777ef;
        color: #fff;
        padding: 18px 24px;
        border-radius: 14px 14px 0 0;
    }

    .modal-detail-custom .modal-body {
        padding: 25px;
    }

    .modal-detail-custom .modal-footer {
        padding: 18px 24px;
        border-top: 1px solid #eee;
    }

    .form-label {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 6px;
        color: #495057;
    }

    .form-control {
        border-radius: 8px;
    }

    @media(max-width:768px) {

        .modal-detail-custom {
            width: 95%;
            margin: auto;
        }

        .modal-detail-custom .modal-body {
            padding: 20px;
        }
    }
</style>


<div class="modal fade" id="editSpecDetailModal{{ $spec->id }}" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-detail-custom">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="mb-0">
                    Edit Model Detail - {{ $spec->model }}
                </h5>

                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.genset.updateSpecDetail', $spec->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe Mesin</label>
                            <input type="text" name="tipe_mesin"
                                value="{{ optional($spec->modelDetail)->tipe_mesin }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Silinder</label>
                            <input type="text" name="nomor_silinder"
                                value="{{ optional($spec->modelDetail)->nomor_silinder }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ukuran Silinder</label>
                            <input type="text" name="ukuran_silinder"
                                value="{{ optional($spec->modelDetail)->ukuran_silinder }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bore x Stroke</label>
                            <input type="text" name="bore_stroke"
                                value="{{ optional($spec->modelDetail)->bore_stroke }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Displacement</label>
                            <input type="text" name="displacement"
                                value="{{ optional($spec->modelDetail)->displacement }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kapasitas Minyak</label>
                            <input type="text" name="kapasitas_minyak"
                                value="{{ optional($spec->modelDetail)->kapasitas_minyak }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Generator</label>
                            <input type="text" name="generator" value="{{ optional($spec->modelDetail)->generator }}"
                                class="form-control">
                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-4">
                        Save Detail
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
