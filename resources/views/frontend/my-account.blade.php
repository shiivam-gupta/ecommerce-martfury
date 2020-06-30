@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('index')}}">Home</a></li>
                <li>My account</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <div class="ps-form--account ps-tab-root">
                <ul class="ps-tab-list">
                    <li class="{{ old('type') == 'register' ? '' : 'active' }}"><a href="#sign-in">Login</a></li>
                    <li class="{{ old('type') == 'register' ? 'active' : '' }}"><a href="#register">Register</a></li>
                </ul>
                <div class="ps-tabs">
                    @if ($message = Session::get('failure'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ $message }}
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif
                    <div class="ps-tab {{ old('type') == 'register' ? '' : 'active' }}" id="sign-in">
                        <div class="ps-form__content">
                            <form class="" action="{{ route('attempt-login') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <h5>Log In Your Account</h5>
                                <input type="hidden" name="type" id="" value="login">
                                <div class="form-group">
                                    <input class="form-control" name="email" value="{{ old('email') }}" type="text" placeholder="Enter email address">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group form-forgot">
                                    <input class="form-control" name="password" type="password" placeholder="Enter Password"><a href="{{ route('forgot-password') }}">Forgot?</a>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="ps-checkbox">
                                        <input class="form-control" type="checkbox" id="remember-me" name="remember">
                                        <label for="remember-me">Remember me</label>
                                    </div>
                                </div>
                                <div class="form-group submtit">
                                    <button class="ps-btn ps-btn--fullwidth">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="ps-form__footer">
                            <p>Connect with:</p>
                            <ul class="ps-list--social">
                                @include('frontend.includes.social')
                            </ul>
                        </div>
                    </div>
                    <div class="ps-tab {{ old('type') == 'register' ? 'active' : '' }}" id="register">
                        <div class="ps-form__content">
                            <form class="" action="{{ route('attempt-register') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <h5>Register An Account</h5>
                                
                                <div class="form-group">
                                    <label class="form-label">Enter Name</label>
                                    <input type="text" name="fullname" class="form-control" placeholder="Name" value="{{ old('fullname') ? old('fullname') : '' }}">
                                    @if ($errors->has('fullname'))
                                        <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                    @endif
                                </div>
                                <input type="hidden" name="type" id="" value="register">
                                <input type="hidden" id="getCountryId" value="{{ old('country_id') }}">
                                <input type="hidden" id="getStateId" value="{{ old('state_id') }}">
                                <input type="hidden" id="getCityId" value="{{ old('city_id') }}">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="r_email" placeholder="Email" value="{{ old('r_email') ? old('r_email') : '' }}" >
                                    @if ($errors->has('r_email'))
                                        <span class="text-danger">{{ $errors->first('r_email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="r_password" placeholder="Password" value="{{ old('r_password') ? old('r_password') : '' }}" >
                                    @if ($errors->has('r_password'))
                                        <span class="text-danger">{{ $errors->first('r_password') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Phone Code</label>
                                            <select class="form-control select2-show-search" name="phone_code" data-placeholder="Choose one (with searchbox)">
                                                @foreach($country as $key => $value)
                                                    <option value="{{ $value->phonecode }}" {{ $value->phonecode == old('phone_code') ? 'selected' : ''}} >+{{ $value->phonecode }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('phone_code'))
                                                <span class="text-danger">{{ $errors->first('phone_code') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone_no" placeholder="Phone" value="{{ old('phone_no') ? old('phone_no') : '' }}">
                                            @if ($errors->has('phone_no'))
                                                <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <select id="country_id" class="form-control select2-show-search" onchange="getState(this)" name="country_id" data-placeholder="Choose one (with searchbox)">
                                                @foreach($country as $key => $value)
                                                    <option value="{{ $value->id }}" {{ $value->id == old('country_id') ? 'selected' : ''}} >{{ $value->name }}</option>
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
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" name="pincode" class="form-control" placeholder="Pincode" value="{{ old('pincode') ? old('pincode') : '' }}">
                                    @if ($errors->has('pincode'))
                                        <span class="text-danger">{{ $errors->first('pincode') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="address" >{{ old('address') ? old('address') : ''}}</textarea>
                                    
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            
                                <div class="form-group submtit">
                                    <button class="ps-btn ps-btn--fullwidth">Register</button>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="ps-form__footer">
                            <p>Connect with:</p>
                            <ul class="ps-list--social">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('frontend/includes/news-letter')
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
            url: "{{route('admin.getstate')}}",
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
            url: "{{route('admin.getcity')}}",
            data: {'state_id': state_id, 'city_id': city_id},
            success: function(data){
                 $('.city-box').html(data.html);
            }
        });
    }
</script>
@endsection