@extends('admin.layout.app')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    


    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link active"
                            data-bs-toggle="tab"
                            data-bs-target="#form-tabs-company-settings"
                            role="tab"
                            aria-selected="true"
                            >
                           {{__('lang.company_setting')}}
                            </button>
                        </li>

                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link "
                            data-bs-toggle="tab"
                            data-bs-target="#form-tabs-payment-methods"
                            role="tab"
                            aria-selected="false"
                            >
                            {{__('lang.payment_method')}}
                            </button>
                        </li>

                         <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#form-tabs-email-settings"
                            role="tab"
                            aria-selected="false"
                            >
                            {{__('lang.email')}}
                            </button>
                        </li>

                          <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#form-tabs-maintainance-settings"
                            role="tab"
                            aria-selected="false"
                            >
                             {{__('lang.admin_maintainance_mode')}}
                            </button>
                        </li>

                          <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#SocailmediaSetting"
                            role="tab"
                            aria-selected="false"
                            >
                            {{__('lang.social_media')}}
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link @if(Request::is('admin/settings/google-login*')) active @endif"
                            data-bs-toggle="tab"
                            data-bs-target="#form-tabs-google-login"
                            role="tab"
                            aria-selected="false"
                            >
                            {{__('lang.admin_google_login')}}
                            </button>
                        </li>
                    </ul>
                </div>
                
                <div class="tab-content">
                    <!-- company settings -->
                    <div class="tab-pane fade active show" id="form-tabs-company-settings" role="tabpanel">
                        <form method="POST" id="update-record" action="{{route('setting.update')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="page_name" value="company-setting">
                            @csrf
                            <div class="row">
                                @include('admin/setting/company_settings')
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1">{{__('lang.save')}}</button>
                                    <a href="{!! url('admin/dashboard') !!}" class="btn btn-outline-secondary">{{__('lang.back')}}</a>
                                </div>
                            </div>
                        </form>                    
                    </div>

                     <!-- payment method -->
                    <div class="tab-pane fade @if(Request::is('admin/settings/payment-method*')) active show @endif" id="form-tabs-payment-methods" role="tabpanel">
                        @include('admin/setting/payment_method')
                    </div>

                    <!-- email settings -->
                    <div class="tab-pane fade" id="form-tabs-email-settings" role="tabpanel">
                        <form method="POST" id="update-record" action="{{ route('setting.update') }}" method="POST">
                            <input type="hidden" name="page_name" value="email-setting">
                            @csrf
                            <div class="row">

                                @include('admin/setting/email_settings')

                            </div>
                            <div class="row">
                                <div class="row mt-3">
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1">{{__('lang.save')}}</button>
                                    <a href="{!! url('admin/dashboard') !!}" class="btn btn-outline-secondary">{{__('lang.back')}}</a>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>

                    <!-- maintainance settings -->
                    <div class="tab-pane fade @if(Request::is('admin/settings/maintainance-setting*')) active show @endif" id="form-tabs-maintainance-settings" role="tabpanel">
                        <form method="POST" id="update-record" action="{{route('setting.update')}}" method="POST">
                            <input type="hidden" name="page_name" value="maintainance-setting">
                            @csrf
                            <div class="row">

                                @include('admin/setting/maintainance_settings')

                            </div>
                            <div class="row">
                                 <div class="row">
                                <div class="row mt-3">
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1">{{__('lang.save')}}</button>
                                    <a href="{!! url('admin/dashboard') !!}" class="btn btn-outline-secondary">{{__('lang.back')}}</a>
                                </div>
                            </div>
                            </div>
                            </div>
                        </form>
                    </div>


                    <!-- Socail media settings -->
                    <div class="tab-pane fade " id="SocailmediaSetting" role="tabpanel">
                        <form method="POST" id="update-record" action="{{route('setting.update')}}" method="POST" >
                            <input type="hidden" name="page_name" value="social-media">
                            @csrf
                            <div class="row">
                             @include('admin/setting/socialMedia')
                            </div>
                            <div class="row">
                                 <div class="row">
                                <div class="row mt-3">
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1">{{__('lang.save')}}</button>
                                    <a href="{!! url('admin/dashboard') !!}" class="btn btn-outline-secondary">{{__('lang.back')}}</a>
                                </div>
                            </div>
                            </div>
                            </div>
                        </form>
                    </div>


                    <!-- Google login settings -->
                    <div class="tab-pane fade @if(Request::is('admin/settings/google-login*')) active show @endif" id="form-tabs-google-login" role="tabpanel">
                        <form method="POST" id="update-record" action="{{route('setting.update')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="page_name" value="google-login">
                            @csrf
                            <div class="row">
                            @foreach($result as $row)
                                @include('admin/setting/google_login_settings')
                            @endforeach 
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1">{{__('lang.admin_button_save_changes')}}</button>
                                    <a href="{!! url('admin/dashboard') !!}" class="btn btn-outline-secondary">{{__('lang.admin_button_back')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
