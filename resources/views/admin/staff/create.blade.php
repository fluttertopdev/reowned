@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('staff.update') : route('staff.store') }}" method="POST">
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif
                <input type="hidden" name="type" value="staff">
                <input type="hidden" name="role_id" value="2">
                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.name')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-username" name="name" class="form-control" placeholder="{{__('lang.name')}}" value="{{ old('name', $data->name ?? '') }}" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-email">{{__('lang.email')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="email" id="multicol-email" name="email" class="form-control" placeholder="{{__('lang.email')}}" value="{{ old('email', $data->email ?? '') }}" />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-phone">{{__('lang.phone')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-phone" name="phone" class="form-control" placeholder="{{__('lang.phone')}}" value="{{ old('phone', $data->phone ?? '') }}" />
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field with Eye Icon -->
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="multicol-password">{{__('lang.password')}}</label>
                            <span class=" text-danger">*</span>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="multicol-password"
                                    class="form-control"
                                    name="password"
                                    placeholder="••••••••"
                                    value=""
                                    aria-describedby="multicol-password2" />
                                <span class="input-group-text cursor-pointer toggle-password" id="multicol-password2">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password Field with Eye Icon -->
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="multicol-confirm-password">{{__('lang.confirm_password')}}</label>
                            <span class=" text-danger">*</span>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="multicol-confirm-password"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="••••••••"
                                    value=""
                                    aria-describedby="multicol-confirm-password2" />
                                <span class="input-group-text cursor-pointer toggle-password" id="multicol-confirm-password2">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                        {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                    </button>
                    <a href="{{ route('staff.index') }}" class="btn btn-label-secondary">{{__('lang.back')}}</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection