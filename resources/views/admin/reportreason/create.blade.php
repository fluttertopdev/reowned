@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('reportreason.update') : route('reportreason.store') }}" method="POST" enctype="multipart/form-data" id="description-form">
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <div class="col-md-12">
                        <label class="form-label" for="multicol-username">{{__('lang.reason')}}</label>
                        <span class=" text-danger">*</span>
                        <textarea type="text" id="multicol-username" name="reason" class="form-control" placeholder="{{__('lang.reason')}}" value="{{ old('reason', $data->reason ?? '') }}" >{{ old('reason', $data->reason ?? '') }}</textarea>
                        
                        @error('reason')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                   
                </div>

                <div class="pt-6">
                                <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>

                    <a href="{{route('reportreason.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>




@endsection
