<?php $page = 'login'; ?>
@extends('layout.mainlayout')
@section('content')
<div class="container-fuild">
    <div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
        <div class="row">
            <div class="col-lg-6">
                <div class="login-background position-relative d-lg-flex align-items-center justify-content-center d-lg-block d-none flex-wrap vh-100 overflowy-auto">
                    <div>
                        <img src="{{URL::asset('build/img/authentication/authentication-02.jpg')}}" alt="Img">
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                    <div class="col-md-8 mx-auto p-4">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div>
                                <div class=" mx-auto mb-5 text-center">
                                    <img src="{{URL::asset('build/img/authentication/authentication-logo.svg')}}"
                                        class="img-fluid" alt="Logo">
                                </div>
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class=" mb-4">
                                            <h2 class="mb-2">Welcome</h2>
                                            <p class="mb-0">Please enter your details to sign in</p>
                                        </div>

                                        <div class="mb-3 ">
                                            <label class="form-label">Email Address</label>
                                            <div class="input-icon mb-3 position-relative">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-mail"></i>
                                                </span>
                                                <input type="text" id="Email" name="email" value="admin@example.com" class="form-control">
                                                <div class="text-danger pt-2">
                                                    @error('0')
                                                        {{$message}}
                                                    @enderror
                                                    @error('email')
                                                        {{$message}}
                                                    @enderror
                                                </div>
                                            </div>
                                            <label class="form-label">Password</label>
                                            <div class="pass-group">
                                                <input type="password"  id="password" name="password" value="123456" class="pass-input form-control">
                                                <span class="ti toggle-password ti-eye-off"></span>
                                                <div class="text-danger pt-2">
                                                    @error('0')
                                                        {{$message}}
                                                    @enderror
                                                    @error('password')
                                                        {{$message}}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-wrap form-wrap-checkbox mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check form-check-md mb-0">
                                                    <input class="form-check-input mt-0" type="checkbox">
                                                </div>
                                                <p class="ms-1 mb-0 ">Remember Me</p>
                                            </div>
                                            <div class="text-end ">
                                                <a href="{{url('forgot-password')}}" class="link-danger">Forgot
                                                    Password?</a>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                        </div>
                                        <div class="text-center">
                                            <h6 class="fw-normal text-dark mb-0">Don’t have an account? <a
                                                    href="{{url('register')}}" class="hover-a "> Create Account</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <p class="mb-0 ">Copyright &copy; 2024 - Coyo Kid</p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
