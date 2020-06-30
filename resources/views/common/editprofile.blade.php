@extends('common.layouts.master')
@section('content')
<div class="app-content  my-3 my-md-5">
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Edit Profile</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>

        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <form action="{{url('update-profile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-deck">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Profile</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-2">
                                    <div class="">
                                        <img src="{{asset('Images/'.Auth::user()->profile_pic)}}" alt="Profile-img"
                                            class="rounded-circle brround" style="width: 150px;
                                        height: 150px;
                                        margin-left: 60px;">
                                    </div>
                                    <div class="col">
                                        <h3 class="mb-1 ">{{Auth::user()->name}}</h3>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control"
                                    rows="5">On the other hand, we denounce with righteous indignation</textarea>
                            </div> --}}
                                <div class="form-group">
                                    <label class="form-label">Email-Address</label>
                                    <input class="form-control" readonly placeholder="your-email@domain.com"
                                        value="{{Auth::user()->email}}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Update Profile</label>
                                    <input type="file" class="form-control" name="profile_pic" />
                                </div>
                                @if ($errors->has('profile_pic'))
                                <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                @endif
                                {{-- <div class="form-group">
                                <label class="form-label">Website</label>
                                <input class="form-control" placeholder="http://spain.com/" />
                            </div> --}}
                                {{-- <div class="form-footer">
                                <button class="btn btn-primary btn-block">Save</button>
                            </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{Auth::user()->name}}">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" readonly class="form-control"
                                            value="{{Auth::user()->phone_no}}" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email address</label>
                                        <input type="email" readonly class="form-control" placeholder="Email"
                                            value="{{Auth::user()->email}}">
                                    </div>
                                </div>
                                @if(Auth::user()->userType == 3)
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Credit Card Number</label>
                                        <input type="text" name="credit_card_number" class="form-control"
                                            value="{{Auth::user()->credit_card_number}}"
                                            placeholder="Enter Credit Card Number">
                                    </div>
                                    @if ($errors->has('credit_card_number'))
                                    <span class="text-danger">{{ $errors->first('credit_card_number') }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="text" name="expiry_date" id="datetimepicker10" class="form-control"
                                            value="{{Auth::user()->expiry_date}}" placeholder="Expiry Date">
                                    </div>
                                    @if ($errors->has('expiry_date'))
                                    <span class=" text-danger">{{ $errors->first('expiry_date') }}</span>
                                    @endif
                                </div>
                                @elseif(Auth::user()->userType == 2)
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Bank</label>
                                        <input type="text" name="bank" value="{{Auth::user()->bank}}"
                                            class="form-control" placeholder="Bank">
                                    </div>
                                    @if ($errors->has('bank'))
                                    <span class="text-danger">{{ $errors->first('bank') }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Account Number</label>
                                        <input type="number" name="account_no" value="{{Auth::user()->account_no}}"
                                            class="form-control" placeholder="ZIP Code">
                                    </div>
                                    @if ($errors->has('account_no'))
                                    <span class=" text-danger">{{ $errors->first('account_no') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Account Holder Name</label>
                                        <input type="text" name="account_holder_name"
                                            value="{{Auth::user()->account_holder_name}}" class="form-control"
                                            placeholder="
                                    Account Holder Name" />
                                    </div>
                                    @if ($errors->has('account_holder_name'))
                                    <span class=" text-danger">{{ $errors->first('account_holder_name') }}</span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                        {{-- Model  --}}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    {{-- <form action="{{url('/change-password')}}" method="POST">
                                    @csrf --}}
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                        <button type="button text-white" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-success passChanged alert-block d-none">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Your Password Changed Successfully.</strong>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" name="current_password"
                                                class="form-control currentPassword"
                                                placeholder="Enter Current Password" />
                                            <span class="text-danger currentPasswordError"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="new_password" class="form-control newPassword"
                                                placeholder="Enter New Password" />
                                            <span class="text-danger newPasswordError"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" name="confirm_new_password"
                                                class="form-control cnewPassword" placeholder="Confirm Password" />
                                            <span class="text-danger cnewPasswordError"></span>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary changePassword">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

        </form>

        <div class="ml-4">
            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success">Change
                Password</button>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
    </div>
</div>
</div>
</form>


</div>
</div>
<script>
    function passValidation(){
        var valid = true
        $('.cnewPasswordError').text('');
        $('.newPasswordError').text('')
        $('.currentPasswordError').text('')
        
        currentPass = $('.currentPassword').val();
        newPass = $('.newPassword').val();
        changePass = $('.cnewPassword').val();

        if(currentPass == ''){
        $('.currentPasswordError').text('Current Password feild is required.')
        valid = false
        }
        else if(newPass == ''){
        $('.newPasswordError').text('New Password Feild is required.')
        valid = false
        }
        else if(changePass ==''){
        $('.cnewPasswordError').text('Confirm Password feild is required.')
        valid = false
        }
        
        return valid
    }
    $(document).on('click' ,'.changePassword' , function(){
        
        if(passValidation() == true){
            $.ajax({
            url:"{{url('/change-password')}}",
            method:'POST',
            data:{
            currentPassword:$('.currentPassword').val(),
            newPassword:$('.newPassword').val(),
            cnewPassword:$('.cnewPassword').val(),
            "_token":"{{csrf_token()}}"
            },
            success:function(res){
            if(res.status == 'success'){
                $('.newPasswordError').text('')
            $('.cnewPasswordError').text('')
            $('.currentPasswordError').text('')
            $('.passChanged').removeClass('d-none')
            
            }
            else if(res.status == 'passNotMatch'){
            $('.currentPasswordError').text(res.msg)
            }
            else if(res.status == 'cpassNotMatch'){
            $('.cnewPasswordError').text(res.msg)
            }
            else if(res.status == 'passLength'){
                $('.newPasswordError').text(res.msg)
            }
            
            }
            })
        }         
    })

</script>
<script>
    $(function () {
        $('#datetimepicker10').datetimepicker({
        viewMode: 'years',
        format: 'MM/YY'
        });
        });
       
</script>


@endsection