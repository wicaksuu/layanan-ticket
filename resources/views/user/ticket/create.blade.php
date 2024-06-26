@extends('layouts.usermaster')

@section('styles')


<!-- INTERNAl Summernote css -->
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote.css')}}?v=<?php echo time(); ?>">

<!-- INTERNAl DropZone css -->
<link href="{{asset('assets/plugins/dropzone/dropzone.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

<link href="{{asset('assets/plugins/wowmaster/css/animate.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

@endsection

@section('content')

<!-- Section -->
<section>
    <div class="bannerimg cover-image" data-bs-image-src="{{asset('assets/images/photos/banner1.jpg')}}">
        <div class="header-text mb-0">
            <div class="container ">
                <div class="row text-white">
                    <div class="col">
                        <h1 class="mb-0">{{lang('Create Ticket', 'menu')}}</h1>
                    </div>
                    <div class="col col-auto">
                        <ol class="breadcrumb text-center">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}" class="text-white-50">{{lang('Home', 'menu')}}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#" class="text-white">{{lang('Create Ticket', 'menu')}}</a>
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
        <div class="container ">
            <div class="row">
                @include('includes.user.verticalmenu')

                <div class="col-xl-9">
                    @if (setting('envato_on') == 'on')
                        <div class="alert alert-danger mb-5 br-13 align-center d-none" role="alert" id="expired_note">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill mb-1 me-1" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            {{lang('Support Expired: Your support has expired. In order to continue receiving our assistance, please renew your support.')}}
                            <a class="btn-sm btn btn-dark" href="{{ setting('SUPPORT_POLICY_URL') }}" target="_blank">{{lang('Support Policy')}}</a>
                            <a class="btn-sm btn btn-dark" href="https://help.market.envato.com/hc/en-us/articles/207886473-Extending-and-Renewing-Item-Support" target="_blank">{{lang('How To Renew Item Support')}}</a>
                        </div>
                    @endif
                    @if (setting('envato_on') == 'on')
                        <div class="alert alert-warning mb-5 br-13 align-center d-none" role="alert" id="expired_note123">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill mb-1 me-1" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            {{lang('Your purchase code has been verified, but product support has expired.')}}
                            <a class="btn-sm btn btn-dark" href="{{ setting('SUPPORT_POLICY_URL') }}" target="_blank">{{lang('Support Policy')}}</a>
                            <a class="btn-sm btn btn-dark" href="https://help.market.envato.com/hc/en-us/articles/207886473-Extending-and-Renewing-Item-Support" target="_blank">{{lang('How To Renew Item Support')}}</a>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header  border-0">
                            <h4 class="card-title">{{lang('New Ticket')}}</h4>
                        </div>
                        <form method="POST" id="user_form" enctype="multipart/form-data">

                            @honeypot

                            <div class="card-body">
                                @if(setting('cc_email') == 'on')
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{lang('CC')}} </label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control @error('ccmail') is-invalid @enderror" placeholder="{{lang('CC Email')}}" value="{{ old('ccmail') }}" name="ccmail" id="ccmail">
                                                <div><small class="text-muted"> {{lang('You are allowed to send only a single CC.')}}</small></div>
                                                <span id="ccEmailError" class="text-danger alert-message" ></span>
                                                @error('ccmail')

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ lang($message) }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{lang('Subject')}} <span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" id="subject" maxlength="{{setting('TICKET_CHARACTER')}}"
                                                class="form-control @error('subject') is-invalid @enderror"
                                                placeholder="{{lang('Subject')}}" name="subject" value="{{ old('subject') }}">
                                                <small class="text-muted float-end mt-1" id="subjectmaxtext">{{lang('Maximum')}} <b>{{setting('TICKET_CHARACTER')}}</b> {{lang('Characters')}}</small>
                                                <div>
                                                    <span id="SubjectError" class="text-danger alert-message"></span>
                                                </div>
                                            @error('subject')

                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ lang($message) }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{lang('Category')}} <span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <select
                                                class="form-control select2-show-search  select2 @error('category') is-invalid @enderror"
                                                data-placeholder="{{lang('Select Category')}}" name="category" id="category">
                                                <option label="{{lang('Select Category')}}"></option>
                                                @foreach ($categories as $category)

                                                <option value="{{ $category->id }}" @if(old('category')) selected @endif>{{ $category->name }}</option>
                                                @endforeach

                                            </select>
                                            <span id="CategoryError" class="text-danger alert-message"></span>
                                            @error('category')

                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ lang($message) }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="selectssSubCategory" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{lang('SubCategory')}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select  class="form-control select2-show-search select2"  data-placeholder="{{lang('Select SubCategory')}}" name="subscategory" id="subscategory">

                                            </select>
                                            <span id="subsCategoryError" class="text-danger alert-message"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group" id="selectSubCategory">
                                </div>
                                <div class="form-group" id="envatopurchase">
                                </div>
                                @if($customfields->isNotEmpty())
                                    @foreach($customfields as $customfield)

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">{{$customfield->fieldnames}}
                                                    @if($customfield->fieldrequired == '1')

                                                    <span class="text-red">*</span>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-md-9">

                                                @if($customfield->fieldtypes == 'text')

                                                    <input type="{{$customfield->fieldtypes}}" maxlength="255" class="form-control" name="custom_{{$customfield->id}}" id="" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                                                @endif
                                                @if($customfield->fieldtypes == 'email')

                                                    <input type="{{$customfield->fieldtypes}}" class="form-control" name="custom_{{$customfield->id}}" id="" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                                                @endif
                                                @if($customfield->fieldtypes == 'textarea')

                                                    <textarea name="custom_{{$customfield->id}}" maxlength="255" class="form-control" id="" cols="30" rows="4" {{$customfield->fieldrequired == '1' ? 'required' : ''}}></textarea>
                                                @endif
                                                @if($customfield->fieldtypes == 'checkbox')

                                                    @php
                                                        $coptions = explode(',', $customfield->fieldoptions)
                                                    @endphp
                                                    @foreach($coptions as $key => $coption)
                                                    <label class="custom-control custom-checkbox d-inline-block me-3">
                                                        <input type="{{$customfield->fieldtypes}}" class="custom-control-input {{$customfield->fieldrequired == '1' ? 'required' : ''}}"  name="custom_{{$customfield->id}}[]" value="{{$coption}}" id="" >

                                                        <span class="custom-control-label">{{$coption}}</span>
                                                    </label>

                                                    @endforeach


                                                @endif
                                                @if($customfield->fieldtypes == 'select')
                                                    <select name="custom_{{$customfield->id}}" id="" class="form-control select2-show-search" data-placeholder="{{lang('Select')}}" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                                                        @php
                                                            $seoptions = explode(',', $customfield->fieldoptions)
                                                        @endphp
                                                        <option></option>
                                                        @foreach($seoptions as $seoption)

                                                        <option value="{{$seoption}}">{{$seoption}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @if($customfield->fieldtypes == 'radio')
                                                @php
                                                    $roptions = explode(',', $customfield->fieldoptions)
                                                @endphp
                                                @foreach($roptions as $roption)
                                                <label class="custom-control custom-radio d-inline-block me-3">
                                                    <input type="{{$customfield->fieldtypes}}" class="custom-control-input" name="custom_{{$customfield->id}}" value="{{$roption}}" {{$customfield->fieldrequired == '1' ? 'required' : ''}}>
                                                    <span class="custom-control-label">{{$roption}}</span>
                                                </label>


                                                @endforeach

                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                @endif
                                <div class="form-group ticket-summernote ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{lang('Description')}} <span class="text-red">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="summernote form-control @error('message') is-invalid @enderror"
                                                name="message" rows="4" cols="400">{{old('message')}}</textarea>
                                            <span id="MessageError" class="text-danger alert-message"></span>
                                            @error('message')

                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ lang($message) }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                @if(setting('USER_FILE_UPLOAD_ENABLE') == 'yes')

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label mb-0 mt-2">{{lang('Upload File')}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group mb-0">
                                                <div class="needsclick dropzone" id="document-dropzone">
                                                </div>
                                                <small class="text-muted"><i>{{lang('The file size should not be more than', 'filesetting')}} {{setting('FILE_UPLOAD_MAX')}}{{lang('MB', 'filesetting')}}</i></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group @error('agree_terms') is-invalid @enderror">
                                    <label class="custom-control form-checkbox">
                                        <input type="checkbox" class="custom-control-input " value="agreed" name="agree_terms">
                                        <span class="custom-control-label">{{lang('I agree with')}}<a href="{{setting('terms_url')}}" class="text-primary">{{lang('Terms & Services')}}</a></span>
                                    </label>
                                    <span class="text-red" id="agreetermsError"></span>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="form-group float-end">
                                    <button type="submit" class="btn btn-secondary btn-lg purchasecode" id="createticketbtn">{{lang('Create Ticket')}}</button>
                                </div>
                            </div>
                        </form>
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
<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL Summernote js  -->
<script src="{{asset('assets/plugins/summernote/summernote.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL Index js-->
<script src="{{asset('assets/js/support/support-sidemenu.js')}}?v=<?php echo time(); ?>"></script>
<script src="{{asset('assets/js/select2.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL Dropzone js-->
<script src="{{asset('assets/plugins/dropzone/dropzone.js')}}?v=<?php echo time(); ?>"></script>

