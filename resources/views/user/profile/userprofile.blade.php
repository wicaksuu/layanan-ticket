@extends('layouts.usermaster')


								@section('content')

								<!-- Section -->
								<section>
									<div class="bannerimg cover-image" data-bs-image-src="{{asset('assets/images/photos/banner1.jpg')}}">
										<div class="header-text mb-0">
											<div class="container ">
												<div class="row text-white">
													<div class="col">
														<h1 class="mb-0">{{lang('Edit Profile')}}</h1>
													</div>
													<div class="col col-auto">
														<ol class="breadcrumb text-center">
															<li class="breadcrumb-item">
																<a href="#" class="text-white-50">{{lang('Home', 'menu')}}</a>
															</li>
															<li class="breadcrumb-item active">
																<a href="#" class="text-white">{{lang('Edit Profile')}}</a>
															</li>
														</ol>
													</div>
												</div>
											</div>
										</div>
									</div>
								</section>
								<!-- Section -->

								<!--Profile Page -->
								<section>
									<div class="cover-image sptb">
										<div class="container ">
											<div class="row">
												@include('includes.user.verticalmenu')

												<div class="col-xl-9">
													<div class="card">
														<div class="card-header border-0">
															<h4 class="card-title">{{lang('Profile Details')}}</h4>
														</div>
														<div class="card-body">
															<form method="POST" action="{{route('client.profilesetup')}}" enctype="multipart/form-data">
																@csrf

																@honeypot

																<div class="row">
																	<div class="col-sm-6 col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('First Name')}}<span class="text-red">*</span></label>
																			<input type="text"
																				class="form-control @error('firstname') is-invalid @enderror"
																				name="firstname" value="{{old('firstname',Auth::guard('customer')->user()->firstname)}}" readonly>
																			@error('firstname')

																			<span class="invalid-feedback" role="alert">
																				<strong>{{ lang($message) }}</strong>
																			</span>
																			@enderror

																		</div>
																	</div>
																	<div class="col-sm-6 col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('Last Name')}}<span class="text-red">*</span></label>
																			<input type="text"
																				class="form-control @error('lastname') is-invalid @enderror"
																				name="lastname" value="{{old('lastname', Auth::guard('customer')->user()->lastname)}}" readonly>
																			@error('lastname')

																			<span class="invalid-feedback" role="alert">
																				<strong>{{ lang($message) }}</strong>
																			</span>
																			@enderror

																		</div>
																	</div>
																	<div class="col-sm-6 col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('Username')}}</label>
																			<input type="text" class="form-control @error('name') is-invalid @enderror"
																				name="username" Value="{{Auth::guard('customer')->user()->username}}" readonly>
																			@error('username')

																			<span class="invalid-feedback" role="alert">
																				<strong>{{ lang($message) }}</strong>
																			</span>
																			@enderror

																		</div>
																	</div>
																	<div class="col-sm-6 col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('Email')}}</label>
																			<input type="email" class="form-control"
																				Value="{{Auth::guard('customer')->user()->email}}" readonly>

																		</div>
																	</div>
																	<div class="col-sm-6 col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('Mobile Number')}}</label>
																			<input type="text" class="form-control @error('phone') is-invalid @enderror"
																				value="{{old('phone', Auth::guard('customer')->user()->phone)}}" name="phone">
																				@error('phone')

																				<span class="invalid-feedback" role="alert">
																					<strong>{{ lang($message) }}</strong>
																				</span>
																				@enderror

																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('Country')}}</label>
																			<select name="country" class="form-control select2 select2-show-search">
																				@foreach($countries as $country)
																				<option value="{{$country->name}}" {{$country->name == Auth::guard('customer')->user()->country ? 'selected' : ''}}>{{lang($country->name)}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('Timezone')}}</label>
																			<select name="timezone" class="form-control select2 select2-show-search">
																				@foreach($timezones  as $group => $timezoness)

																					<option value="{{$timezoness->timezone}}" {{$timezoness->timezone == Auth::guard('customer')->user()->timezone ? 'selected' : ''}}>{{lang($timezoness->timezone)}} {{lang($timezoness->utc)}}</option>

																				@endforeach
																			</select>
																		</div>
																	</div>

                                                                    @if($customfield != null)
                                                                        @foreach($customfield as $customfields)
                                                                            @if($customfields->fieldtypes != 'textarea')
                                                                                @if($customfields->privacymode == '1')
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label class="form-label">{{$customfields->fieldnames}}</label>
                                                                                            <input type="email" class="form-control" Value="{{decrypt($customfields->values)}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label class="form-label">{{$customfields->fieldnames}}</label>
                                                                                            <input type="email" class="form-control" Value="{{$customfields->values}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @endif

																	@if (setting('PROFILE_USER_ENABLE') == 'yes')

																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="form-label">{{lang('Upload Image')}}</label>
																			<div class="input-group file-browser">
																				<input class="form-control @error('image') is-invalid @enderror" name="image" type="file" accept="image/png, image/jpeg,image/jpg" >
																				@error('image')

																				<span class="invalid-feedback" role="alert">
																					<strong>{{ lang($message) }}</strong>
																				</span>
																				@enderror

																			</div>
																			<small class="text-muted"><i>{{lang('The file size should not be more than 5MB', 'filesetting')}}</i></small>
																		</div>
                                                                        @if (Auth::guard('customer')->user()->image != null)
                                                                            <div class="file-image-1 removesprukoi{{Auth::guard('customer')->user()->id}}">
                                                                                <div class="product-image custom-ul">
                                                                                    <a href="#">
                                                                                        <img src="{{asset('uploads/profile/'.Auth::guard('customer')->user()->image)}}" class="br-5" alt="{{Auth::guard('customer')->user()->image}}">
                                                                                    </a>
                                                                                    <ul class="icons">
                                                                                        <li><a href="javascript:(0);" class="bg-danger delete-image" data-id="{{Auth::guard('customer')->user()->id}}"><i class="fe fe-trash"></i></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        @endif
																	</div>
																	@endif

																	<div class="col-md-12 card-footer ">
																		<div class="form-group">
																			<input type="submit" class="btn btn-secondary float-end " value="{{lang('Save Changes')}}"
																				onclick="this.disabled=true;this.form.submit();">
																		</div>
																	</div>
																</div>
															</form>
														</div>
													</div>
													@if(setting('SPRUKOADMIN_C') == 'on')

													<div class="card">
														<div class="card-header">
															<div class="card-title">{{lang('Personal setting')}}</div>
														</div>
														<div class="card-body">

															<div class="switch_section">
																<div class="switch-toggle d-flex mt-4">
																	<a class="onoffswitch2">
																		<input type="checkbox" data-id="{{Auth::guard('customer')->id()}}" name="darkmode" id="darkmode" class=" toggle-class onoffswitch2-checkbox sprukolayouts" value="off" @if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->custsetting != null) @if(Auth::guard('customer')->user()->custsetting->darkmode == '1') checked="" @endif @endif>
																		<label for="darkmode" class="toggle-class onoffswitch2-label" ></label>
																	</a>
																	<label class="form-label ps-3">{{lang('Switch to Dark-Mode')}}</label>
																</div>
															</div>
														</div>
													</div>

													@endif

													@include('user.auth.passwords.changepassword')

													@if(setting('cust_profile_delete_enable') == 'on')
													<div class="card">
														<div class="card-header">
															<div class="card-title">{{lang('Delete Account')}}</div>
														</div>
														<div class="card-body">
															<p>{{lang('Once you delete your account, you can not access your account with the same credentials. You need to re-register your account.')}}</p>
															<label class="custom-control form-checkbox">
																<input type="checkbox" class="custom-control-input " value="agreed" name="agree_terms" id="sprukocheck">
																<span class="custom-control-label">{{lang('I agree with')}} <a href="{{setting('terms_url')}}" class="text-primary"> {{lang('Terms of services')}}</a> </span>
															</label>
														</div>
														<div class="card-footer text-end">
															<button  class="btn btn-danger my-1" data-id="{{Auth::guard('customer')->id()}}" id="accountdelete">{{lang('Delete Account')}}</button>
														</div>
													</div>
													@endif
												</div>
											</div>
										</div>
									</div>
								</section>
								<!--Profile Page -->

								@endsection

		@section('scripts')


		<!-- INTERNAL Vertical-scroll js-->
		<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}?v=<?php echo time(); ?>"></script>

		<!-- INTERNAL Index js-->
		<script src="{{asset('assets/js/support/support-sidemenu.js')}}?v=<?php echo time(); ?>"></script>
		<script src="{{asset('assets/js/select2.js')}}?v=<?php echo time(); ?>"></script>


		<script type="text/javascript">
            "use strict";

			(function($){

				// Variables
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				// Profile Account Delete
				$('body').on('click', '#accountdelete', function () {
					var _id = $(this).data("id");

					swal({
						title: `{{lang('Warning! You are about to delete your account.')}}`,
						text: "{{lang('This action can not be undo. This will permanently delete your account')}}",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: "post",
								url: SITEURL + "/customer/deleteaccount/"+_id,
								success: function (data) {
								location.reload();
								toastr.success(data.success);
								},
								error: function (data) {
								console.log('Error:', data);
								}
							});
						}
					});
				});

				// Switch to dark mode js
				$('.sprukolayouts').on('change', function() {
					var dark = $('#darkmode').prop('checked') == true ? '1' : '';
					var cust_id = $(this).data('id');
					console.log(dark);
					$.ajax({
						type: "POST",
						dataType: "json",
						url: '{{url('/customer/custsettings')}}',
						data: {
							'dark': dark,
						 	'cust_id': cust_id
						},
						success: function(data){
							location.reload();
							toastr.success('{{lang('Updated successfully', 'alerts')}}');
						}
					});
				});

                //Delete Image
                $('body').on('click', '.delete-image', function () {
                    var _id = $(this).data("id");

                    swal({
                        title: `{{lang('Are you sure you want to remove the profile image?', 'alerts')}}`,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "delete",
                                url: SITEURL + "/customer/image/remove/"+_id,
                                success: function (data) {
                                    toastr.success(data.success);
                                    location.reload();
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                }
                            });
                        }
                    });
                });

			})(jQuery);

			// If no tick in check box in disable in the delete button
			var checker = document.getElementById('sprukocheck');
			var sendbtn = document.getElementById('accountdelete');
            if(sendbtn){

                if(!this.checked){
                    sendbtn.style.pointerEvents = "auto";
                        sendbtn.style.cursor = "not-allowed";
                    }else{
                        sendbtn.style.cursor = "pointer";
                    }
                sendbtn.disabled = !this.checked;

                checker.onchange = function() {

                    sendbtn.disabled = !this.checked;
                    if(!this.checked){
                        sendbtn.style.pointerEvents = "auto";
                        sendbtn.style.cursor = "not-allowed";
                    }else{
                        sendbtn.style.cursor = "pointer";
                    }
                }
		    };

		</script>

		@endsection
