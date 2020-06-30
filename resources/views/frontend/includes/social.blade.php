@if(!empty($appsetting->facebook))
<li><a class="facebook" href="{{$appsetting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
@endif
@if(!empty($appsetting->twitter))
<li><a class="twitter" href="{{$appsetting->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
@endif
@if(!empty($appsetting->google_plus))
<li><a class="google-plus google" href="{{$appsetting->google_plus}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
@endif
@if(!empty($appsetting->instagram))
<li><a class="instagram" href="{{$appsetting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
@endif