<!-- wowmaster js-->
<script src="{{asset('assets/plugins/wowmaster/js/wow.min.js')}}?v=<?php echo time(); ?>"></script>

<!-- INTERNAL Bootstrap-MaxLength js-->
<script src="{{asset('assets/plugins/bootstrapmaxlength/bootstrap-maxlength.min.js')}}?v=<?php echo time(); ?>"></script>

<script type="text/javascript">
    "use strict";

    var licensekey;

    (function($){

        // Variables
        var SITEURL = '{{url('')}}';

        // Csrf Field
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Category list
        $('select[name="project_id"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: SITEURL +'/customer/subcat/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="category"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="category"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="project_id"]').empty();
            }
        });

        // when category change its get the subcat list
        $('#category').on('change',function(e) {
            var cat_id = e.target.value;
            $('#selectssSubCategory').hide();
            $.ajax({
                url:"{{ route('guest.subcategorylist') }}",
                type:"POST",
                    data: {
                    cat_id: cat_id
                    },
                    cache : false,
                    async: true,
                success:function (data) {
                    console.log(data);
                    if(data.subcategoriess != ''){
                        $('#subscategory').html(data.subcategoriess)
                        $('#selectssSubCategory').show()
                    }
                    else{
                        $('#selectssSubCategory').hide();
                        $('#subscategory').html('')
                    }
                    //projectlist
                    if(data.subcategories.length >= 1){

                        $('#subcategory')?.empty();
                        $('#selectSubCategory .row')?.remove();
                        let selectDiv = document.querySelector('#selectSubCategory');
                        let Divrow = document.createElement('div');
                        Divrow.setAttribute('class','row mt-4');
                        let Divcol3 = document.createElement('div');
                        Divcol3.setAttribute('class','col-md-3');
                        let selectlabel =  document.createElement('label');
                        selectlabel.setAttribute('class','form-label mb-0 mt-2')
                        selectlabel.innerText = "{{lang('Project')}}";
                        let divcol9 = document.createElement('div');
                        divcol9.setAttribute('class', 'col-md-9');
                        let selecthSelectTag =  document.createElement('select');
                        selecthSelectTag.setAttribute('class','form-control select2-show-search');
                        selecthSelectTag.setAttribute('id', 'subcategory');
                        selecthSelectTag.setAttribute('name', 'project');
                        selecthSelectTag.setAttribute('data-placeholder','Select Projects');
                        let selectoption = document.createElement('option');
                        selectoption.setAttribute('label','Select Projects')
                        selectDiv.append(Divrow);
                        Divrow.append(Divcol3);
                        Divcol3.append(selectlabel);
                        divcol9.append(selecthSelectTag);
                        selecthSelectTag.append(selectoption);
                        Divrow.append(divcol9);
                        $('.select2-show-search').select2();
                        $.each(data.subcategories,function(index,subcategory){
                        $('#subcategory').append('<option value="'+subcategory.name+'">'+subcategory.name+'</option>');
                        })
                    }
                    else{
                        $('#subcategory')?.empty();
                        $('#selectSubCategory .row')?.remove();
                    }
                    @if(setting('ENVATO_ON') == 'on')
                    //Envato Access
                    if(data.envatosuccess.length >= 1){
                        $('#envato_id')?.empty();
                        $('#envatopurchase .row')?.remove();
                        let selectDiv = document.querySelector('#envatopurchase');
                        let Divrow = document.createElement('div');
                        Divrow.setAttribute('class','row mt-4');
                        let Divcol3 = document.createElement('div');
                        Divcol3.setAttribute('class','col-md-3');
                        let selectlabel =  document.createElement('label');
                        selectlabel.setAttribute('class','form-label mb-0 mt-2')
                        selectlabel.innerHTML = "Envato Purchase Code <span class='text-red'>*</span>";
                        let divcol9 = document.createElement('div');
                        divcol9.setAttribute('class', 'col-md-9');
                        let selecthSelectTag =  document.createElement('input');
                        selecthSelectTag.setAttribute('class','form-control');
                        selecthSelectTag.setAttribute('type','search');
                        selecthSelectTag.setAttribute('id', 'envato_id');
                        selecthSelectTag.setAttribute('name', 'envato_id');
                        selecthSelectTag.setAttribute('placeholder', 'Enter Your Purchase Code');
                        let selecthSelectInput =  document.createElement('input');
                        selecthSelectInput.setAttribute('type','hidden');
                        selecthSelectInput.setAttribute('id', 'envato_support');
                        selecthSelectInput.setAttribute('name', 'envato_support');
                        selectDiv.append(Divrow);
                        Divrow.append(Divcol3);
                        Divcol3.append(selectlabel);
                        divcol9.append(selecthSelectTag);
                        divcol9.append(selecthSelectInput);
                        Divrow.append(divcol9);
                        $('.purchasecode').attr('disabled', true);

                    }else{
                        $('#envato_id')?.empty();
                        $('#envatopurchase .row')?.remove();
                        $('.purchasecode').removeAttr('disabled');
                    }
                    @endif
                },
                error:(data)=>{

                }
            });
        });

        @php $module = Module::all(); @endphp

        @if(in_array('Uhelpupdate', $module))


        // Purchase Code Validation
        $("body").on('keyup', '#envato_id', function() {
            let value = $(this).val();
            if (value != '') {
                if(value.length == '36'){
                    var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('guest.envatoverify') }}",
                    method: "POST",
                    data: {data: value, _token: _token},

                    dataType:"json",

                    success: function (data) {
                        if(data.valid == 'true'){
                            $('#envato_id').addClass('is-valid');
                            $('#envato_id').attr('readonly', true);
                            $('.purchasecode').removeAttr('disabled');
                            $('#envato_id').css('border', '1px solid #02f577');
                            $('#envato_support').val('Supported');
                            $('#expired_note').addClass('d-none');
                            licensekey = data.key
                            toastr.success(data.message);
                        }
                        if(data.valid == 'expried'){
                            @if(setting('ENVATO_EXPIRED_BLOCK') == 'on')

                            $('.purchasecode').attr('disabled', true);
                            $('#envato_id').css('border', '1px solid #e13a3a');
                            $('#envato_support').val('Expired');
                            $('#expired_note').removeClass('d-none');
                            toastr.error(data.message);
                            @endif
                            @if(setting('ENVATO_EXPIRED_BLOCK') == 'off')
                            $('#envato_id').addClass('is-valid');
                            $('#envato_id').attr('readonly', true);
                            $('.purchasecode').removeAttr('disabled');
                            $('#envato_id').css('border', '1px solid #02f577');
                            $('#expired_note123').removeClass('d-none');
                            $('#envato_support').val('Expired');
                            licensekey = data.key
                            toastr.warning(data.message);
                            @endif

                        }
                        if(data.valid == 'false'){
                            $('.purchasecode').attr('disabled', true);
                            $('#envato_id').css('border', '1px solid #e13a3a');
                            toastr.error(data.message);
                        }


                    },
                    error: function (data) {

                    }
                });
                }
            }else{
                toastr.error('Purchase Code field is Required');
                $('.purchasecode').attr('disabled', true);
                $('#envato_id').css('border', '1px solid #e13a3a');
            }
        });

        @endif

        // Summernote
        $('.summernote').summernote({
            placeholder: '',
            tabsize: 1,
            height: 200,
        // 	toolbar: [['style', ['style']], ['font', ['bold', 'underline', 'clear']], // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        // 	['fontname', ['fontname']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], // ['height', ['height']],
        // 	['table', ['table']], ['insert', ['link']], ['view', ['fullscreen']], ['help', ['help']]],
        // disableDragAndDrop:true,
            toolbar: [['style', ['style']], ['font', ['bold', 'underline', 'clear']], // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontname', ['fontname']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], // ['height', ['height']],
            ['table', ['table']], ['insert', ['link']], ['view', ['fullscreen']], ['help', ['help']]],
            callbacks: {
                onImageUpload: function(e){}
            },
        });

        // summernote
        $('.note-editable').on('keyup', function(e){
            localStorage.setItem('usermessage', e.target.innerHTML)
        })

        $('#subject').on('keyup', function(e){

            if(e.target.value.length == {{setting('TICKET_CHARACTER')}}){
                $('#subjectmaxtext').removeClass('text-muted')
                $('#subjectmaxtext').addClass('text-red');
            }else{
                $('#subjectmaxtext').removeClass('text-red')
                $('#subjectmaxtext').addClass('text-muted');
            }
            localStorage.setItem('usersubject', e.target.value)
        })

        $(window).on('load', function(){
            if(localStorage.getItem('usersubject') || localStorage.getItem('usermessage')){

                document.querySelector('#subject').value = localStorage.getItem('usersubject').slice(0,{{setting('TICKET_CHARACTER')}});
                document.querySelector('.summernote').innerHTML = localStorage.getItem('usermessage');
                document.querySelector('.note-editable').innerHTML = localStorage.getItem('usermessage');
            }
        });


        $('body').on('submit', '#user_form', function (e) {
            e.preventDefault();
            $('#SubjectError').html('');
            $('#MessageError').html('');
            $('#EmailError').html('');
            $('#CategoryError').html('');
            $('#verifyotpError').html('');
            $('#agreetermsError').html('');
            $('#createticketbtn').html(`{{lang('Loading..', 'menu')}} <i class="fa fa-spinner fa-spin"></i>`);
            $('#createticketbtn').prop('disabled', true);
            var formData = new FormData(this);
            formData.set('envato_id', licensekey);

            let checked  = document.querySelectorAll('.required:checked').length;
            var isValid = checked > 0;
            if(document.querySelectorAll('.required').length == '0'){
                ajax(formData);
            }else{

                if(isValid){
                    ajax(formData);
                }else{
                    $('#createticketbtn').prop('disabled', false);
                    $('#createticketbtn').html(`{{lang('Create Ticket', 'menu')}}`);
                    toastr.error('{{lang('Check the all field(*) required', 'alerts')}}')
                }
            }



        });

        function ajax(formData)
        {
            $.ajax({
                type:'post',
                url: '{{route('client.ticketcreate')}}',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,

                success: (data) => {
                    if(data.message == 'envatoerror')
                    {
                        toastr.error(data.error);
                        window.location.reload();
                    }else{
                        $('#SubjectError').html('');
                        $('#MessageError').html('');
                        $('#EmailError').html('');
                        $('#CategoryError').html('');
                        $('#verifyotpError').html('');
                        $('#agreetermsError').html('');
                        toastr.success(data.success);
                        if(localStorage.getItem('usersubject') || localStorage.getItem('usermessage')){
                            localStorage.removeItem("usersubject");
                            localStorage.removeItem("usermessage");
                        }
                        window.location.replace('{{url('customer/')}}');
                    }





                },
                error: function(data){

                    $('#SubjectError').html(data.responseJSON.errors.subject);
                    $('#MessageError').html(data.responseJSON.errors.message);
                    $('#EmailError').html(data.responseJSON.errors.email);
                    $('#CategoryError').html(data.responseJSON.errors.category);
                    $('#verifyotpError').html(data.responseJSON.errors.verifyotp);
                    $('#agreetermsError').html(data.responseJSON.errors.agree_terms);
                    if(data.responseJSON.errors.agree_terms) {
                        $('#createticketbtn').html(`{{lang('Create Ticket', 'menu')}}`);
                        $('#createticketbtn').prop('disabled', false);
                    }

                }
            });
        }

    })(jQuery);


    @if(setting('USER_FILE_UPLOAD_ENABLE') == 'yes')

    // Image Upload
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{route('imageupload')}}',
        maxFilesize: '{{setting('FILE_UPLOAD_MAX')}}', // MB
        addRemoveLinks: true,
        acceptedFiles: '{{setting('FILE_UPLOAD_TYPES')}}',
        maxFiles: '{{setting('MAX_FILE_UPLOAD')}}',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="ticket[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="ticket[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($project) && $project->document)
            var files =
            {!! json_encode($project->document) !!}
            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="ticket[]" value="' + file.file_name + '">')
            }
            @endif
            this.on('error', function(file, errorMessage) {
                if (errorMessage.message) {
                    var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                    errorDisplay[errorDisplay.length - 1].innerHTML = errorMessage.message;
                }
            });
        }
    }

    @endif


</script>

@endsection
