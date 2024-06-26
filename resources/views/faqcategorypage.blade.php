@extends('layouts.usermaster')

@section('styles')

@endsection

@section('content')

							<!-- Section -->
							<section>
								<div class="bannerimg cover-image" data-bs-image-src="{{asset('assets/images/photos/banner1.jpg')}}">
									<div class="header-text mb-0">
										<div class="container">
											<div class="row text-white">
												<div class="col">
													<h1 class="mb-0">{{$faqcategory->faqcategoryname}}</h1>
												</div>
												<div class="col col-auto">
													<ol class="breadcrumb text-center d-flex align-items-center justify-content-center">
														<li class="breadcrumb-item">
															<a href="{{url('/')}}" class="text-white-50">{{lang('Home', 'menu')}}</a>
														</li>
														<li class="breadcrumb-item">
															<a href="{{url('faq/')}}" class="text-white-50">{{lang('FAQ’s', 'menu')}}</a>
														</li>
														<li class="breadcrumb-item active">
															<a href="#" class="text-white">{{$faqcategory->faqcategoryname}}</a>
														</li>
													</ol>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- Section -->

							<!--Section-->
							<section>
								<div class="cover-image sptb">
									<div class="container">
										<div class="row">
											<div class="col-xl-12">
												<div aria-multiselectable="true" class="accordion suuport-accordion" id="accordion" role="tablist">
													@php $faq = $faqcategory->faqdetails()->where('status', '1')->get();  @endphp

													@if($faq->isNotempty())
													<div class="accordion accordionExample" >
														<div class="row mb-5">

															@foreach ($faq as $faqs)

															<div class="col-xl-12">
																<div class="accordion-item">
																	<h2 class="accordion-header" id="heading{{$faqs->id}}">
																	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faqs->id}}" aria-expanded="true" aria-controls="collapse{{$faqs->id}}">
																		{{$faqs->question}}
																	</button>
																	</h2>
																	<div id="collapse{{$faqs->id}}" class="accordion-collapse collapse " aria-labelledby="heading{{$faqs->id}}" data-bs-parent=".accordionExample">
																		<div class="accordion-body">
																		@if($faqs->privatemode == 1)
																			@if(Auth::guard('customer')->check() && Auth::guard('customer')->user())

																			{!!$faqs->answer!!}
																			@else

																			<div class="alert alert-light-warning ">
																				<p class="privatearticle">
																				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
																				{{lang('You must be logged in and have valid account to access this content.')}}
																				</p>
																			</div>
																			@endif
																		@else

																		{!!$faqs->answer!!}
																		@endif
																		</div>
																	</div>
																</div>
															</div>
															@endforeach


														</div>
													</div>


													@else
													<div class="card no-articles">
														<div class="card-body p-8">
															<div class="main-content text-center">
																<div class="notification-icon-container p-4">
																	<img src="{{asset('assets/images/noarticle.png')}}" alt="">
																</div>
																<h4 class="mb-1">{{lang('There are no new FAQ’s')}}</h4>
																<p class="text-muted">{{lang('This faq section will be updated shortly.')}}</p>
															</div>
														</div>
													</div>
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!--Section-->
@endsection

@section('scripts')

		<!-- INTERNAL Vertical-scroll js-->
		<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}"></script>

@endsection


