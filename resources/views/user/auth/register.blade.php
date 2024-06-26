@extends('layouts.customregistermaster')

@section('styles')
	<!-- Select2 css -->
	<link href="{{asset('assets/plugins/select2/select2.min.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />
@endsection

@section('content')

<div class="pb-0 px-5 pt-0 text-center">
    <h3 class="mb-2">{{lang('Register', 'menu')}}</h3>
    <p class="text-muted fs-13 mb-1">{{lang('Create new account')}}</p>
</div>
@if($socialAuthSettings->envato_status == 'enable' || $socialAuthSettings->google_status == 'enable'||$socialAuthSettings->facebook_status == 'enable' || $socialAuthSettings->twitter_status == 'enable')

    <div class="login-icons card-body pt-3 pb-0 text-center justify-content-center">
        @if($socialAuthSettings->envato_status == 'enable')
        <a class="btn header-buttons text-start social-icon-2 btn-lg btn-lime text-white mb-4 btn-block p-0" href="javascript:;" data-bs-toggle="tooltip" title="{{lang('Login with Envato')}}" onclick="window.location.href = envato;" data-bs-original-title="{{lang('Login with Envato')}}">
            <div class="d-inline w-15 justify-content-center">
                <svg class="px-4 py-2 my-auto border-end border-white-1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="_x38_5-envato"><g><g><g>
                    <path fill="#fff" d="M401.225,19.381c-17.059-8.406-103.613,1.196-166.01,61.218      c-98.304,98.418-95.947,228.089-95.947,228.089s-3.248,13.335-17.086-6.011c-30.305-38.727-14.438-127.817-12.651-140.23      c2.508-17.494-8.615-17.999-13.243-12.229c-109.514,152.46-10.616,277.288,54.136,316.912c75.817,46.386,225.358,46.354,284.922-85.231C509.547,218.042,422.609,29.875,401.225,19.381L401.225,19.381z M401.225,19.381"></path></g></g></g></g><g id="Layer_1"></g>
                </svg>
            </div>

            <span class="px-4 py-2 my-auto text-white">Login with Envato</span>
        </a>
        @endif
        @if($socialAuthSettings->google_status == 'enable')
        <a class="btn header-buttons text-start social-icon-2 btn-lg btn-google text-white mb-4 btn-block p-0" href="javascript:;" data-bs-toggle="tooltip"
            title="{{lang('Login with Google')}}" onclick="window.location.href = google;" data-bs-original-title="{{lang('Login with Google')}}">
            <div class="d-inline-flex w-7 border-end border-white-1 px-4 py-2 my-auto justify-content-center">
                <i class="fa fa-google"></i>
            </div>
            <span class="px-4 py-2 my-auto text-white">Login with Google</span>
        </a>
        @endif
        @if($socialAuthSettings->facebook_status == 'enable')
        <a class="btn header-buttons text-start social-icon-2 btn-lg btn-facebook text-white mb-4 btn-block p-0" href="javascript:;" data-bs-toggle="tooltip"
            title="{{lang('Login with Facebook')}}" onclick="window.location.href = facebook;" data-bs-original-title="{{lang('Login with Facebook')}}">
            <div class="d-inline-flex w-7 border-end border-white-1 px-4 py-2 my-auto justify-content-center">
                <i class="fa fa-facebook"></i>
            </div>
            <span class="px-4 py-2 my-auto text-white">Login with Facebook</span>
        </a>
        @endif
        @if($socialAuthSettings->twitter_status == 'enable')
        <a class="btn header-buttons text-start social-icon-2 btn-lg btn-twitter text-white btn-block p-0" href="javascript:;" data-bs-toggle="tooltip"
            title="{{lang('Login with Twitter')}}" onclick="window.location.href = twitter;" data-bs-original-title="{{lang('Login with Twitter')}}">
            <div class="d-inline-flex w-7 border-end border-white-1 px-4 py-2 my-auto justify-content-center">
                <i class="fa fa-twitter"></i>
            </div>
            <span class="px-4 py-2 my-auto text-white">Login with Twitter</span>
        </a>
        @endif
    </div>
    <div class="text-center mt-5 login-form">
        <div class="divider">
            Or
        </div>
    </div>

@endif

