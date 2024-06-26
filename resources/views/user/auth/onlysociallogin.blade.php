@extends('layouts.custommaster')
    @section('content')
    <div class="pb-3 px-5 pt-0 text-center">
    <!-- <h3 class="mb-2">{{lang('Login', 'menu')}}</h3> -->
    <h3 class="mt-2 mb-2">{{lang('Sign Up or Log In')}}</h3>
    </div>
    @if(setting('login_disable') == 'on')
        <div class="card-body border-top-0 py-3 pb-0">
            <div class="alert alert-light-warning br-13 border-0 text-center" role="alert">
                <span class="">{{setting('login_disable_statement')}}</span>
            </div>
        </div>
    @else

        @if($socialAuthSettings->envato_status == 'enable' || $socialAuthSettings->google_status == 'enable'||$socialAuthSettings->facebook_status == 'enable' || $socialAuthSettings->twitter_status == 'enable')
        <div class="login-icons card-body p-4 text-center justify-content-center">
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
        @endif
    @endif
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

    </script>
    @endsection
