@extends('layouts.userLayouts')
@section('content')
    <!-- ===== PAGE CONTENT ===== -->
    <div class="page-section">
        <div class="row g-4">

            <!-- CONTACT FORM -->
            <div class="col-md-7">
                <div class="contact-title">CONTACT US</div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="subject" placeholder="Subject" required>
                    <textarea name="message" placeholder="Message" required></textarea>
                    <button type="submit" class="btn-submit mt-2">Submit</button>
                </form>
            </div>

            <!-- MAP -->
            <div class="col-md-5">
                <div class="contact-title">FIND US</div>
                <div class="map-box">
                    <iframe src="https://www.google.com/maps?q=Cideng%20Barat%20No.81%20Jakarta&output=embed"
                        loading="lazy">
                    </iframe>
                </div>
                <div class="address">
                    <strong>PT. BACH MULTI GLOBAL</strong><br>
                    Wisma B1<br>
                    Cideng Barat No.81<br>
                    Jakarta Pusat 10150
                </div>
            </div>
        </div>
    </div>
@endsection
