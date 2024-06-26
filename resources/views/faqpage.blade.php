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
													<h1 class="mb-0">{{lang('FAQ’s', 'menu')}}</h1>
												</div>
												<div class="col col-auto">
													<ol class="breadcrumb text-center d-flex align-items-center justify-content-center">
														<li class="breadcrumb-item">
															<a href="#" class="text-white-50">{{lang('Home', 'menu')}}</a>
														</li>
														<li class="breadcrumb-item active">
															<a href="#" class="text-white">{{lang('FAQ’s')}}</a>
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
								<div class="cover-image mt-0 sptb">
									<div class="container">

										@foreach($faqcats as $faqcat)

										@php
										$faq = $faqcat->faqdetails()->where('status', '1')->paginate('5');

										@endphp
										@if($faq->isNotEmpty())
                                            <div class="accordion-group d-flex justify-content-between">
                                                <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#dee5f7"/><path fill="#565b95" d="M15 10A3.0001 3.0001 0 0 0 9.40234 8.499a.99981.99981 0 0 0 1.73047 1.002A1.00022 1.00022 0 1 1 12 11a.99943.99943 0 0 0-1 1v1a1 1 0 0 0 2 0v-.18433A2.99487 2.99487 0 0 0 15 10zM12 17a.9994.9994 0 0 1-.37988-.08008 1.14718 1.14718 0 0 1-.33008-.21 1.16044 1.16044 0 0 1-.21-.33008A.83154.83154 0 0 1 11 16a1.39038 1.39038 0 0 1 .01953-.2002.65026.65026 0 0 1 .06055-.17968.74157.74157 0 0 1 .08984-.18067A1.61105 1.61105 0 0 1 11.29 15.29a1.04667 1.04667 0 0 1 1.41992 0A1.0321 1.0321 0 0 1 13 16a.9994.9994 0 0 1-.08008.37988.90087.90087 0 0 1-.54.54A.9994.9994 0 0 1 12 17z"/></svg>{{$faqcat->faqcategoryname}}</p>
                                                @if($faq > '5')

                                                <div>
                                                    <a href="{{url('faq/'.$faqcat->id)}}" class="btn btn-sm btn-light ms-auto">{{lang('View All')}}</a>
                                                </div>

                                                @endif

                                            </div>
                                            <div class="accordion accordionExample{{$faqcat->id}}" >
                                                <div class="row mb-5">
                                                    @foreach ($faq as $faqs)

                                                    <div class="col-xl-12">
                                                        <div class="accordion-item">
                                                                <h2 class="accordion-header" id="heading{{$faqs->id}}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faqs->id}}" aria-expanded="true" aria-controls="collapse{{$faqs->id}}">
                                                                    {{$faqs->question}}
                                                                </button>
                                                                </h2>
                                                                <div id="collapse{{$faqs->id}}" class="accordion-collapse collapse " aria-labelledby="heading{{$faqs->id}}" data-bs-parent=".accordionExample{{$faqcat->id}}">
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
                                            @endif
										@endforeach

                                        @if(App\Models\FAQ::get()->all() == null)
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


                                        @if($faqcats->all() == null)
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
							</section>
							<!--Section-->
@endsection

@section('scripts')

		<!-- INTERNAL Vertical-scroll js-->
		<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}"></script>







@endsection


