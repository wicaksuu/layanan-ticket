
@extends('layouts.adminmaster')

@section('styles')

<!-- INTERNAl Tag css -->
<link href="{{asset('assets/plugins/taginput/bootstrap-tagsinput.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

@endsection

@section('content')


<!--Page header-->
<div class="page-header d-xl-flex d-block">
	<div class="page-leftheader">
		<h4 class="page-title"><span class="font-weight-normal text-muted ms-2">{{lang('Employee')}}</span></h4>
	</div>
</div>
<!--End Page header-->

<!-- Employee Create -->
<div class="col-xl-12 col-lg-12 col-md-12">
	<div class="card ">
		<div class="card-header border-0">
			<h4 class="card-title">{{lang('Create Employee', 'menu')}}</h4>
		</div>
		<form method="POST" action="{{url('/admin/agent')}}" enctype="multipart/form-data">
			<div class="card-body" >
				@csrf

				@honeypot
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('First Name')}} <span class="text-red">*</span></label>
							<input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname"  value="{{old('firstname')}}" >
							@error('firstname')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Last Name')}} <span class="text-red">*</span></label>
							<input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"  value="{{old('lastname')}}">
							@error('lastname')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Select Role')}} <span class="text-red">*</span></label>
							<select id="roleID" class="form-control select2-show-search  select2 @error('role') is-invalid @enderror" data-placeholder="{{lang('Select Roles')}}" name="role"  >
								<option label="{{lang('Select Role')}}"></option>
								@foreach($roles as $role)

									<option  value="{{$role->name}}" {{ old('role') == $role->name ? "selected" : "" }}> {{$role->name}}</option>
								@endforeach

							</select>
							@error('role')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Department')}} </label>
							<select class="form-control select2-show-search  select2 @error('department') is-invalid @enderror" data-placeholder="{{lang('Select Department')}}" name="department">
								<option label="{{lang('Select Department')}}"></option>
								@foreach($departments as $department)

									<option  value="{{$department->departmentname}}" {{ old('departments') == $department->departmentname ? "selected" : "" }}> {{$department->departmentname}}</option>

								@endforeach

							</select>

							@error('department')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Employee ID')}} <span class="text-red">*</span></label>
							<input type="text" class="form-control @error('empid') is-invalid @enderror" placeholder="EMPID-001" name="empid"  value="{{old('empid')}}">
							@error('empid')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Mobile Number')}} </label>
							<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{old('phone')}}" >
							@error('phone')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Email')}} <span class="text-red">*</span></label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{old('email')}}" >
							@error('email')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Password')}} <small class="text-muted"><i>{{lang('(Please copy the Password)')}}</i></small></label>
							<input class="form-control @error('password') is-invalid @enderror" type="text"  name="password" value="{{str_random(10)}}"  readonly>
							@error('password')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Languages')}}</label>
							<input type="text"  class="form-control @error('languages') is-invalid @enderror" value="{{old('languages')}}" name="languages" data-role="tagsinput" />
							@error('languages')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Skills')}}</label>
							<input type="text"  class="form-control @error('skills') is-invalid @enderror" value="{{old('skills')}}" name="skills" data-role="tagsinput" />
							@error('skills')

								<span class="invalid-feedback" role="alert">
									<strong>{{ lang($message) }}</strong>
								</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Country')}}</label>
							<select name="country" class="form-control select2 select2-show-search" id="">
								@foreach($countries as $country)
								<option value=""></option>
								<option value="{{$country->name}}">{{$country->name}}</option>
								@endforeach
							</select>


						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{lang('Timezone')}}</label>
							<select name="timezone" class="form-control select2 select2-show-search" id="">
								@foreach($timezones  as $group => $timezoness)
									<option value=""></option>
									<option value="{{$timezoness->timezone}}">{{$timezoness->timezone}} {{$timezoness->utc}}</option>

								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-12">
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
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<label class="form-label">{{lang('Select Dashboard')}}</label>
							<div class="custom-controls-stacked d-md-flex" id="text">
								<label class="custom-control form-radio success me-4">
									<input id="empDashboard" type="radio" class="custom-control-input" name="dashboard" value="Employee" checked="" autocomplete="off">
									<span class="custom-control-label">{{lang('Employee Dashboard')}}</span>
								</label>
								<label class="custom-control form-radio success me-4">
									<input id="AdmDashboard" type="radio" class="custom-control-input" name="dashboard" value="Admin" autocomplete="off">
									<span class="custom-control-label">{{lang('Admin Dashboard')}}</span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 card-footer">
				<div class="form-group float-end">
					<input type="submit" class="btn btn-secondary" value="{{lang('Create Employee', 'menu')}}" onclick="this.disabled=true;this.form.submit();">
				</div>
			</div>
		</form>
	</div>
</div>
<!-- End Employee Create -->
@endsection

@section('scripts')

<!--File BROWSER -->
<script src="{{asset('assets/js/form-browser.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL Vertical-scroll js-->
<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}?v=<?php echo time(); ?>"></script>
<script src="{{asset('assets/js/select2.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL Index js-->
<script src="{{asset('assets/js/support/support-sidemenu.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL TAG js-->
<script src="{{asset('assets/plugins/taginput/bootstrap-tagsinput.js')}}?v=<?php echo time(); ?>"></script>

<script type="text/javascript">
	var SITEURL = '{{url('')}}';
	(function($) {
	"use strict";

	// Csrf Field
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});

	$('#roleID').on('change',function(e) {
	var cat_id = e.target.value;
	let empdasType = document.querySelector('#empDashboard');
	let admindasType = document.querySelector('#AdmDashboard');
	if(cat_id == 'superadmin'){
	admindasType.checked = true
	}
	else{
	empdasType.checked = true
	}
	});

	})(jQuery);

</script>

@endsection