<div class="card-body border-top-0 pt-3 pb-0">
    @if(setting('REGISTER_DISABLE') == 'off')
    <div class="alert alert-light-warning br-13 border-0 text-center" role="alert">

        <span class="">{{setting('login_disable_statement')}}</span>

    </div>

    @endif
    <form method="post" id="register_form">

        @honeypot

        <div class="form-group row">
            <div class="col-sm-6 col-md-6 mb-2 mb-sm-0">
                <label class="form-label">{{lang('First Name')}} <span class="text-red">*</span></label>
                <input class="form-control @error('firstname') is-invalid @enderror" placeholder="{{lang('Firstname')}}" type="text"
                    name="firstname" value="{{old('firstname')}}" >
                    <span class="text-red" id="firstnameError"></span>
                @error('firstname')

                <span class="invalid-feedback" role="alert">
                    <strong>{{ lang($message) }}</strong>
                </span>
                @enderror

            </div>
            <div class="col-sm-6 col-md-6">
                <label class="form-label">{{lang('Last Name')}} <span class="text-red">*</span></label>
                <input class="form-control @error('lastname') is-invalid @enderror" placeholder="{{lang('Lastname')}}" type="text"
                    name="lastname" value="{{old('lastname')}}" >
                    <span class="text-red" id="lastnameError"></span>
                @error('lastname')

                <span class="invalid-feedback" role="alert">
                    <strong>{{ lang($message) }}</strong>
                </span>
                @enderror

            </div>

        </div>
        <div class="form-group">
            <label class="form-label">{{lang('Email')}} <span class="text-red">*</span></label>
            <input class="form-control @error('email') is-invalid @enderror" placeholder="{{lang('Email')}}" type="email" name="email"
                value="{{old('email')}}" autocomplete="username">
                <span class="text-red" id="emailError"></span>
            @error('email')

            <span class="invalid-feedback" role="alert">
                <strong>{{ lang($message) }}</strong>
            </span>
            @enderror

        </div>
        <div class="form-group row">
            <div class="col-sm-6 col-md-6">
            <label class="form-label">{{lang('Password')}} <span class="text-red">*</span></label>
            <input class="form-control @error('password') is-invalid @enderror" placeholder="{{lang('password')}}" type="password"
                name="password" autocomplete="new-password">
                <span class="text-red" id="passwordError"></span>
            @error('password')

            <span class="invalid-feedback" role="alert">
                <strong>{{ lang($message) }}</strong>
            </span>
            @enderror

            </div>
            <div class="col-sm-6 col-md-6">
                <label class="form-label">{{lang('Confirm Password')}} <span class="text-red">*</span></label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{lang('password')}}"
                    type="password" name="password_confirmation" autocomplete="new-password">
                    <span class="text-red" id="passwordconfirmError"></span>
                @error('password_confirmation')

                <span class="invalid-feedback" role="alert">
                    <strong>{{ lang($message) }}</strong>
                </span>
                @enderror
            </div>
        </div>
        @if($customfields->isNotEmpty())
            @foreach($customfields as $customfield)
            <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">{{$customfield->fieldnames}}
                            @if($customfield->fieldrequired == '1')

                            <span class="text-red">*</span>
                            @endif
                        </label>

                        @if($customfield->fieldtypes == 'text')

                            <input type="{{$customfield->fieldtypes}}" class="form-control" name="custom_{{$customfield->id}}" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                        @endif
                        @if($customfield->fieldtypes == 'email')

                            <input type="{{$customfield->fieldtypes}}" class="form-control" name="custom_{{$customfield->id}}" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                        @endif
                        @if($customfield->fieldtypes == 'textarea')

                            <textarea name="custom_{{$customfield->id}}" class="form-control" cols="30" rows="5" {{$customfield->fieldrequired == '1' ? 'required' : ''}}></textarea>
                        @endif
                        @if($customfield->fieldtypes == 'checkbox')

                            @php
                                $coptions = explode(',', $customfield->fieldoptions)
                            @endphp
                            @foreach($coptions as $key => $coption)
                            <label class="custom-control form-checkbox d-inline-block me-3">
                                <input type="{{$customfield->fieldtypes}}" class="custom-control-input {{$customfield->fieldrequired == '1' ? 'required' : ''}}"  name="custom_{{$customfield->id}}[]" value="{{$coption}}" >

                                <span class="custom-control-label">{{$coption}}</span>
                            </label>

                            @endforeach


                        @endif
                        @if($customfield->fieldtypes == 'select')
                            <select name="custom_{{$customfield->id}}" class="form-control select2 select2-show-search" data-placeholder="{{lang('Select')}}" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                                @php
                                    $seoptions = explode(',', $customfield->fieldoptions)
                                @endphp
                                <option></option>
                                @foreach($seoptions as $seoption)

                                <option value="{{$seoption}}">{{$seoption}}</option>
                                @endforeach
                            </select>
                        @endif
                        @if($customfield->fieldtypes == 'radio')
                        @php
                            $roptions = explode(',', $customfield->fieldoptions)
                        @endphp
                        @foreach($roptions as $roption)
                        <label class="custom-control form-radio d-inline-block me-3">
                            <input type="{{$customfield->fieldtypes}}" class="custom-control-input" name="custom_{{$customfield->id}}" value="{{$roption}}" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                            <span class="custom-control-label">{{$roption}}</span>
                        </label>


                        @endforeach

                        @endif

                    </div>
                </div>
            </div>
            @endforeach
        @endif
        <div class="form-group @error('agree_terms') is-invalid @enderror">
            <label class="custom-control form-checkbox">
                <input type="checkbox" class="custom-control-input " value="agreed" name="agree_terms">
                <span class="custom-control-label">{{lang('I agree with')}} <a href="{{setting('terms_url')}}" class="text-primary">
                        {{lang('Terms of services')}}</a></span>
            </label>
        </div>
        <span class="text-red" id="agreetermsError"></span>
        @error('agree_terms')

        <span class="invalid-feedback" role="alert">
            <strong>{{ lang($message) }}</strong>
        </span>
        @enderror


        @if(setting('CAPTCHATYPE')=='manual')
            @if(setting('RECAPTCH_ENABLE_REGISTER')=='yes')

            <div class="form-group row @error('captcha') is-invalid @enderror">
                <div class="col-md-3">
                    <input type="text" id="captcha" class="form-control " placeholder="{{lang('Enter Captcha')}}" name="captcha">

                </div>
                <div class="col-md-3">
                    <div class="captcha">
                        <span>{!! captcha_img('') !!}</span>
                        <button type="button" class="btn btn-outline-info btn-sm captchabtn"><i class="fe fe-refresh-cw"></i></button>
                    </div>
                </div>
            </div>
            @error('captcha')

                <span class="invalid-feedback" role="alert">
                    <strong>{{ lang($message) }}</strong>
                </span>
            @enderror
            @endif
        @endif

        <!--- if Enable the Google ReCaptcha --->
        <div class="form-group">
        @if(setting('CAPTCHATYPE')=='google')
        @if(setting('RECAPTCH_ENABLE_REGISTER')=='yes')

            <div class="g-recaptcha" data-sitekey="{{setting('GOOGLE_RECAPTCHA_KEY')}}"></div>

            <!-- @if ($errors->has('g-recaptcha-response'))

            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
            @endif -->
            <span class="text-danger" id="captchaError"></span>
            @endif
            @endif
        </div>

        <div class="submit">
            <input type="submit" class="btn btn-secondary btn-block" id="register_button" value="{{lang('Create Account')}}" />

        </div>

        <div class="text-center mt-4">
            <p class="text-dark mb-0">{{lang('Already have an account?')}}<a class="text-primary ms-1"
                    href="{{url('customer/login')}}">{{lang('Login', 'menu')}}</a></p>
            <p class="text-dark mb-0"><a class="text-primary ms-1" href="{{url('/')}}">{{lang('Send me Back')}}</a></p>

        </div>
    </form>
