@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>Homepage</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Homepage</a></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pengaturan Homepage</h4>
                </div>
                <div class="card-body">
                    @if($homepage)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px;">Hero Title</th>
                                        <td>{{ $homepage->hero_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hero Subtitle</th>
                                        <td>{{ $homepage->hero_subtitle }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button Text</th>
                                        <td>{{ $homepage->hero_button_text }}</td>
                                    </tr>
                                    <tr>
                                        <th>Button URL</th>
                                        <td>{{ $homepage->hero_button_url }}</td>
                                    </tr>
                                    <tr>
                                        <th>Highlight Title</th>
                                        <td>{{ $homepage->highlight_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Highlight Body</th>
                                        <td>{{ $homepage->highlight_body }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Belum ada data homepage. Silakan tambahkan melalui fitur edit nanti.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
