@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>Produk Genset</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Produk Genset</a></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Produk</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-products">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px;">#</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Daya</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>{{ $product->power_capacity }}</td>
                                        <td>
                                            @if($product->is_active)
                                                <div class="badge badge-success">Aktif</div>
                                            @else
                                                <div class="badge badge-secondary">Nonaktif</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if($products->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data produk.</td>
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