</div>

@endsection
@section('scripts')

<!-- Captcha js-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- Select2 js -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}?v=<?php echo time(); ?>"></script>


<link href="{{asset('assets/plugins/select2/select2.min.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

<script type="text/javascript">
    "use strict";

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Variables
    var facebook = "{{ route('social.login', 'facebook') }}";
    var google = "{{ route('social.login', 'google') }}";
    var twitter = "{{ route('social.login', 'twitter') }}";
    var envato = "{{ route('social.login', 'envato') }}";

    (function($){
        $(".captchabtn").on('click', function(e){
            e.preventDefault();
            $.ajax({
                type:'GET',
                url:'{{route('captcha.reload')}}',
                success: function(res){
                    $(".captcha span").html(res.captcha);
                }
            });
        });

        setTimeout(() => {
            $('.select2-show-search').select2({
                minimumResultsForSearch: '',
                placeholder: "Search",
                width: '100%'
            });
        },500)

        $('body').on('submit', '#register_form', function (e) {
            e.preventDefault();
            $('#firstnameError').html('');
            $('#lastnameError').html('');
            $('#emailError').html('');
            $('#passwordError').html('');
            $('#passwordconfirmError').html('');
            $('#agreetermsError').html('');
            $('#register_button').html(`Loading.. <i class="fa fa-spinner fa-spin"></i>`);
            $('#register_button').prop('disabled', true);


            var formData = new FormData(this);
            let checked  = document.querySelectorAll('.required:checked').length;
            var isValid = checked > 0;
            if(document.querySelectorAll('.required').length == '0'){
                ajax(formData);
            }else{

                if(isValid){
                    ajax(formData);
                }else{
                    $('#register_button').prop('disabled', false);
                    $('#register_button').html(`{{lang('Create Ticket', 'menu')}}`);
                    toastr.error('{{lang('Check the all field(*) required', 'alerts')}}')
                }
            }
        });


        function ajax(formData){

            $.ajax({
                type:'POST',
                dataType: "json",
                url: "{{route('auth.register')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,

                success: (data) => {

                    if(data.error)
                    {
                        toastr.error(data.error);
                    }
                    if(data.success){
                        toastr.success(data.success);
                        window.location.replace('{{url('customer/login')}}')
                    }


                },
                error: function(data){
                    if(data.responseJSON && data.responseJSON.errors){
                        if(data.responseJSON.errors["g-recaptcha-response"]){
                            $('#capchaError').html(data.responseJSON.errors["g-recaptcha-response"][0]);
                        }
                        $('#firstnameError').html(data.responseJSON.errors.firstname);
                        $('#lastnameError').html(data.responseJSON.errors.lastname);
                        $('#emailError').html(data.responseJSON.errors.email);
                        $('#passwordError').html(data.responseJSON.errors.password);
                        $('#passwordconfirmError').html(data.responseJSON.errors.password_confirmation);
                        $('#agreetermsError').html(data.responseJSON.errors.agree_terms);
                        $('#register_button').prop('disabled', false);
                        $('#register_button').html(`{{lang('Create Account', 'menu')}}`);
                    }
                    console.log(data);
                    console.log(data.responseJSON);
                }
            });
        }

    })(jQuery);
</script>
@endsection
