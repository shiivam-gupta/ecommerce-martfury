@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index-2.html">Home</a></li>
            <li>Contact Us</li>
        </ul>
    </div>
</div>
<div class="ps-contact-form">
    <div class="container">
        <form class="ps-form--contact-us" action="{{route('contact-us.save')}}" method="post">
            @csrf
            <h3>Get In Touch</h3>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Success!</strong> {{ $message }}
                </div>
            @endif
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                    <div class="form-group">
                        <input class="form-control" name="fullname" value="{{ old('fullname') }}" type="text" placeholder="Name *">
                        @if ($errors->has('fullname'))
                            <span class="text-danger">{{ $errors->first('fullname') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                    <div class="form-group">
                        <input class="form-control" name="email" value="{{ old('email') }}" type="text" placeholder="Email *">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                    <div class="form-group">
                        <input class="form-control" name="mobile" value="{{ old('mobile') }}" type="text" placeholder="Mobile *">
                        @if ($errors->has('mobile'))
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                    <div class="form-group">
                        <input class="form-control" name="address" value="{{ old('address') }}" type="text" placeholder="Address *">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message">{{ old('message') }}</textarea>
                        @if ($errors->has('message'))
                            <span class="text-danger">{{ $errors->first('message') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group submit">
                <button class="ps-btn">Send message</button>
            </div>
        </form>
    </div>
</div>
@endsection