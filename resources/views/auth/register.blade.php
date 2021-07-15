@extends('layouts.master')
@section("title","Create Account")
@section('content')
    <section class="register-section" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="breadcrumb-area">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="/">Home</a></li>
                                <li>Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-register-area mtb-60px"  id="app">
            <vue-progress-bar></vue-progress-bar>
            <div class="mx-5">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a data-toggle="tab" href="#lg2" class="active">
                                    <h4>Register</h4>
                                </a>
                            </div>
                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-md-6">
{{--                                                    @error('name')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                         </span>--}}
{{--                                                    @enderror--}}
                                                    @if(session("message"))
                                                        <div class="alert alert-danger">{{ session("message") }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <input id="email" type="email" placeholder="Email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required
                                                   autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input placeholder="Phone Number"
                                                   class="form-control  @error('phone') is-invalid @enderror"
                                                   type="text" name="phone"
                                                   value="{{ old('phone') }}"
                                                   required autocomplete="phone" autofocus>
                                            <span class="data-placeholder" data-placeholder="phone"></span>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <input placeholder="Address"
                                                   class="form-control  @error('address') is-invalid @enderror"
                                                   type="text" name="address"
                                                   value="{{ old('address') }}"
                                                   required autocomplete="address" autofocus>
                                            <span class="data-placeholder" data-placeholder="address"></span>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div :class="{'col-md-3':type=='seller','col-md-6': type!='seller'}" class="d-none">
                                                <div class="form-group">
                                                    <label for="type">What do you want?</label>
                                                    <select name="type" id="type" v-model="type" class="form-control">
                                                        <option value="customer" selected>I want to buy</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input id="password" type="password" placeholder="Password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                 </span>
                                            @enderror
                                            <input id="password-confirm" placeholder="Confirm-Password" type="password"
                                                   class="form-control" name="password_confirmation" required
                                                   autocomplete="new-password">
                                            <div class="login-toggle-btn mb-2 text-right">
                                                <a class="btn btn-link pl-0" href="/login">Already Have Account Please
                                                    Login</a>
                                            </div>
                                            <div class="button-box">
                                                <button type="submit"><span>Register</span></button>
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
    </section>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/new_app.js"></script>
@endpush
