@extends('backend.layouts.master')
@section('extra-css')
{!! Html::style('assets/js/bootstrap-fileupload/bootstrap-fileupload.css') !!}
@endsection
@section('content')
{{ Form::open(array('route' => 'save-appsetting', 'class'=> 'card','enctype'=>'multipart/form-data', 'files'=>true)) }}
@csrf
{!! Form::hidden('old_app_logo',$appsetting->app_logo, array('id'=>'old_app_logo','class'=> 'form-control')) !!}
{!! Form::hidden('old_app_logo_footer',$appsetting->app_logo_footer, array('id'=>'old_app_logo_footer','class'=> 'form-control')) !!}
{!! Form::hidden('old_app_favicon',$appsetting->app_favicon, array('id'=>'old_app_favicon','class'=> 'form-control')) !!}
<input type="hidden" name="old_app_logo" value="{{ $appsetting->app_logo }}">
<div class="row row-deck">
   <div class="col-lg-4">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">App Setting</h3>
         </div>
         <div class="card-body">
            <div class="form-group">
               <label for="app_name" class="form-label">App Name</label>
               {!! Form::text('app_name',$appsetting->app_name,array('id'=>'app_name','class'=> $errors->has('app_name') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'App Name', 'autocomplete'=>'off','required'=>'required')) !!}
               @if ($errors->has('app_name'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('app_name') }}</strong>
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="email" class="form-label">Email</label>
               {!! Form::text('email',$appsetting->email,array('id'=>'email','class'=> $errors->has('email') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Email', 'autocomplete'=>'off','required'=>'required')) !!}
               @if ($errors->has('email'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('email') }}</strong>
               </span>
               @endif
            </div>
            

            <div class="form-group">
               <label for="app_logo" class="form-label">App Logo</label>
               <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                     <img id="appLogo" src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo) }}"> 
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
               </div>
               <div>
                  <span class="btn btn-outline-primary btn-file">
                  <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Image</span>
                  {!! Form::file('app_logo',array('id'=>'app_logo','data-icon'=>'false', 'accept'=>'image/*',  'onchange'=> 'readURLImage(this, "appLogo")')) !!}
                  </span> 
               </div>
               @if ($errors->has('app_logo'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('app_logo') }}</strong>
               </span>
               @endif
            </div>

            <div class="form-group">
               <label for="logo_footer" class="form-label">App Footer Logo</label>
               <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                     <img id="appLogoFooter" src="{{ asset('frontend/img/aboutus/'. $appsetting->app_logo_footer) }}"> 
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
               </div>
               <div>
                  <span class="btn btn-outline-primary btn-file">
                  <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Image</span>
                  {!! Form::file('logo_footer',array('id'=>'logo_footer','data-icon'=>'false', 'accept'=>'image/*',  'onchange'=> 'readURLImage(this, "appLogoFooter")')) !!}
                  </span> 
               </div>
               @if ($errors->has('logo_footer'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('logo_footer') }}</strong>
               </span>
               @endif
            </div>

            <div class="form-group">
               <label for="favicon" class="form-label">App Favicon</label>
               <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                     <img id="appFavicon" src="{{ asset('frontend/img/aboutus/'. $appsetting->app_favicon) }}"> 
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
               </div>
               <div>
                  <span class="btn btn-outline-primary btn-file">
                  <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Image</span>
                  {!! Form::file('favicon',array('id'=>'favicon','data-icon'=>'false', 'accept'=>'image/*',  'onchange'=> 'readURLImage(this, "appFavicon")')) !!}
                  </span> 
               </div>
               @if ($errors->has('favicon'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('favicon') }}</strong>
               </span>
               @endif
            </div>

            <div class="form-group">
               <label for="copyright" class="form-label">Copy Rights</label>
               {!! Form::textarea('copyright',$appsetting->copyright,array('id'=>'copyright','class'=> $errors->has('copyright') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Copy Rights',    'autocomplete'=>'off','required'=>'required', 'rows'=>'4')) !!}
               @if ($errors->has('copyright'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('copyright') }}</strong>
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="safe_payment" class="form-label">Safe Payment</label>
               {!! Form::textarea('safe_payment',$appsetting->safe_payment,array('id'=>'safe_payment','class'=> $errors->has('safe_payment') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Safe payments', 'autocomplete'=>'off', 'rows'=>'4')) !!}
               @if ($errors->has('safe_payment'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('safe_payment') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-8">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">SEO / Google Analytics</h3>
            <div class="card-options">
               <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
            </div>
         </div>
         <div class="card-body">
            <div class="form-group">
               <label for="seo_keyword" class="form-label">SEO Keywords</label>
               {!! Form::textarea('seo_keyword',$appsetting->seo_keyword,array('id'=>'seo_keyword','class'=> $errors->has('seo_keyword') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'SEO Keywords', 'autocomplete'=>'off','required'=>'required', 'rows'=>'4')) !!}
               @if ($errors->has('seo_keyword'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('seo_keyword') }}</strong>
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="seo_description" class="form-label">SEO Description</label>
               {!! Form::textarea('seo_description',$appsetting->seo_description,array('id'=>'seo_description','class'=> $errors->has('seo_description') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'SEO Description', 'autocomplete'=>'off','required'=>'required', 'rows'=>'4')) !!}
               @if ($errors->has('seo_description'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('seo_description') }}</strong>
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="google_analytics" class="form-label">
                  Google Analytics 
                  <pre>Without script tag</pre>
               </label>
               {!! Form::textarea('google_analytics',$appsetting->google_analytics,array('id'=>'google_analytics','class'=> $errors->has('google_analytics') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Google Analytics', 'autocomplete'=>'off', 'rows'=>'4')) !!}
               @if ($errors->has('google_analytics'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('google_analytics') }}</strong>
               </span>
               @endif
            </div>

            <strong class="text-primary">Contact info</strong>
            <br>
            <div class="form-group">
               <label for="contact_title" class="form-label">Title</label>
               {!! Form::text('contact_title',$appsetting->contact_title,array('id'=>'contact_title','class'=> $errors->has('contact_title') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Contact us title', 'autocomplete'=>'off','required'=>'required')) !!}
               @if ($errors->has('contact_title'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('contact_title') }}</strong>
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="contact_address" class="form-label">Address</label>
               {!! Form::textarea('contact_address',$appsetting->contact_address,array('id'=>'contact_address','class'=> $errors->has('contact_address') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'placeholder'=>'Address', 'autocomplete'=>'off','required'=>'required', 'rows'=>'4')) !!}
               @if ($errors->has('contact_address'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('contact_address') }}</strong>
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="contact_phone" class="form-label">Mobile Number</label>
               {!! Form::number('contact_phone',$appsetting->contact_phone,array('id'=>'contact_phone','class'=> $errors->has('contact_phone') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Mobile / Contact Number', 'autocomplete'=>'off','required'=>'required')) !!}
               @if ($errors->has('contact_phone'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('contact_phone') }}</strong>
               </span>
               @endif
            </div>

            <strong class="text-primary">Social Media Page Link</strong>
            <br>
            <div class="form-group">
               <label for="facebook" class="form-label">Facebook Link</label>
               {!! Form::text('facebook',$appsetting->facebook,array('id'=>'facebook','class'=> $errors->has('facebook') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Facebook Link', 'autocomplete'=>'off')) !!}
            </div>

            <div class="form-group">
               <label for="twitter" class="form-label">Twitter Link</label>
               {!! Form::text('twitter',$appsetting->twitter,array('id'=>'twitter','class'=> $errors->has('twitter') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Twitter Link', 'autocomplete'=>'off')) !!}
            </div>

            <div class="form-group">
               <label for="google_plus" class="form-label">Google plus Link</label>
               {!! Form::text('google_plus',$appsetting->google_plus,array('id'=>'google_plus','class'=> $errors->has('google_plus') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Google plus Link', 'autocomplete'=>'off')) !!}
            </div>

            <div class="form-group">
               <label for="instagram" class="form-label">Instagram Link</label>
               {!! Form::text('instagram',$appsetting->instagram,array('id'=>'instagram','class'=> $errors->has('instagram') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Instagram Link', 'autocomplete'=>'off')) !!}
            </div>

            <strong class="text-primary">Newsletter</strong>
            <br>
            <div class="form-group">
               <label for="newsletter_title" class="form-label">Newsletter Title</label>
               {!! Form::text('newsletter_title',$appsetting->newsletter_title,array('id'=>'newsletter_title','class'=> $errors->has('newsletter_title') ? 'form-control is-invalid state-invalid' : 'form-control', 'placeholder'=>'Newsletter title', 'autocomplete'=>'off','required'=>'required')) !!}
               @if ($errors->has('newsletter_title'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('newsletter_title') }}</strong>
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="newsletter_description" class="form-label">Newsletter Description</label>
               {!! Form::textarea('newsletter_description',$appsetting->newsletter_description,array('id'=>'newsletter_description','class'=> $errors->has('newsletter_description') ? 'form-control is-invalid state-invalid ckeditor' : 'form-control ckeditor', 'placeholder'=>'Newsletter Description', 'autocomplete'=>'off','required'=>'required', 'rows'=>'4')) !!}
               @if ($errors->has('newsletter_description'))
               <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('newsletter_description') }}</strong>
               </span>
               @endif
            </div>

            <div class="form-footer text-right">
               {!! Form::submit('Update App Setting', array('class'=>'btn btn-primary')) !!}
            </div>
         </div>
      </div>
   </div>
</div>
{{ Form::close() }}
@endsection