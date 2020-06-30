@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}}">Home</a></li>
            <li>My Profile</li>
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
                            <h3>My Profile</h3>
                        </div>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <div class="ps-section__content">
                                        <form class="ps-form--checkout" action="{{route('my-profile-update')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="type" id="" value="register">
                                                <input type="hidden" id="getCountryId" value="{{ old('country_id') }}">
                                                <input type="hidden" id="getStateId" value="{{ old('state_id') }}">
                                                <input type="hidden" id="getCityId" value="{{ old('city_id') }}">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  ">
                                                    <div class="ps-form__billing-info">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Enter Name</label>
                                                                    <input type="text" name="fullname" class="form-control" placeholder="Name" value="{{ $usersDetails->fullname ? $usersDetails->fullname : '' }}">
                                                                    @if ($errors->has('fullname'))
                                                                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="email" class="form-control" name="r_email" placeholder="Email" value="{{ $usersDetails->email ? $usersDetails->email : '' }}" readonly="">
                                                                    @if ($errors->has('r_email'))
                                                                    <span class="text-danger">{{ $errors->first('r_email') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Phone Code</label>
                                                                    <select class="form-control select2-show-search" name="phone_code" data-placeholder="Choose one (with searchbox)">
                                                                        @foreach($country as $key => $value)
                                                                        <option value="{{ $value->phonecode }}" {{ $value->phonecode == $usersDetails->phone_code ? 'selected' : ''}} >+{{ $value->phonecode }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('phone_code'))
                                                                    <span class="text-danger">{{ $errors->first('phone_code') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Phone</label>
                                                                    <input type="text" class="form-control" name="phone_no" placeholder="Phone" value="{{ $usersDetails->phone_no ? $usersDetails->phone_no : '' }}">
                                                                    @if ($errors->has('phone_no'))
                                                                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">Country</label>
                                                                    <select id="country_id" class="form-control select2-show-search" onchange="getState(this)" name="country_id" data-placeholder="Choose one (with searchbox)">
                                                                        @foreach($country as $key => $value)
                                                                        <option value="{{ $value->id }}" {{ $value->id == $usersDetails->country_id ? 'selected' : ''}} >{{ $value->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('country_id'))
                                                                    <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">State</label>
                                                                    <select class="form-control select2-show-search state-box" onchange="getCity(this)" name="state_id" data-placeholder="Choose one (with searchbox)">

                                                                    </select>
                                                                    @if ($errors->has('state_id'))
                                                                    <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">City</label>
                                                                    <select class="form-control select2-show-search city-box" name="city_id" data-placeholder="Choose one (with searchbox)">

                                                                    </select>
                                                                    @if ($errors->has('city_id'))
                                                                    <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">Pincode</label>
                                                                    <input type="text" name="pincode" class="form-control" placeholder="Pincode" value="{{ $usersDetails->pincode ? $usersDetails->pincode : '' }}">
                                                                    @if ($errors->has('pincode'))
                                                                    <span class="text-danger">{{ $errors->first('pincode') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Address</label>
                                                                    <textarea class="form-control" name="address" >{{ $usersDetails->address ? $usersDetails->address : ''}}</textarea>
                                                                    @if ($errors->has('address'))
                                                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="offset-4 col-4">
                                                            <button class="ps-btn ps-btn--fullwidth" type="submit">Update Profile</button>
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

    <script type="text/javascript">
        $(document).ready(function() {
            getState('');
            getCity('');
        });

        function getState(e){
            var country_id = e ? e.value : $('#getCountryId').val();
            var state_id = $('#getStateId').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('getstate')}}",
                data: {'country_id': country_id, 'state_id': state_id},
                success: function(data){
                    $('.state-box').html(data.html);
                    if(e){
                        $('.city-box').html('');
                    }
                }
            });
        }
        
        function getCity(e){
            var state_id =  e ? e.value : $('#getStateId').val();
            var city_id = $('#getCityId').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('getcity')}}",
                data: {'state_id': state_id, 'city_id': city_id},
                success: function(data){
                   $('.city-box').html(data.html);
               }
           });
        }
    </script>
    @endsection