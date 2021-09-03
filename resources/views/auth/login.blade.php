@extends('layouts.master')
@section("title","Login")
@section('content')
    <div class="login-section">
        <div class="offcanvas-overlay"></div>
        <div class="breadcrumb-area">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="/">Home</a></li>
                                <li>Login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-register-area mtb-60px">
            <div class="mx-5">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4>login</h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <input id="email" placeholder="Email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="password-area d-flex"><input id="password" type="password"
                                                                                         placeholder="Password"
                                                                                         class="form-control @error('password') is-invalid @enderror"
                                                                                         name="password"
                                                                                         required
                                                                                         autocomplete="current-password">
                                                    <i class="cursor-pointer fa fa-eye-slash border-0 w-auto px-0 pt-2 mt-1 form-control"
                                                       id="togglePassword" style="margin-left: -30px"></i>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <a class="flote-none" href="javascript:void(0)">Remember me</a>
                                                        @if (Route::has('password.request'))
                                                            <div class="row mx-0 justify-content-lg-between">
                                                                <a class="btn btn-link pl-0" href="/register">Create
                                                                    Account</a>
                                                                <a class="btn btn-link"
                                                                   href="#">
                                                                    {{ __('Forgot Your Password?') }}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <button type="submit"><span>Login</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            console.log(type)
            password.setAttribute('type', type);
            if(type=="text"){
                togglePassword.classList.remove("fa-eye-slash")
                togglePassword.classList.add("fa-eye")
            }else{
                togglePassword.classList.remove("fa-eye")
                togglePassword.classList.add("fa-eye-slash")
            }
            // this.classList.toggle('fa-eye-slash');
        });
    </script>
@endpush
