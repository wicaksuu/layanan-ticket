@extends('layouts.adminmaster')

@section('styles')

<!-- INTERNAl Summernote css -->
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote.css')}}?v=<?php echo time(); ?>">

<!-- INTERNAL Data table css -->
<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/responsive.bootstrap5.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

<!-- INTERNAL Sweet-Alert css -->
<link href="{{asset('assets/plugins/sweet-alert/sweetalert.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />
@endsection

@section('content')

<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title"><span class="font-weight-normal text-muted ms-2">{{lang('FAQ’s', 'menu')}}</span></h4>
    </div>
</div>
<!--End Page header-->

<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card ">
        <div class="card-header border-0">
			<h4 class="card-title">{{lang('Edit FAQ’s', 'menu')}}</h4>
            @if(setting('enable_gpt') == 'on')
                <button class="btn btn-primary ms-auto" id="gptmodal" data-target="#exampleModal234">{{ lang('Ask Chat GPT') }}</button>
            @endif
		</div>
        <form action="{{route('faq.store')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="faq_id" id="faq_id" value="{{$faq->id}}">
            @csrf
            @honeypot
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">{{lang('Question')}} <span class="text-red">*</span></label>
                    <input type="text" class="form-control @error('question') is-invalid @enderror" placeholder="{{lang('FAQ Question')}}" name="question" id="question" value="{{$faq->question}}" autofocus required>
                    @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ lang($message) }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">{{lang('Answer')}} <span class="text-red">*</span></label>
                    <textarea class="summernote d-none @error('answer') is-invalid @enderror" placeholder="{{lang('FAQ Answer')}}" name="answer" id="answer" aria-multiline="true">{{$faq->answer}}</textarea>
                    @error('answer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ lang($message) }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">{{lang('Select Faq Category')}} <span class="text-red">*</span></label>
                    <!-- <select name="faqcat_name" class="form-control form-select" id="faqcat_name" data-placeholder="{{lang('Select Faq Category')}}"> -->
                    <select class="form-control select2-show-search  select2 @error('faqcatsname') is-invalid @enderror" data-placeholder="{{lang('Select Faq Category')}}" name="faqcatsname" id="faqcatsname">
                        @foreach($faqcategorys as $faqcategory)
                            <option></option>
                            <option value="{{$faqcategory->id}}" @if ($faqcategory->id == $faq->faqcat_id) selected @endif >{{$faqcategory->faqcategoryname}}</option>
                        @endforeach
                    </select>
                    @error('faqcatsname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ lang($message) }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="switch_section">
                        <div class="switch-toggle d-flex mt-4">
                            <label class="form-label pe-2">{{lang('Status')}}</label>
                            <a class="onoffswitch2">
                                <input type="checkbox"  name="status" id="status" class=" toggle-class onoffswitch2-checkbox" {{ $faq->status == 1 ? 'checked' : '' }}>
                                <label for="status" class="toggle-class onoffswitch2-label" ></label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="custom-control form-checkbox">
                        <input type="checkbox" class="custom-control-input" name="privatemode" id="privatemode"  {{ $faq->privatemode == 1 ? 'checked' : '' }}>
                        <span class="custom-control-label">{{lang('Privacy Mode')}}</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-outline-danger" id="btnclose" onclick="cancelPost()" data-bs-dismiss="modal">{{lang('Close')}}</a>
                <button type="submit" class="btn btn-secondary">{{lang('Save')}}</button>
            </div>
        </form>
    </div>
</div>


@if(setting('enable_gpt') == 'on')
    <!-- GPT Model-->
    <div class="modal fade"  id="addgptmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ lang('Ask Chat GPT') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    @csrf
                    @honeypot
                    <div class="modal-body pb-0 position-relative">
                        <div class="form-group">
                            <label class="form-label">{{lang('Type your query here')}}</label>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control" placeholder="Enter Here" name="" id="spk_gpt">
                                <input type="button" class="btn btn-secondary" id="priority_form1"  value="{{lang('Generate Text')}}">
                            </div>
                            <span class="invalid-feedback d-block mt-4" role="alert">
                                <strong id="error-message-gpt"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="gap-2 mt-sm-0 mt-3 me-2 position-absolute open-pen d-none" id="loader-gpt">
                        <div class="px-1 py-1 d-flex align-items-center">
                            <span class="avatar text-muted me-0 bg-transparent" style="background-image: url(&quot;{{asset('assets/images/typing.gif')}}&quot;);">
                            </span>
                        </div>
                    </div>

                    <div class="modal-body pt-0">
                        <div class="form-group" id="main-gpt">
                            <div id="textares-gpt">
                                <label class="form-label">{{lang('Generated text')}}</label>
                                <div class="" >
                                    <div class="form-control openanswer" name="" id="answershow" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="ms-0 btn btn-primary d-none" name="" id="copytoresponse-gpt" data-bs-dismiss="modal" value="{{ lang('Copy Response') }}">
                        <a href="#" class="btn btn-outline-danger" data-bs-dismiss="modal">{{lang('Close')}}</a>
                    </div>
            </div>
        </div>
    </div>
    <!-- GPT Model end -->
@endif

@endsection

@section('modal')

@endsection

@section('scripts')

<!-- INTERNAL Vertical-scroll js-->
<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}"></script>

<!-- INTERNAL Summernote js  -->
<script src="{{asset('assets/plugins/summernote/summernote.js')}}"></script>

<!-- INTERNAL Data tables -->
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>

<!-- INTERNAL Index js-->
<script src="{{asset('assets/js/support/support-sidemenu.js')}}"></script>
<script src="{{asset('assets/js/support/support-articles.js')}}"></script>

<!-- INTERNAL Sweet-Alert js-->
<script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>

<script type="text/javascript">

    "use strict";

    (function($)  {

        // Variables
        var SITEURL = '{{url('')}}';

        // Csrf Field
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
        $('#support-articlelists').dataTable({
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

        $('body').on('click', '#gptmodal', function(){
            $('#spk_gpt').val('');
            $('#answershow').html('');
            $('#addgptmodal').modal('show');
            document.getElementById("copytoresponse-gpt").classList.add("d-none")
        });

    })(jQuery);

</script>

<script type="module">
    import openai from "{{asset('assets/js/openapi/openapi.min.js')}}"

    if(document.getElementById("priority_form1")){
        //Chat GPT
        if(document.getElementById("priority_form1")){
            document.getElementById("priority_form1").disabled = true
        }

        var i

        if(document.getElementById("spk_gpt")){
            ['click','keyup'].forEach( evt =>
                document.getElementById("spk_gpt").addEventListener(evt,(ele)=>{
                    i = ele.target.value
                    if(i.length){
                        document.getElementById("priority_form1").disabled = false
                    }
                    else{
                        document.getElementById("priority_form1").disabled = true
                    }
                })
            );

        }



        document.getElementById("priority_form1").onclick = ()=>{
            if(i){
                // copytoresponse button
                document.getElementById("copytoresponse-gpt").classList.add("d-none")
                // End copytoresponse button

                // Loader
                document.getElementById("loader-gpt").classList.remove("d-none")
                //End Loader


                // text area

                //Adding the text area
                document.getElementById("answershow").innerText  = ""
                //End Adding the text area

                var aaaa;
                aaaa = {!! json_encode(setting('openai_api')) !!}

                const configuration = new openai.Configuration({
                    apiKey: aaaa,
                });
                const Openai = new openai.OpenAIApi(configuration);
                const main = async ()=>{
                    const question = i
                    const completion = await Openai.createCompletion({
                        model: "text-davinci-003",
                        prompt: question,
                        max_tokens:2048,
                        temperature:1
                    })
                    return completion.data.choices[0].text
                }
                let responce = main()

                responce.then((data)=>{

                    // Loader
                    document.getElementById("loader-gpt").classList.add("d-none")
                    //End Loader

                    //Adding the text area

                    document.getElementById("answershow").innerText  = data

                    // Adding the Copy Response
                    document.getElementById("copytoresponse-gpt").classList.remove("d-none")

                    //copytoresponse Button event
                    document.getElementById("copytoresponse-gpt").addEventListener("click",()=>{
                        document.querySelector(".note-editable").innerText = `${data}`
                        document.querySelector(".summernote").innerHTML = `${data}`
                    })
                })

                responce.catch((error)=>{
                    //To add The Error Message
                    document.getElementById("error-message-gpt").innerText = error?.response.data.error.message
                    //End To add The Error Message


                    // Loader
                    document.getElementById("loader-gpt").classList.add("d-none")
                    //End Loader

                    // copytoresponse button
                    document.getElementById("copytoresponse-gpt").classList.add("d-none")
                    // End copytoresponse button

                })
            }
            else{
                toastr.error('Please enter somthing!');
                document.getElementById("priority_form1").disabled = true
            }
        }
    }

</script>

@endsection
