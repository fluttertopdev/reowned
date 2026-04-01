@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-6">
                    <!-- Account -->
                    <div class="card-body">
                       
                        <form id="" method="POST" action="{{route('updateAdmin.profile')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$row->id}}">
                            <div class="d-flex align-items-start align-items-sm-center gap-6">
                                <img
                                    src="{{ url('uploads/user/'.$row->image)}}"
                                    alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded"
                                    id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">{{__('lang.upload_new_photo')}}</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input
                                            type="file"
                                            id="upload"
                                            class="account-file-input"
                                            hidden
                                            name="image"
                                            accept="image/png, image/jpeg" />
                                    </label>



                                </div>
                            </div>
                    </div>
                    <div class="card-body pt-4">

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="firstName" class="form-label">{{__('lang.name')}}</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="Name"
                                    name="name"
                                    value="{{$row->name}}"
                                    autofocus required />
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="email" class="form-label">{{__('lang.email')}}</label>
                                <input
                                    class="form-control"
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{$row->email}}"
                                    placeholder="{{__('lang.email')}}" required />
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label" for="phoneNumber">{{__('lang.phone_number')}}</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        id="phoneNumber"
                                        name="phone"
                                        class="form-control"
                                        placeholder="{{__('lang.phone_number')}}"
                                        value="{{$row->phone}}"
                                        required
                                        maxlength="12"
                                        pattern="[0-9]{1,12}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12)" />
                                </div>

                            </div>
                            <div class="mb-6 col-md-6 form-password-toggle">
                                <label class="form-label" for="currentPassword">{{__('lang.password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        class="form-control"
                                        type="password"
                                        name="password"
                                        id="currentPassword"
                                        maxlength="8"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>







                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-3">{{__('lang.save')}}</button>

                        </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
    <!-- / Content -->



    <div class="content-backdrop fade"></div>
</div>


@endsection
