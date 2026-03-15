@extends('layouts.userLayouts')

@section('content')

<style>
    .login-section {
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 15px;
        background: #f8f9fa;
    }

    .login-card {
        width: 100%;
        max-width: 430px;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
        overflow: hidden;
        border: none;
    }

    .login-header {
        text-align: center;
        padding: 30px 25px 20px;
        background: #ffffff;
        border-bottom: 1px solid #f1f1f1;
    }

    .login-header h3 {
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 6px;
    }

    .login-header p {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 0;
    }

    .login-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }

    .form-control {
        height: 48px;
        border-radius: 10px;
        border: 1px solid #dcdcdc;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #6c757d;
    }

    .input-group-text {
        background: #fff;
        border-radius: 10px 0 0 10px;
        border-right: none;
    }

    .btn-login {
        height: 48px;
        border-radius: 10px;
        font-weight: 600;
        background: #343a40;
        border: none;
    }

    .btn-login:hover {
        background: #212529;
    }

    .alert-danger {
        border-radius: 10px;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .login-body {
            padding: 24px;
        }

        .login-header {
            padding: 25px 20px 18px;
        }
    }
</style>

<div class="login-section">

    <div class="login-card">

        <div class="login-header">
            <h3>Admin Login</h3>
            <p>Masuk untuk mengakses dashboard admin</p>
        </div>

        <div class="login-body">

            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 btn-login">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

@endsection