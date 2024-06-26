@extends('layouts.usermaster')


@section('content')


						<!-- Section -->
						<section>
							<div class="bannerimg cover-image" data-bs-image-src="{{asset('assets/images/photos/banner1.jpg')}}">
								<div class="header-text mb-0">
									<div class="container">
										<div class="row text-white">
											<div class="col">
												<h1 class="mb-0">{{lang('Knowledge')}}</h1>
											</div>
											<div class="col col-auto">
												<ol class="breadcrumb text-center">
													<li class="breadcrumb-item">
														<a href="#" class="text-white-50">{{lang('Home')}}</a>
													</li>
													<li class="breadcrumb-item active">
														<a href="#" class="text-white">{{lang('Knowledge')}}</a>
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
							<div class="cover-image sptb mb-5">
								<div class="container">
									<div class="row row-deck">

										@if ($article->isEmpty())

										<div class="row">
											<div class="card no-articles mx-3">
												<div class="card-body p-8">
													<div class="main-content text-center">
														<div class="notification-icon-container p-4">
															<img src="{{asset('assets/images/noarticle.png')}}" alt="">
														</div>
														<h4 class="mb-1">{{lang('This article section will be updated shortly.')}}</h4>
														<p class="text-muted">{{lang('There are no notifications. We will notify you when the new notification arrives.')}}</p>
													</div>
												</div>
											</div>
										</div>
										@else

											<div class="col-xl-6">
												<div class="card">
													<div class="card-header border-bottom-0">
														<h4 class="card-title fs-25">{{lang('Recent Articles')}}</h4>
													</div>
													<div class="card-body">
														<ul class="list-unstyled list-article mb-0">
															@foreach ($article as $articles)
															@if($articles->articleslug != null)

															<li>
																<a class="" href="{{url('/article/' . $articles->articleslug)}}"><i class="typcn typcn-document-text"></i>
																	@if($articles->subcategory != null)
																		@if($articles->subcategorys)
																		<small class="fs-12 d-block text-muted">{{$articles->subcategorys->subcategoryname}}</small>
																		@endif
																	@endif
																	<span class="categ-text">{{Str::limit($articles->title, '100')}}</span>
																</a>
															</li>
															@else

															<li>
																<a class="" href="{{url('/article/' . $articles->id)}}">
																	<i class="typcn typcn-document-text"></i>
																	@if($articles->subcategory != null)
																		@if($articles->subcategorys)
																		<small class="fs-12 d-block text-muted">{{$articles->subcategorys->subcategoryname}}</small>
																		@endif
																	@endif
																	<span class="categ-text">{{Str::limit($articles->title, '100')}}</span></a>
															</li>
															@endif
															@endforeach

														</ul>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="card">
													<div class="card-header border-bottom-0">
														<h4 class="card-title fs-25">{{lang('Popular Articles')}}</h4>
													</div>
													<div class="card-body">
														<ul class="list-unstyled list-article mb-0">
															@foreach ($populararticle as $populararticles)
															@if($populararticles->articleslug != null)

															<li>
																<a class="" href="{{url('/article/' . $populararticles->articleslug)}}"><i class="typcn typcn-document-text"></i>
																	@if($populararticles->subcategory != null)
																		@if($populararticles->subcategorys)
																		<small class="fs-12 d-block text-muted">{{$populararticles->subcategorys->subcategoryname}}</small>
																		@endif
																	@endif
																	<span class="categ-text">{{Str::limit($populararticles->title,'100')}}</span></a>
															</li>
															@else

															<li>
																<a class="" href="{{url('/article/' . $populararticles->id)}}"><i class="typcn typcn-document-text"></i>
																	@if($populararticles->subcategory != null)
																		@if($populararticles->subcategorys)
																		<small class="fs-12 d-block text-muted">{{$populararticles->subcategorys->subcategoryname}}</small>
																		@endif
																	@endif
																	<span class="categ-text">{{Str::limit($populararticles->title,'100')}}</span></a>
															</li>
															@endif
															@endforeach

														</ul>
													</div>
												</div>
											</div>
										@endif
										@foreach ($categorys as $category)
										@if ($category->articles->isNotEmpty())

										<div class="col-xl-4">
											<div class="card">
												<div class="card-header border-bottom-0 d-flex">
													<h4 class="card-title fs-25">{{$category->name}}</h4>
													<span class="card-options me-0 ">
														{{-- @if ($category->articles()->where('status', 'Published')->simplepaginate(5) > '5') --}}
														@if($category->categoryslug != null)

														<a href="{{url('/category/'. $category->categoryslug)}}" class="text-primary">{{lang('View All')}}</a>
														@else

														<a href="{{url('/category/'. $category->id)}}" class="text-primary">{{lang('View All')}}</a>
														@endif
														{{-- @endif --}}
													</span>
												</div>
												<div class="card-body">
													<ul class="list-unstyled list-article mb-0">
														@foreach ($category->articles()->where('status', 'Published')->latest()->simplepaginate(5) as $articless)

															@if($articless->articleslug != null)

															<li>
																<a class="" href="{{url('article/' . $articless->articleslug)}}"><i class="typcn typcn-document-text"></i>
																	@if($articless->subcategory != null)
																		@if($articless->subcategorys)
																		<small class="fs-12 d-block text-muted">{{$articless->subcategorys->subcategoryname}}</small>
																		@endif
																	@endif
																	<span class="categ-text">{{Str::limit($articless->title,'50')}}</span></a>
															</li>
															@else

															<li>
																<a class="" href="{{url('article/' . $articless->id)}}"><i class="typcn typcn-document-text"></i>
																	@if($articless->subcategory != null)
																		@if($articless->subcategorys)
																		<small class="fs-12 d-block text-muted">{{$articless->subcategorys->subcategoryname}}</small>
																		@endif
																	@endif
																	<span class="categ-text">{{Str::limit($articless->title,'50')}}</span></a>
															</li>
															@endif
														@endforeach

													</ul>
												</div>
											</div>
										</div>
										@endif
										@endforeach

									</div>
								</div>
							</div>
						</section>
						<!--Section-->


@endsection
