@extends('backend.layouts.master')

@section('content')
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="text-center mb-6">
                            <img src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo) }}" class="" alt="{{$appsetting->app_name}}" style="width: 375px;">
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card-group mb-0">
                                    <div class="card p-4">
                                        <div class="card-body">
                                            <h1>Login</h1>
                                            @if(Session::has('success'))
                                                <div class="alert alert-success">
                                                    {{ Session::get('success') }}
                                                    @php
                                                    Session::forget('success');
                                                    @endphp
                                                </div>
                                            @endif
                                            @if ($message = Session::get('error'))
                                                <div class="alert alert-danger alert-block">
                                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @endif
                                            <p class="text-muted">Sign In to your account</p>
                                            <form action="{{ route('admin.login.post') }}" method="POST">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                                                </div>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-gradient-primary btn-block">Login</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <a href="forgot-password.html" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <div class="card text-white bg-primary py-5 d-md-down-none login-transparent">
                                        <div class="card-body text-center justify-content-center ">
                                            <h2>Sign up</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.ed ut perspiciatis unde omnis iste natus error sit voluptatem  </p>
                                            <a href="#" class="btn btn-gradient-success active mt-3">Register Now!</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
