							<!--app header-->
							<div class="app-header header header-main">
								<div class="container-fluid">
									<div class="d-flex align-items-center justify-content-between">
										<a class="header-brand mt-0" href="{{url('admin')}}">
										{{--Logo--}}
										@if ($title->image == null)

										<img src="{{asset('uploads/logo/logo/logo-white.png')}}" class="header-brand-img dark-logo" alt="logo">
										@else

										<img src="{{asset('uploads/logo/logo/'.$title->image)}}" class="header-brand-img dark-logo" alt="logo">
										@endif

										{{--Dark-Logo--}}
										@if ($title->image1 == null)

										<img src="{{asset('uploads/logo/darklogo/logo.png')}}" class="header-brand-img desktop-lgo" alt="dark-logo">
										@else

										<img src="{{asset('uploads/logo/darklogo/'.$title->image1)}}" class="header-brand-img desktop-lgo" alt="dark-logo">
										@endif

										{{--Mobile-Logo--}}
										@if ($title->image2 == null)

										<img src="{{asset('uploads/logo/icon/icon.png')}}" class="header-brand-img mobile-logo" alt="mobile-logo">
										@else

										<img src="{{asset('uploads/logo/icon/'.$title->image2)}}" class="header-brand-img mobile-logo" alt="mobile-logo">
										@endif

										{{--Mobile-Dark-Logo--}}
										@if ($title->image3 == null)

										<img src="{{asset('uploads/logo/darkicon/icon-white.png')}}" class="header-brand-img darkmobile-logo" alt="mobile-dark-logo">
										@else

										<img src="{{asset('uploads/logo/darkicon/'.$title->image3)}}" class="header-brand-img darkmobile-logo" alt="mobile-dark-logo">
										@endif

										</a>
										<div class="app-sidebar__toggle me-md-5 ms-md-2 mx-0" data-bs-toggle="sidebar">
											<a class="open-toggle" href="#">
												<i class="feather feather-menu"></i>
											</a>
											<a class="close-toggle" href="#">
												<i class="feather feather-x"></i>
											</a>
										</div>
										<div class="header-buttons-main mt-0">
											<a class="btn btn-outline-light header-buttons text-center" href="{{url('/admin/createticket')}}"><i class="fa fa-paper-plane-o pe-lg-2"></i><span class="d-m-none">{{lang('Create Ticket', 'Menu')}}</span></a>
											<a class="btn btn-outline-light header-buttons text-center visitsite ms-2" href="{{route('home')}}" target="_blank"><i class="fe fe-home pe-lg-2"></i><span class="d-m-none">{{lang('Home Page', 'Menu')}}</span></a>

										</div><!-- SEARCH -->
										<div class="d-flex order-lg-2 my-auto ms-sm-auto dropdown-container align-items-center">

											<div class="dropdown header-flags ms-1">

												<a href="#" class="text-capitalize dropdown-toggle" data-bs-toggle="dropdown">
													{{ getLangName() }}


												</a>
												<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated text-capitalize">

													@foreach(getLanguageslist() as $lang)

														<a href="{{langURL($lang->languagecode)}}" class="dropdown-item d-flex fs-13 {{ getLangName() == $lang->languagename ? 'active':'' }}">
														<span class="">{{ $lang->languagename }}</span>
														</a>
													@endforeach

												</div>
											</div>

											<div class="dropdown header-fullscreen">
												<a class="nav-link icon full-screen-link pe-0 me-0">
													<i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
													<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
												</a>
											</div>
											@include('includes.admin.notification')

											<div class="dropdown profile-dropdown ps-0 ps-lg-2">
												<a href="#" class="nav-link pe-1 ps-0 leading-none" data-bs-toggle="dropdown">
													<span>
														@if (Auth::user()->image == null)

															<img src="{{asset('uploads/profile/user-profile.png')}}" class="avatar avatar-md bradius rounded-circle" alt="default">
														@else

															<img src="{{asset('uploads/profile/'.Auth::user()->image)}}" class="avatar avatar-md bradius rounded-circle " alt="{{Auth::user()->image}}">
														@endif

													</span>
												</a>
												<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
													<div class="p-3 text-center border-bottom">
														<a href="{{url('/admin/profile')}}" class="text-center user pb-0 font-weight-bold">{{Auth::user()->name}}</a>
														@if(!empty(Auth::user()->getRoleNames()[0]))
														<p class="text-center user-semi-title">{{ Auth::user()->getRoleNames()[0]}}</p>
														@endif
													</div>
													<a class="dropdown-item d-flex" href="{{url('/admin/profile')}}">
														<i class="feather feather-user me-3 fs-16 my-auto"></i>
														<div class="mt-1">{{lang('Profile', 'Menu')}}</div>
													</a>
													<form id="logout-form" action="{{ route('logout') }}" method="POST">
														@csrf

														<button type="submit" class="dropdown-item d-flex">
															<i class="feather feather-power me-3 fs-16 my-auto"></i>
															<div class="mt-1" >{{lang('Logout', 'Menu')}}</div>
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/app header-->
