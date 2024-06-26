@extends('layouts.master')

@section('styles')

		<!-- INTERNAL owl-carousel css-->
		<link href="{{asset('assets/plugins/owl-carousel/owl-carousel.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />


@endsection

@section('content')

    <!--Banner Section-->
    <section>
        <div class="banner-1 cover-image sptb-tab bg-background-support" data-bs-image-src="{{asset('assets/images/photos/banner2.jpg')}}">
            <div class="header-text content-text mb-0">
                <div class="container">
                    <div class="text-center text-white mb-md-7 mt-7 mt-md-9">
                        <h1 class="mb-2">{{$title->searchtitle}}</h1>
                        <p class="fs-18">{{$title->searchsub}}</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-7 col-lg-12 col-md-12 d-block mx-auto">
                            <div class="search-background p-0">
                                <input type="text" class="form-control input-lg" name="search_name" id="search_name"  placeholder="{{lang('Ask your Questions...')}}">
                                <button class="btn"><i class="fe fe-search"></i></button>

                                <div id="searchList">

                                </div>
                            </div>
                            @csrf

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Banner Section-->

    <!--Feature Box Section-->
    <section>
        <div class="cover-image sptb">
            <div class="container">
                <div class="section-title center-block text-center">
                    <h2 class="wow fs-30" data-wow-delay="0.1s">{{$title->featuretitle}}</h2>
                    <p class="wow fs-18" data-wow-delay="0.15s">{{$title->featuresub}}</p>
                </div>
                <div class="row row-deck featureboxcenter">
                    @foreach ($feature as $box)

                        <div class="col-lg-4 col-md-4">
                            <div class="support-card card text-center wow" data-wow-delay="0.2s">
                                <div class="suuport-body">
                                    <a href="{{$box->featureboxurl}}" class="featureboxurl" {{$box->url_checkbox != null ? 'target=_blank' : '' ;}}></a>
                                    <div class="choose-icon">
                                        @if ($box->image !== null)

                                        <img src="{{asset('uploads/featurebox/' .$box->image)}}" alt="img" class="{{$box->image}}">
                                        @else

                                        <img src="{{asset('uploads/featurebox/noimage/noimage.svg')}}" alt="img" class="noimage">
                                        @endif

                                    </div>
                                    <div class="servic-data mt-3">
                                        <h4 class="font-weight-semibold mb-2">{{$box->title}}</h4>
                                        <p class="text-muted mb-0">{{$box->subtitle}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--Feature Box Section-->

@if ($call->callcheck == 'on')

    <!--Call Action Section-->
    <section>
        <div class="banner-2 cover-image" data-bs-image-src="{{asset('assets/images/pattern/pattern2.png')}}">
            <div class="header-text content-text mb-0">
                <div class="container px-sm-0 px-7">
                    <div class="row">
                        <div class="col-md-7 sptb">
                            <div class="text-white wow">
                                <h2 class="mb-2 fs-30 font-weight-semibold">{{$call->title}}</h2>
                                <p class="fs-18 text-white-50">{{$call->subtitle}}</p>
                                <a href="{{$call->buttonurl}}" class="btn btn-secondary btn-lg" target="_blank">{{$call->buttonname}}</a>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-center justify-content-center">
                                @if ($call->image !== null)

                                <img src="{{asset('uploads/callaction/'.$call->image)}}" alt="img" class="header-text3 call-to-action-image img-fluid">
                                @else

                                <img src="{{asset('uploads/callaction/noimage/noimage.png')}}" alt="img" class="header-text3 call-to-action-image img-fluid">
                                @endif

                        </div>
                    </div>
                </div>
            </div><!-- /header-text -->
        </div>
    </section>
    <!--Call Action Section-->
@endif
@if ($title->articlecheck == 'on')

    <!--Article Section-->
    <section>
        <div class="cover-image sptb">
            <div class="container">
                <div class="section-title center-block text-center">
                    <h2 class="wow fs-30" data-wow-delay="0.1s">{{$title->articletitle}}</h2>
                    <p class="wow fs-18" data-wow-delay="0.15s">{{$title->articlesub}}</p>
                </div>
                <div class="row row-deck">
                    @if ($article->isEmpty())

                    @else

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-bottom-0">
                                <h4 class="fs-25 card-title">{{lang('Recent Articles')}}</h4>
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
                                            <span class="categ-text">{{Str::limit($articles->title, '100')}}</span></a>
                                    </li>
                                    @else

                                    <li>
                                        <a class="" href="{{url('/article/' . $articles->id)}}"><i class="typcn typcn-document-text"></i>
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
                                <h4 class="fs-25 card-title">{{lang('Popular Articles')}}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-article mb-0">
                                    @foreach ($populararticle as $populararticles)

                                    @if($populararticles->articleslug != null)

                                    <li>
                                        <a class="" href="{{url('/article/' . $populararticles->id)}}"><i class="typcn typcn-document-text"></i>
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
                                <div class="card-header border-bottom-0 d-block">
                                    <h4 class="fs-25 card-title d-flex">{{$category->name}}
                                        <span class="card-options float-end font-weight-normal fs-14">
                                            @if ($category->articles()->where('status', 'Published')->simplepaginate(5) > '5')

                                            @if($category->categoryslug != null)

                                            <a href="{{url('/category/'. $category->categoryslug)}}" class="text-primary">{{lang('View All')}}</a>
                                            @else

                                            <a href="{{url('/category/'. $category->id)}}" class="text-primary">{{lang('View All')}}</a>
                                            @endif

                                            @endif
                                        </span>
                                    </h4>

                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled list-article mb-0">

                                        @foreach ($category->articles()->where('status', 'Published')->latest()->simplepaginate(5) as $articless)

                                        @if($articless->articleslug != null)

                                        <li>
                                            <a class="" href="{{url('/article/' . $articless->articleslug)}}"><i class="typcn typcn-document-text"></i>
                                                @if($articless->subcategory != null)
                                                    @if($articless->subcategorys)
                                                    <small class="fs-12 d-block text-muted">{{$articless->subcategorys->subcategoryname}}</small>
                                                    @endif
                                                @endif
                                            <span class="categ-text">{{Str::limit($articless->title,'50')}}</span></a>
                                        </li>
                                        @else

                                        <li>
                                            <a class="" href="{{url('/article/' . $articless->id)}}"><i class="typcn typcn-document-text"></i>
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
    <!--Article Section-->

@endif
@if ($title->testimonialcheck == 'on')
    <!--Testimonial Section-->
    <section>
        <div class="cover-image sptb bg-white">
            <div class="container">
                <div class="section-title center-block text-center">
                    <h2 class="wow fs-30" data-wow-delay="0.1s">{{$title->testimonialtitle}}</h2>
                    <p class="wow fs-18" data-wow-delay="0.15s">{{$title->testimonialsub}}</p>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div id="myCarousel1" class="owl-carousel testimonial-owl-carousel">
                                @foreach ($testimonial as $testimonials)

                                <div class="item text-center">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-8 col-md-12 d-block mx-auto">
                                                <div class="testimonia">
                                                    <div class="testimonia-img mx-auto mb-3">
                                                        @if ($testimonials->image !== null)

                                                        <img src="{{asset('uploads/testimonial/'. $testimonials->image)}}" class="avatar avatar-xxl brround text-center mx-auto" alt="{{$testimonials->image}}">
                                                        @else
                                                        <img src="{{asset('uploads/profile/user-profile.png')}}" class="avatar avatar-xxl brround text-center mx-auto" alt="default">
                                                        @endif

                                                    </div>
                                                    <p>
                                                        <i class="fa fa-quote-left"></i> {{$testimonials->description}}
                                                    </p>
                                                    <div class="testimonia-data">
                                                        <h4 class="fs-20 mb-1">{{$testimonials->name}}</h4>
                                                        <p>{{$testimonials->designation}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Testimonial Section-->
@endif
@if($title->faqcheck == 'on')

    <!--FAQ Section-->
    <section>
        <div class="cover-image sptb">
            <div class="container">
                <div class="section-title center-block text-center">
                    <h2 class="wow fs-30" data-wow-delay="0.1s">{{$title->faqtitle}}</h2>
                    <p class="wow fs-18" data-wow-delay="0.15s">{{$title->faqsub}}</p>
                </div>
                <div class="row justify-content-center">
                    @foreach ($faqcategorys as $faqcategory)

                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-4 tickets-category">
                                    <a href="{{route('faq.faqcategory', $faqcategory->id)}}"></a>
                                    <div class="faq-category d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#dee5f7"/><path fill="#565b95" d="M15 10A3.0001 3.0001 0 0 0 9.40234 8.499a.99981.99981 0 0 0 1.73047 1.002A1.00022 1.00022 0 1 1 12 11a.99943.99943 0 0 0-1 1v1a1 1 0 0 0 2 0v-.18433A2.99487 2.99487 0 0 0 15 10zM12 17a.9994.9994 0 0 1-.37988-.08008 1.14718 1.14718 0 0 1-.33008-.21 1.16044 1.16044 0 0 1-.21-.33008A.83154.83154 0 0 1 11 16a1.39038 1.39038 0 0 1 .01953-.2002.65026.65026 0 0 1 .06055-.17968.74157.74157 0 0 1 .08984-.18067A1.61105 1.61105 0 0 1 11.29 15.29a1.04667 1.04667 0 0 1 1.41992 0A1.0321 1.0321 0 0 1 13 16a.9994.9994 0 0 1-.08008.37988.90087.90087 0 0 1-.54.54A.9994.9994 0 0 1 12 17z"/></svg>
                                        <span class="fs-16 font-weight-semibold ms-2">{{$faqcategory->faqcategoryname}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--FAQ Section-->

@endif

@endsection

@section('scripts')

		<!--INTERNAL Owl-carousel js -->
		<script src="{{asset('assets/plugins/owl-carousel/owl-carousel.js')}}?v=<?php echo time(); ?>"></script>

		<!-- INTERNAL Index js-->
		<script src="{{asset('assets/js/support/support-landing.js')}}?v=<?php echo time(); ?>"></script>

		<!-- INTERNAL Index js-->
		<script src="{{asset('assets/plugins/jquery/jquery-ui.js')}}?v=<?php echo time(); ?>"></script>

		<script type="text/javascript">
			"use strict";

			(function($){

				// close the data search
				document.querySelector('.page-main').addEventListener('click', ()=>{
					$('#searchList').fadeOut();
					$('#searchList').html('');
				});

				// search the data
				$('#search_name').keyup(function () {

					var data = $(this).val();
					if (data != '') {
						var _token = $('input[name="_token"]').val();
						$.ajax({
							url: "{{ url('/search') }}",
							method: "POST",
							data: {data: data, _token: _token},

							dataType:"json",

							success: function (data) {

								$('#searchList').fadeIn();
								$('#searchList').html(data);
								const ps3 = new PerfectScrollbar('.sprukohomesearch', {
									useBothWheelAxes:true,
									suppressScrollX:true,
								});
							},
							error: function (data) {

							}
						});
					}
				});

			})(jQuery);

		</script>

@endsection

