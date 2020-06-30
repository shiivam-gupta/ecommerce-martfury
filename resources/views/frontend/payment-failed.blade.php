@extends('frontend.layouts.frontend')
@section('content')
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Payment Failed</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--single">
        <div class="text-center">
            <div class="container">
                <div class="ps-section__header">
                    <img src="{{asset('assets/images/failed.png')}}" class="img-responsive">
                </div>

            </div>
        </div>
    </div>
@endsection