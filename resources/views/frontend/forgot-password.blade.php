@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Forgot Password</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <div class="ps-form--account ps-tab-root">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#sign-in">Forgot Password</a></li>
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
                            <form class="" action="{{ route('password.email') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <h5>Forgot Password</h5>
                                <div class="form-group">
                                    <input class="form-control" name="email" value="{{ old('email') }}" type="text" placeholder="Enter email address">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group submtit">
                                    <button class="ps-btn ps-btn--fullwidth">{{ __('Send Password Reset Link') }}</button>
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
