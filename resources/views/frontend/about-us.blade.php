@extends('frontend.layouts.frontend')
@section('content')
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--single" id="about-us"><img src="{{ asset('frontend/img/aboutus/'.$aboutus->image) }}" alt="">
        <div class="ps-about-intro">
            <div class="container">
                <div class="ps-section__header">
                    <h4>{!! $aboutus->title !!}</h4>
                    @if($aboutus->subtitle)
                        <h3>{!! $aboutus->subtitle !!}</h3>
                    @endif
                    <p>{!! $aboutus->description !!}</p>
                </div>

            </div>
        </div>
    </div>
@endsection