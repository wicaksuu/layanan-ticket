@extends('layouts.usermaster')

@section('styles')

<!-- INTERNAL Data table css -->
<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/responsive.bootstrap5.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

@endsection

@section('content')

<!-- Section -->
<section>
    <div class="bannerimg cover-image" data-bs-image-src="{{asset('assets/images/photos/banner1.jpg')}}">
        <div class="header-text mb-0">
            <div class="container ">
                <div class="row text-white">
                    <div class="col">
                        <h1 class="mb-0">{{lang('Active Tickets', 'menu')}}</h1>
                    </div>
                    <div class="col col-auto">
                        <ol class="breadcrumb text-center">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-white-50">{{lang('Home', 'menu')}}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#" class="text-white">{{lang('Active Tickets', 'menu')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section -->

<!--Active Ticket List-->
<section>
    <div class="cover-image sptb">
        <div class="container ">
            <div class="row">
                @include('includes.user.verticalmenu')

                <div class="col-xl-9">
                    <div class="card mb-0">
                        <div class="card-header border-0">
                            <h4 class="card-title">{{lang('Active Tickets', 'menu')}}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                @if(setting('CUSTOMER_RESTICT_TO_DELETE_TICKET') == 'off')
                                    <button id="massdelete" class="btn btn-outline-light btn-sm ms-7 mb-4 data-table-btn mx-md-center"><i class="fe fe-trash me-1"></i> {{lang('Delete')}}</button>
                                @endif
                                <table
                                    class="table table-bordered border-bottom text-nowrap ticketdeleterow w-100"
                                    id="activeticket">
                                    <thead>
                                        <tr class="">
                                            <th >{{lang('Sl.No')}}</th>
                                            <th width="10" class="removecolumnheader">
                                                <input type="checkbox"  id="customCheckAll">
                                                <label  for="customCheckAll"></label>
                                            </th>
                                            <th >{{lang('Ticket Details')}}</th>
                                            <th >{{lang('Status')}}</th>
                                            <th >{{lang('Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($activetickets as $activeticket)
                                            <tr {{$activeticket->replystatus == 'Waiting'? 'class=bg-success-transparent': ''}}>
                                                <td>{{$i++}}</td>
                                                <td class="removecolumndata">
                                                    <input type="checkbox" name="student_checkbox[]" class="checkall" value="{{$activeticket->id}}" />
                                                </td>
                                                <td class="overflow-hidden ticket-details">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <a href="{{route('loadmore.load_data',$activeticket->ticket_id)}}" class="fs-14 d-block font-weight-semibold">{{$activeticket->subject}}</a>

                                                            <ul class="fs-13 font-weight-normal d-flex custom-ul">
                                                                <li class="pe-2 text-muted">#{{$activeticket->ticket_id}}</span>
                                                                <li class="px-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Date')}}"><i class="fe fe-calendar me-1 fs-14"></i> {{$activeticket->created_at->timezone(Auth::user()->timezone)->format(setting('date_format'))}}</li>

                                                                @if($activeticket->priority != null)
                                                                    @if($activeticket->priority == "Low")
                                                                        <li class="ps-5 pe-2 preference preference-low" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Priority')}}">{{lang($activeticket->priority)}}</li>

                                                                    @elseif($activeticket->priority == "High")
                                                                        <li class="ps-5 pe-2 preference preference-high" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Priority')}}">{{lang($activeticket->priority)}}</li>

                                                                    @elseif($activeticket->priority == "Critical")
                                                                        <li class="ps-5 pe-2 preference preference-critical" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Priority')}}">{{lang($activeticket->priority)}}</li>

                                                                    @else
                                                                        <li class="ps-5 pe-2 preference preference-medium" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Priority')}}">{{lang($activeticket->priority)}}</li>
                                                                    @endif
                                                                @else
                                                                    ~
                                                                @endif

                                                                @if($activeticket->category_id != null)
                                                                    @if($activeticket->category != null)

                                                                    <li class="px-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Category')}}"><i class="fe fe-grid me-1 fs-14" ></i>{{Str::limit($activeticket->category->name, '40')}}</li>

                                                                    @else

                                                                    ~
                                                                    @endif
                                                                @else

                                                                    ~
                                                                @endif

                                                                @if($activeticket->last_reply == null)
                                                                    <li class="px-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Last Replied')}}"><i class="fe fe-clock me-1 fs-14"></i>{{$activeticket->created_at->diffForHumans()}}</li>

                                                                @else
                                                                <li class="px-2 text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="{{lang('Last Replied')}}"><i class="fe fe-clock me-1 fs-14"></i>{{$activeticket->last_reply->diffForHumans()}}</li>

                                                                @endif

                                                                @if($activeticket->purchasecodesupport != null)
                                                                @if($activeticket->purchasecodesupport == 'Supported')

                                                                <li class="px-2 text-success font-weight-semibold">{{lang('Support Active')}}</li>
                                                                @if($activeticket->purchasecodesupport == 'Expired')

                                                                <li class="px-2 text-danger-dark font-weight-semibold">{{lang('Support Expired')}}</li>
                                                                @endif
                                                                @endif
                                                                @endif

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($activeticket->status == "New")

                                                    <span class="badge badge-burnt-orange">{{lang($activeticket->status)}}</span>

                                                    @elseif($activeticket->status == "Re-Open")

                                                    <span class="badge badge-teal">{{lang($activeticket->status)}}</span>

                                                    @elseif($activeticket->status == "Inprogress")

                                                    <span class="badge badge-info">{{lang($activeticket->status)}}</span>

                                                    @elseif($activeticket->status == "On-Hold")

                                                    <span class="badge badge-warning">{{lang($activeticket->status)}}</span>

                                                    @else

                                                    <span class="badge badge-danger">{{lang($activeticket->status)}}</span>

                                                    @endif
                                                </td>
                                                <td>
                                                    <div class = "d-flex">
                                                        <a href="{{route('loadmore.load_data',$activeticket->ticket_id)}}" class="action-btns1" data-bs-toggle="tooltip" data-placement="top" title="{{lang('View Ticket')}}"><i class="feather feather-edit text-primary"></i></a>
                                                        @if(setting('CUSTOMER_RESTICT_TO_DELETE_TICKET') == 'off')
                                                            <a href="javascript:void(0)" class="action-btns1" data-id="{{$activeticket->id}}" id="show-delete" data-bs-toggle="tooltip" data-placement="top" title="{{lang('Delete Ticket')}}"><i class="feather feather-trash-2 text-danger"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Active Ticket List-->

@endsection

@section('scripts')

<!-- INTERNAL Data tables -->
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}?v=<?php echo time(); ?>"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}?v=<?php echo time(); ?>"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}?v=<?php echo time(); ?>"></script>
<script src="{{asset('assets/plugins/datatable/responsive.bootstrap5.min.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL Index js-->
<script src="{{asset('assets/js/support/support-sidemenu.js')}}?v=<?php echo time(); ?>"></script>
<script src="{{asset('assets/js/support/support-admindash.js')}}?v=<?php echo time(); ?>"></script>



<script type="text/javascript">
    "use strict";

    var complex = <?php echo json_encode(setting('CUSTOMER_RESTICT_TO_DELETE_TICKET')); ?>;
    if(complex == 'on'){
        setTimeout(myGreeting, 1)
            function myGreeting() {
                document.querySelector(".removecolumnheader").remove()
                document.querySelectorAll(".removecolumndata").forEach((res)=>{
                res.remove()
            })
        }

    }

    // Variables
    var SITEURL = '{{url('')}}';

    (function($){

        // Csrf Field
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //________ Data Table
        // $('#activeticket').DataTable({
        //     language: {
        //         searchPlaceholder: search,
        //         scrollX: "100%",
        //         sSearch: '',
        //     },
        //     order:[],
        //     columnDefs: [
        //         { "orderable": false, "targets":[ 0,1,4] }
        //     ],

        // });

        let prev = {!! json_encode(lang("Previous")) !!};
        let next = {!! json_encode(lang("Next")) !!};
        let nodata = {!! json_encode(lang("No data available in table")) !!};
        let noentries = {!! json_encode(lang("No entries to show")) !!};
        let showing = {!! json_encode(lang("showing page")) !!};
        let ofval = {!! json_encode(lang("of")) !!};
        let maxRecordfilter = {!! json_encode(lang("- filtered from ")) !!};
        let maxRecords = {!! json_encode(lang("records")) !!};
        let entries = {!! json_encode(lang("entries")) !!};
        let show = {!! json_encode(lang("Show")) !!};
        let search = {!! json_encode(lang("Search...")) !!};
        // Datatable
        $('#activeticket').dataTable({
            language: {
                searchPlaceholder: search,
                scrollX: "100%",
                sSearch: '',
                paginate: {
                previous: prev,
                next: next
                },
                emptyTable : nodata,
                infoFiltered: `${maxRecordfilter} _MAX_ ${maxRecords}`,
                info: `${showing} _PAGE_ ${ofval} _PAGES_`,
                infoEmpty: noentries,
                lengthMenu: `${show} _MENU_ ${entries} `,
            },
            order:[],
            columnDefs: [
                { "orderable": false, "targets":[ 0,1,4] }
            ],
        });

        // Delete Button
        $('body').on('click', '#show-delete', function () {
            var _id = $(this).data("id");
            swal({
                title: `{{lang('Are you sure you want to continue?', 'alerts')}}`,
                text: "{{lang('This might erase your records permanently', 'alerts')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "get",
                        url: SITEURL + "/customer/ticket/delete/"+_id,
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

        //Mass Delete
        $('body').on('click', '#massdelete', function () {
            var id = [];
            $('.checkall:checked').each(function(){
                id.push($(this).val());
            });
            if(id.length > 0){
                swal({
                    title: `{{lang('Are you sure you want to continue?', 'alerts')}}`,
                    text: "{{lang('This might erase your records permanently', 'alerts')}}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url:"{{ url('customer/ticket/delete/tickets')}}",
                            method:"post",
                            data:{id:id},
                            success:function(data)
                            {
                                toastr.success(data.success);
                                location.reload();

                            },
                            error:function(data){

                            }
                        });
                    }
                });

            }else{
                toastr.error('{{lang('Please select at least one check box.', 'alerts')}}');
            }

        });

        // Check All Checkbox
        $('#customCheckAll').on('click', function() {
            $('.checkall').prop('checked', this.checked);
        });

        $('.form-select').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('#customCheckAll').prop('checked', false);
        $('.checkall').on('click', function(){
            if($('.checkall:checked').length == $('.checkall').length){
                $('#customCheckAll').prop('checked', true);
            }else{
                $('#customCheckAll').prop('checked', false);
            }
        });

    })(jQuery);

</script>

@endsection
