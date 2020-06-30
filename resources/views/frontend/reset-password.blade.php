@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Reset Password</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <div class="ps-form--account ps-tab-root">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#sign-in">Reset Password</a></li>
                </ul>
                <div class="ps-tabs">
                    @if ($message = Session::get('failure'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ $message }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <form class="" action="{{ route('password.update') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <h5>Reset Password</h5>
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <input class="form-control" name="email" value="{{ $email ?? old('email') }}" type="text" placeholder="Enter email address" readonly>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            
                                <div class="form-group">
                                    <input class="form-control" name="password" type="text" placeholder="Enter Password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control" name="password_confirmation" type="text" placeholder="Enter email address">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <div class="form-group submtit">
                                    <button class="ps-btn ps-btn--fullwidth">{{ __('Reset Password') }}</button>
                                </div>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('frontend/includes/news-letter')
@endsection
