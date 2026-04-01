@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{route('translation.store') }}" method="POST">
                @csrf


                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-price">{{__('lang.group')}}</label>
                        <span class=" text-danger">*</span>
                        <select class="form-control select2 form-select" name="group">
                            <option value="">{{__('lang.please_select')}}</option>
                            @foreach(config('constants.group') as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('group') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('group')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-price">{{__('lang.keyword')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" class="form-control" name="keyword" placeholder="{{__('lang.keyword')}}">
                        @error('keyword')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="lang_id" value="{{ Request::segment(4) }}">

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-price">{{__('lang.value')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" class="form-control" name="value" placeholder="{{__('lang.value')}}">
                        @error('value')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="pt-6">
                     <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{ route('translation.index', Request::segment(4)) }}" class="btn btn-label-secondary">{{__('lang.back')}}</a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
