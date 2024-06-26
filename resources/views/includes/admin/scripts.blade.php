		<!-- Back to top -->
		<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

		<!-- Bootstrap js-->
		<script src="{{asset('assets/plugins/bootstrap/popper.min.js')}}?v=<?php echo time(); ?>"></script>
		<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}?v=<?php echo time(); ?>"></script>

		<!--Sidemenu js-->
		<script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}?v=<?php echo time(); ?>"></script>

		<!-- P-scroll js-->
		<script src="{{asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}?v=<?php echo time(); ?>"></script>
		<script src="{{asset('assets/plugins/p-scrollbar/p-scroll1.js')}}?v=<?php echo time(); ?>"></script>

		<!-- Select2 js -->
		<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}?v=<?php echo time(); ?>"></script>

        <!--INTERNAL RATING js -->
        <script src="{{asset('assets/plugins/ratings/jquerystarrating.js')}}?v=<?php echo time(); ?>"></script>

        @yield('scripts')

		<!--INTERNAL Toastr js -->
		<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}?v=<?php echo time(); ?>"></script>


        <script type="text/javascript">

		    "use strict";

            @php echo customcssjs('CUSTOMJS') @endphp

            // Profile Rating
            $(".allprofilerating").starRating({
                readOnly: true,
                starSize    :  20,
                emptyColor  :  '#17263a',
                activeColor :  '#F2B827',
                strokeColor :  '#556a86',
                strokeWidth :  15,
                useGradient : false
            });

            @if(auth()->user())

            //  Mark As Read
            function sendMarkRequest(id = null) {
                return $.ajax("{{ route('admin.markNotification') }}", {
                    method: 'GET',
                    data: {
                        // _token,
                        id
                    }
                });
            }
            (function($) {

                $('.mark-as-read').on('click', function() {
                    let request = sendMarkRequest($(this).data('id'));
                    request.done(() => {
                        $(this).parents('div.alert').remove();
                    });
                });
                $('.smark-all').on('click', function() {

                    let request = sendMarkRequest();
                    request.done(() => {
                        $('div.alert').remove();
                    })
                });

                $('body').on('click', '.mark-read', function(e){
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: '{{route('admin.notify.markallread')}}',
                        success: function (data) {
                            location.reload();
                        },
                        error: function (data) {
                        console.log('Error:', data);
                        }
                    });
                });

                // Clear Cache
                $('body').on('click', '.sprukoclearcache', function(e){
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: '{{route('admin.clearcache')}}',
                        success: function (data) {

                            toastr.success(data.success);
                            location.reload();
                        },
                        error: function (data) {
                        console.log('Error:', data);
                        }
                    });
                });


            })(jQuery);
            @endif

            // Csrf Field
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

            let playAudio = ()=>{
                let audio = new Audio();
                audio.src = "../assets/sounds/norifysound.mp3";
                audio.load();
                audio.play();
            }


            setInterval( function() {

                $.ajax({
                    url: "{{route('update.notificationalerts')}}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        $.map( res, function( value, index ) {
                            if(index === 0){
                                toastr.success('{{lang("You have")}} '+ res.length +' {{lang("new notification")}}');
                                readnotify();
                                playAudio();
                            }

                        });
                    }
                });

                notificationsreading();
                badgecount();
                markasreadcount();
            }, 5000);

            function readnotify(){

                $.ajax({
                    url: "{{route('update.notificationalertsread')}}",
                    type: 'post',
                    dataType: 'json',
                    success: function(res) {

                    }
                });
            }

            $('#notifyreading').load('{{route('notificationsreading')}}')

            function notificationsreading()
            {

                $('#notifyreading').load('{{route('notificationsreading')}}')

            }
            function badgecount()
            {

                $('#badgecount').load('{{route('badgecount')}}')

            }
            function markasreadcount()
            {

                $('#markasreadcount').load('{{route('markasreadcount')}}')

            }

        </script>

        <!-- Custom html js-->
		<script src="{{asset('assets/js/custom.js')}}?v=<?php echo time(); ?>"></script>

