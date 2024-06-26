@extends('layouts.custommaster')

@section('content')

<div class="pb-3 px-5 pt-0 text-center">
    <h3 class="mb-2">{{lang('Login', 'menu')}}</h3>
    <p class="text-muted fs-13 mb-1">{{lang('Sign In to your account')}}</p>
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

    @if(setting('login_disable') == 'on')
    <div class="alert alert-light-warning br-13 border-0 text-center" role="alert">

        <span class="">{{setting('login_disable_statement')}}</span>

    </div>
    @endif
    <form  id="login_form" name="login_form" method="post">
        @csrf
        @honeypot

        <div class="form-group">
            <label class="form-label">{{lang('Email')}} <span class="text-red">*</span></label>
            <input class="form-control " placeholder="{{lang('Email')}}"
                type="email" name="email" required="" id="username">
                <div id="err" style="color: red"></div>
        </div>
        <div class="form-group">
            <label class="form-label">{{lang('Password')}} <span class="text-red">*</span></label>
            <input class="form-control"
                placeholder="{{lang('password')}}" type="password" id="password" name="password" required="">
                <div id="passworderr" style="color: red"></div>
        </div>
        <div class="form-group">
            <label class="custom-control form-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{
                    old('remember') ? 'checked' : '' }}>
                <span class="custom-control-label">{{lang('Remember Me')}}</span>
            </label>
        </div>
        @if(setting('CAPTCHATYPE')=='manual')
            @if(setting('RECAPTCH_ENABLE_LOGIN')=='yes')
            <div class="form-group row">
                <div class="col-md-12 mb-3">
                    <input type="text" id="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="{{lang('Enter Captcha')}}" name="captcha">
                    <div id="captchaerr" style="color: red"></div>
                </div>
                <div class="col-md-12">
                    <div class="captcha d-flex border">
                        <span class="mx-auto mt-2">{!! captcha_img('') !!}</span>
                        <button type="button" class="btn btn-secondary btn-icon captchabtn"><i class="fe fe-refresh-cw"></i></button>
                    </div>
                </div>
            </div>
            @endif
        @endif

        <div class="form-group">
        @if(setting('CAPTCHATYPE')=='google')
            @if(setting('RECAPTCH_ENABLE_LOGIN')=='yes')

            <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-callback="recaptchaCallback" data-sitekey="{{setting('GOOGLE_RECAPTCHA_KEY')}}"></div>
            <span class="text-red" id="captchaError"></span>
            @endif
        @endif

    </div>
    <!--- End Google ReCaptcha --->

        <div class="submit">
            <input class="btn btn-secondary btn-block" type="submit" value="Login" onclick="login();this.form.submit();this.disabled=true;">
        </div>
        <div class="text-center mt-3">
            <a href="{{url('customer/forgotpassword')}}" class="text-primary pb-2">{{lang('Forgot Password?')}}</a>
            @if(setting('REGISTER_DISABLE') == 'on')

            <p class="text-dark mb-0">{{lang('Don’t have account?')}}<a class="text-primary ms-1"
                    href="{{route('auth.register')}}">{{lang('Register', 'menu')}}</a></p>
            @endif

            <p class="text-dark mb-0"><a class="text-primary ms-1" href="{{url('/')}}">{{lang('Back to home')}}</a></p>
        </div>
    </form>

</div>

@endsection
@section('scripts')

<!-- Captcha js-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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

    })(jQuery);


    // Login Js submit Js
    function login()
    {
        if($('#username').val() == "")
        {
            $('#err').html('{{lang('Please enter the username')}}');
            // return false;
        }
        if($('#password').val() == "")
        {
            $('#passworderr').html('{{lang('Please enter the password.')}}');
            // return false;
        }

        var data = $("#login_form").serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type : 'POST',
                url: '{{route('client.do_ajaxlogin')}}',
                data : data,
            success : function(response)
            {
                if(response?.errors){
                    $("#err").hide().html(response.errors?.email).fadeIn('slow');
                    $("#captchaerr").hide().html(response.errors?.captcha).fadeIn('slow');
                    if(response.errors?.["g-recaptcha-response"]?.[0]){
                        $("#captchaError").html(response.errors["g-recaptcha-response"][0]);
                    }
                }
                if(response == 1)
                {
                    window.location.replace('{{route('client.dashboard')}}');
                }
                else if(response == 3)
                {
                    toastr.error('{{lang('The username or password you entered is incorrect. Please Check', 'alerts')}}');
                    $("#err").hide().html("{{lang('The username or password you entered is incorrect. Please Check', 'alerts')}}").fadeIn('slow');
                }
                else if(response?.['error'] == 4)
                {
                    toastr.info('{{lang('Your Email is not verified yet. An email verification link was sent successfully. Please check and verify your email.', 'alerts')}}');
                    window.location.href = `emailverificationstore/${response.email}`;
                }
                else if(response == 5)
                {
                    toastr.error('{{lang('Your account is currently inactive. Please contact the admin.', 'alerts')}}');
                    // $("#err").hide().html("Your Account Is Currently Disabled").fadeIn('slow');
                }
                else if(response == 30)
                {
                    toastr.warning('{{lang('Temporary Login disable', 'alerts')}}');
                }
            }
        });
    }
</script>
@endsection
