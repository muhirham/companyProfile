@extends('layouts.admin')

@section('content')
<div class="section-header">
    <h1>Website Settings</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Update Admin Account</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.settings.user_admin.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Email Admin</label>
                    <input type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password Lama</label>
                    <div class="input-group">
                        <input type="password"
                            name="current_password"
                            id="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            required>

                        <div class="input-group-append">
                            <button type="button"
                                    class="btn btn-outline-secondary toggle-password"
                                    data-target="current_password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <div class="input-group">
                        <input type="password"
                            name="new_password"
                            id="new_password"
                            class="form-control @error('new_password') is-invalid @enderror">

                        <div class="input-group-append">
                            <button type="button"
                                    class="btn btn-outline-secondary toggle-password"
                                    data-target="new_password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <input type="password"
                            name="new_password_confirmation"
                            id="new_password_confirmation"
                            class="form-control">

                        <div class="input-group-append">
                            <button type="button"
                                    class="btn btn-outline-secondary toggle-password"
                                    data-target="new_password_confirmation">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary">
                    Update Account
                </button>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$('.toggle-password').click(function () {

    let target = $(this).data('target');
    let input = $('#' + target);
    let icon = $(this).find('i');

    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        input.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }

});
</script>
@endpush