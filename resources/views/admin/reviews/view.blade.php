@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ __('lang.view') }}</h5>
            <div class="card-body" id="description-form">
                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.name')}}</label>
                        <input type="text" id="multicol-username" name="name" class="form-control" placeholder="{{__('lang.name')}}" value="{{ old('name', $data->user->name ?? '') }}" readonly />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-price">{{__('lang.item')}}</label>
                        <input type="text" id="multicol-price" name="item" class="form-control" placeholder="{{__('lang.item')}}" value="{{ old('item', $data->item->name ?? '') }}" readonly />
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="multicol-discount">{{__('lang.reason')}}</label>
                        <textarea type="text" id="multicol-discount" class="form-control" name="reason" placeholder="{{__('lang.reason')}}" value="{{ old('reason', $data->reportReason->reason ?? '') }}" readonly>{{ old('reason', $data->reportReason->reason ?? '') }}</textarea>
                      
                    </div>

                    
                     <div class="pt-6">
                      

                    <a href="{{route('reviews.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
