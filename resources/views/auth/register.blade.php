@extends('layouts.app')
@section("title") Create Account @endsection
@section('head')
    <style>
        .inner {
            width: 400px;
            margin: 0px auto;
            margin-top: 40px;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <section class="main container ">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-5">

                <div class="my-5">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="{{asset(\App\Base::$logo)}}" style="width: 80px" alt="">
                    </div>
                    <div class="border bg-white rounded-lg shadow-sm">
                        <div class="p-4">
                            <h2 class="text-center font-weight-normal">Create Account</h2>
                            <p class="text-center text-black-50 mb-4">
                                Already have an account?
                                <a href="{{ route('login') }}">Sign in here</a>
                            </p>
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="form-group mb-5">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="accept-terms" name="accept-terms" required>
                                        <label class="custom-control-label text-muted" for="accept-terms">
                                            I accept the Terms and Conditions
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop
