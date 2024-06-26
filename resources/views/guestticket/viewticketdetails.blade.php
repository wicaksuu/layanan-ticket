
@extends('layouts.usermaster')


		@section('content')

		<!-- Section -->
		<section>
			<div class="bannerimg cover-image" data-bs-image-src="{{asset('assets/images/photos/banner1.jpg')}}">
				<div class="header-text mb-0">
					<div class="container">
						<div class="row text-white">
							<div class="col">
								<h1 class="mb-0">{{lang('Guest View')}}</h1>
							</div>
							<div class="col col-auto">
								<ol class="breadcrumb text-center">
									<li class="breadcrumb-item">
										<a href="#" class="text-white-50">{{lang('Home', 'menu')}}</a>
									</li>
									<li class="breadcrumb-item active">
										<a href="#" class="text-white">{{lang('Guest View')}}</a>
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
						<div class="col-md-6 justify-content-center mx-auto text-center">

                            <div class="card">
                                <div class="card-body p-8 text-center">
                                    <img src="{{asset('assets/images/svgs/check.svg')}}" alt="img" class="w-10">
                                    <h6 class="mt-5 fs-20 leading-normal">{{lang('Thank you for submitting your ticket to us. Your tickets are always our top priority. You are submitting a guest ticket.')}}</h6>
                                    <p class="mt-3 mb-5 fs-16"> {{lang('Please register your account with us to access more features.')}} </p>
                                    <a class="btn ripple btn-primary" href="{{route('gusetticket',$ticket->ticket_id)}}">{{lang('View Ticket')}}</a>
								</div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</section>
		<!--Section-->

		@endsection


