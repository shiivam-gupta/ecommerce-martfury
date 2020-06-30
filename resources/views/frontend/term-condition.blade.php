@extends('frontend.layouts.frontend')
@section('content')
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Term & Condition</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--single" id="">
        <div class="ps-about-intro">
            <div class="container">
                <div class="ps-section__header">
                    @if(isset($quickData))
                        <img align="center" width="100" height="100" src="{{ asset('frontend/img/quicklink/'.$quickData->image) }}" alt="">
                        <h4>{!! $quickData->title !!}</h4>
                        @if($quickData->subtitle)
                            <h3>{!! $quickData->subtitle !!}</h3>
                        @endif
                        <p>{!! $quickData->description !!}</p>
                    @else
                        <p>No data found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection