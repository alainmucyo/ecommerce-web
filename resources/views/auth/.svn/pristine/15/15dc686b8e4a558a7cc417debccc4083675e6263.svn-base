@extends('layouts.master')

@section('content')
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>register</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="register-page section-b-space" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="title pt-0">create account </h3>
                    <div class="theme-card">
                        <form class="theme-form" method="post" action="{{ route('register') }}">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}" id="name"
                                               placeholder="Full Name" required="">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" placeholder="Email Address"
                                           required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                               name="phone" value="{{ old('phone')?:'07' }}" id="phone"
                                               placeholder="Phone Number" required="">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div :class="{'col-md-3':type=='seller','col-md-6': type!='seller'}">
                                    <div class="form-group">
                                        <label for="type">What do you want?</label>
                                        <select name="type" id="type" v-model="type" class="form-control">
                                            <option value="customer">I want to buy</option>
                                            <option value="seller">I want to sell</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" v-if="type=='seller'">
                                    <div class="form-group">
                                        <label for="type">Shop name</label>
                                        <input type="text" name="shop_name" required class="form-control"  id="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <app-user-address></app-user-address>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" id="password" placeholder="Enter your password"
                                               required="">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <small class="text-danger">Minimum: 6 characters</small>
                                    </div>
                                </div>
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                               id="password_confirmation" placeholder="Confirm your password"
                                               required="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-solid">create Account</button>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="float-right">Already Have Account? <a href="/login"> Login In Here!</a>
                                    </h5>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
