@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>CUSTOMER'S LOGIN</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="title">Login</h3>
                    <div class="theme-card">
                        <form class="theme-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}" placeholder="Email" required="">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="review">Password</label>
                                <input type="password"  class="form-control @error('password') is-invalid @enderror"
                                       name="password" placeholder="Enter your password"
                                       required="">
                            </div>
                            <button type="submit" class="btn btn-solid">Login</button></form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3 class="title">New Customer</h3>
                    <div class="theme-card authentication-right">
                        <h6 class="title-font">Create A Account</h6>
                        <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
                            able to order from our shop. To start shopping click register.</p><a href="/register"
                                                                                                 class="btn btn-solid">Create
                            an Account</a></div>
                </div>
            </div>
        </div>
    </section>
    {{--  <main class="py-4">

          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-md-8">
                      <div class="card">
                          <div class="card-header">{{ __('Login') }}</div>
                          <div class="card-body">
                              <form method="POST" action="{{ route('login') }}">
                                  @csrf
                                  <div class="form-group row">
                                      <label for="email"
                                             class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                      <div class="col-md-6">
                                          <input id="email" type="email"
                                                 class="form-control @error('email') is-invalid @enderror" name="email"
                                                 value="{{ old('email') }}" required autocomplete="email" autofocus>

                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="password"
                                             class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                      <div class="col-md-6">
                                          <input id="password" type="password"
                                                 class="form-control @error('password') is-invalid @enderror"
                                                 name="password" required autocomplete="current-password">

                                          @error('password')
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <div class="col-md-6 offset-md-4">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="remember"
                                                     id="remember" {{ old('remember') ? 'checked' : '' }}>

                                              <label class="form-check-label" for="remember">
                                                  {{ __('Remember Me') }}
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row mb-0">
                                      <div class="col-md-8 offset-md-4">
                                          <button type="submit" class="btn btn-primary">
                                              {{ __('Login') }}
                                          </button>
                                          @if (Route::has('password.request'))
                                              <a class="btn btn-link" href="{{ route('password.request') }}">
                                                  {{ __('Forgot Your Password?') }}
                                              </a>
                                          @endif
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </main>--}}
@endsection

