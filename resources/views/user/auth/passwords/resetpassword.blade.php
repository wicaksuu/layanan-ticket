@extends('layouts.custommaster')
@section('content')

								<div class="pb-0 px-5 pt-0 text-center">
									<h3 class="mb-2">{{lang('Reset Password')}}</h1>
								</div>
								<form class="card-body pt-3 pb-0" method="POST" action="{{url('customer/reset-password')}}" >
                                @csrf
								@honeypot

                                <input type="hidden" name="token" value="{{ $token }}">
									<div class="form-group">
										<label class="form-label"  for="email" >{{lang('Email')}}</label>
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" autocomplete="email" placeholder="{{lang('example@mail.com')}}" autofocus readonly>

                                        @error('email')

                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ lang($message) }}</strong>
                                            </span>
                                        @enderror

                                    </div>
									<div class="form-group">
										<label class="form-label" for="password" >{{lang('New Password')}}</label>
										<input class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{lang('password')}}" type="password">
                                        @error('password')

                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ lang($message) }}</strong>
                                            </span>
                                        @enderror

                                    </div>
									<div class="form-group">
										<label class="form-label" for="password-confirm" >{{lang('Confirm Password')}}</label>
										<input class="form-control" placeholder="{{lang('password')}}" id="password-confirm"  name="password_confirmation" type="password">
									</div>
									<div class="submit">
                                    <button type="submit" class="btn btn-secondary btn-block" onclick="this.disabled=true;this.form.submit();">
                                        {{lang('Reset Password')}}
                                    </button>
									</div>
									<div class="text-center mt-4">
										<p class="text-dark mb-0">{{lang('Remembered your password?')}}<a class="text-primary ms-1" href="{{url('/login')}}">{{lang('Login', 'menu')}}</a></p>
									</div>
								</form>
@endsection
