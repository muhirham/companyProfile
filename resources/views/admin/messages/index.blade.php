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
                                    <th>Subjek</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $index => $msg)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $msg->name }}</td>
                                        <td>{{ $msg->email }}</td>
                                        <td>{{ $msg->subject }}</td>
                                        <td>{{ $msg->created_at ? $msg->created_at->format('d M Y H:i') : '-' }}</td>
                                        <td>
                                            @if($msg->is_read)
                                                <div class="badge badge-success">Dibaca</div>
                                            @else
                                                <div class="badge badge-secondary">Belum Dibaca</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if($messages->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada pesan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
