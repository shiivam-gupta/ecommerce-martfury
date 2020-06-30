@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home</a></li>
            <li>Reset Password</li>
        </ul>
    </div>
</div>
<div class="ps-page--shop">
    <div class="ps-container">
        <div class="ps-shop-banner">
        </div>
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                @include('frontend.includes.sidemenu')
            </div>
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Success!</strong> {{ $message }}
                    </div>
                    @endif
                    <div class="ps-block--vendor-dashboard">
                        <div class="ps-block__header">
                            <h3>Reset Password</h3>
                        </div>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <div class="ps-section__content">
                                        <form class="ps-form--checkout" action="{{route('my-resetpass-update')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  ">
                                                    <div class="ps-form__billing-info">
                                                        <div class="row">
                                                            <div class="offset-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $usersDetails->email ? $usersDetails->email : '' }}" readonly="">
                                                                    @if ($errors->has('email'))
                                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="offset-3 col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <input class="form-control" name="password" type="password" placeholder="Enter Password">
                                                                        @if ($errors->has('password'))
                                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="offset-3 col-md-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="password_confirmation" type="password" placeholder="Enter Confirmation Password">
                                                                    @if ($errors->has('password_confirmation'))
                                                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>                                       
                                                        <div class="offset-4 col-4">
                                                            <button class="ps-btn ps-btn--fullwidth" type="submit">Reset Password</button>
                                                        </div>
                                                    </div>
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
    @section('extra-js')

    @endsection