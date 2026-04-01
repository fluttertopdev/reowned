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
                        <label class="form-label" for="multicol-price">{{__('lang.email')}}</label>
                        <input type="text" id="multicol-price" name="email" class="form-control" placeholder="{{__('lang.email')}}" value="{{ old('email', $data->email ?? '') }}" readonly />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-discount">{{__('lang.subject')}}</label>
                        <input type="text" id="multicol-discount" class="form-control" name="subject" placeholder="{{__('lang.subject')}}" value="{{ old('subject', $data->subject ?? '') }}" readonly />
                    </div>

                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="multicol-final-price">{{__('lang.message')}}</label>
                            <div class="input-group input-group-merge">
                                <textarea type="text" id="multicol-final-price" class="form-control" name="message" placeholder="{{__('lang.message')}}" value="{{ old('message', $data->msg ?? '') }}" readonly >{{ old('final_price', $data->msg ?? '') }}</textarea>
                              
                            </div>
                        </div>
                    </div>
                     <div class="pt-6">
                      

                    <a href="{{route('userqueries.index')}}"
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
