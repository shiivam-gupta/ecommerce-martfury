@extends('frontend.layouts.frontend')
@section('content')
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Faqs</li>
            </ul>
        </div>
    </div>
    <div class="ps-faqs">
        <div class="container">
            <div class="ps-section__header">
                <h1>Frequently Asked Questions</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--faqs">
                        <tbody>
                            @if(isset($faqsData))
                            @foreach($faqsData as $value)
                            <tr>
                                <td class="heading"></td>
                                <td class="question">{!!$value->question!!}</td>
                                <td>{!!$value->answer!!}</td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>No data found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection