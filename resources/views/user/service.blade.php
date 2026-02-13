@extends('layouts.userLayouts')

@section('content')
    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Service</h2>

        <div class="row">

            @foreach ($services as $service)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">

                        <img src="{{ $service->image_url }}" class="card-img-top" style="height:250px; object-fit:cover;">


                        <div class="card-body text-center">
                            <h5 class="card-title">
                                {{ $service->name }}
                            </h5>

                            <p class="text-muted small">
                                {{ $service->short_description }}
                            </p>

                            <a href="{{ route('service.detail', $service->slug) }}" class="btn btn-dark w-100 mt-3">
                                View Detail
                            </a>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
