@extends('layouts.usermaster')



							@section('content')

							<!-- Section -->
							<section>
								<div class="bannerimg cover-image" data-bs-image-src="{{asset('assets/images/photos/banner1.jpg')}}">
									<div class="header-text mb-0">
										<div class="container">
											<div class="row text-white">
												<div class="col">
													<h1>{{lang('Contact Us', 'menu')}}</h1>
												</div>
												<div class="col col-auto">
													<ol class="breadcrumb text-center">
														<li class="breadcrumb-item">
															<a href="{{url('/')}}" class="text-white-50">{{lang('Home', 'menu')}}</a>
														</li>
														<li class="breadcrumb-item active">
															<a href="#" class="text-white">{{lang('Contact Us', 'menu')}}</a>
														</li>
													</ol>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- Section -->

							<!--Contact Us Page-->
							<section>
								<div class="cover-image sptb">
									<div class="container">
										<div class="row">
											<div class="col-lg-6 col-xl-6 col-md-12 mx-auto d-block">
												<div class="card mb-0">
													<div class="card-body">
														<h3 class="font-weight-semibold2 mb-5">{{lang('Let’s get in Touch')}}</h3>
														<form method="POST" action="{{url('/contact-us')}}">
															@csrf

															@honeypot

															<div class="form-group">
																<input class="form-control @error('name') is-invalid @enderror" placeholder="{{lang('Name')}}" type="text" name="name" value="{{ old('name') }}">
																@error('name')

																	<span class="invalid-feedback" role="alert">
																		<strong>{{ lang($message) }}</strong>
																	</span>
																@enderror

															</div>
															<div class="form-group">
																<input class="form-control @error('email') is-invalid @enderror"  placeholder="{{lang('Email')}}" type="email" name="email" value="{{ old('email') }}">
																@error('email')

																	<span class="invalid-feedback" role="alert">
																		<strong>{{ lang($message) }}</strong>
																	</span>
																@enderror

															</div>
															<div class="form-group">
																<input class="form-control @error('phone_number') is-invalid @enderror"  placeholder="{{lang('Mobile Number')}}" type="text" name="phone_number" value="{{ old('phone_number') }}">
																@error('phone_number')

																	<span class="invalid-feedback" role="alert">
																		<strong>{{ lang($message) }}</strong>
																	</span>
																@enderror

															</div>
															<div class="form-group">
																<input class="form-control @error('subject') is-invalid @enderror" placeholder="{{lang('Subject')}}" type="text" name="subject" value="{{ old('subject') }}">
																@error('subject')

																	<span class="invalid-feedback" role="alert">
																		<strong>{{ lang($message) }}</strong>
																	</span>
																@enderror

															</div>
															<div class="form-group">
																<textarea class="form-control @error('message') is-invalid @enderror"  placeholder="{{lang('Message')}}" rows="6" name="message" >{{ old('message') }}</textarea>
																@error('message')

																	<span class="invalid-feedback" role="alert">
																		<strong>{{ lang($message) }}</strong>
																	</span>
																@enderror

															</div>
															@if(setting('CAPTCHATYPE')=='manual')
																@if(setting('RECAPTCH_ENABLE_CONTACT')=='yes')

																<div class="form-group row">
																	<div class="col-md-6">
																		<input type="text" id="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="{{lang('Enter Captcha')}}" name="captcha">
																		@error('captcha')

																			<span class="invalid-feedback" role="alert">
																				<strong>{{ lang($message) }}</strong>
																			</span>
																		@enderror

																	</div>
																	<div class="col-md-6">
																		<div class="captcha">
																			<span>{!! captcha_img('') !!}</span>
																			<button type="button" class="btn btn-outline-info btn-sm captchabtn"><i class="fe fe-refresh-cw"></i></button>
																		</div>
																	</div>
																</div>
																@endif
															@endif

															<!--- if Enable the Google ReCaptcha --->
															<div class="form-group">
																@if(setting('CAPTCHATYPE')=='google')
																	@if(setting('RECAPTCH_ENABLE_CONTACT')=='yes')

																	<div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-sitekey="{{setting('GOOGLE_RECAPTCHA_KEY')}}"></div>
																	@if ($errors->has('g-recaptcha-response'))

																		<span class="invalid-feedback" role="alert">
																			<strong>{{ $errors->first('g-recaptcha-response') }}</strong>
																		</span>
																	@endif
																	@endif
																@endif

															</div>
															<!--- End Google ReCaptcha --->

															<div class="text-start">
																<input class="btn btn-secondary waves-effect waves-light" value="{{lang('Send Message')}}" type="submit" onclick="this.disabled=true;this.form.submit();">
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!--Contact Us Page-->
							@endsection

		@section('scripts')

		<!-- INTERNAL Vertical-scroll js-->
		<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}?v=<?php echo time(); ?>"></script>

		<!-- Captcha js-->
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>

		<!-- Captcha js-->
		<script type="text/javascript">

			"use strict";

			(function($)  {

				$(".captchabtn").on('click', function(e){
					e.preventDefault();
					$.ajax({
						type:'GET',
						url:'captchareload',
						success: function(res){
							$(".captcha span").html(res.captcha);
						}
					});
				});

			})(jQuery);
		</script>

		@endsection

