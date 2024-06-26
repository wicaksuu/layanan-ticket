@extends('layouts.adminmaster')

@section('content')

    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title"><span class="font-weight-normal text-muted ms-2">{{lang('Add Language')}}</span></h4>
        </div>
    </div>
    <!--End Page header-->

    <div class="col-xl-12 col-lg-12 col-md-12">

        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title">{{lang('Add Language')}}</h4>
            </div>
            <form action="{{ route('admin.languages.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{lang('Display Translation Name')}} <span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="{{lang('Ex:- عربى')}}" name="languagename" value="" required autofocus>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{lang('Translation Native Name')}} <span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="{{lang('Ex:- Arabic')}}" name="languagenativename" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ lang('Select Language Code') }} <span class="text-red">*</span></label>
                        <select  class="form-control select2 select2-show-search" name="languagecode" data-placeholder="{{lang('Select Language Code')}}" id="selectlanguage" required>
                            <option></option>
                            @foreach (languages() as $code => $name)
                                <option value="{{ $code }}">{{ $name }} ({{ $code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="switch_section">
                            <div class="switch-toggle d-flex p-0">

                                <a class="onoffswitch2">
                                    <input type="checkbox" name="is_default" id="is_default" class="toggle-class onoffswitch2-checkbox sprukoregister" value="1">
                                    <label for="is_default" class="toggle-class onoffswitch2-label" ></label>
                                </a>
                                <label class="form-label ps-3 ps-md-max-0">{{lang('Set as default Language')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="switch_section">
                            <div class="switch-toggle d-flex p-0">

                                <a class="onoffswitch2">
                                    <input type="checkbox" name="is_rtl" id="is_rtl" class="toggle-class onoffswitch2-checkbox sprukoregister" value="1">
                                    <label for="is_rtl" class="toggle-class onoffswitch2-label" ></label>
                                </a>
                                <label class="form-label ps-3 ps-md-max-0">{{lang('RTL Enable')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group  float-end">
                        <button type="submit" class="btn btn-secondary">{{lang('Save')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')

        <!-- INTERNAL Index js-->
        <script src="{{asset('assets/js/select2.js')}}?v=<?php echo time(); ?>"></script>

@endsection
