@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>

            <form class="card-body"
                action="{{ isset($data) ? route('country.update') : route('country.store') }}"
                method="POST">

                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">


                    <div class="col-md-12">
                        <label class="form-label">{{__('lang.country')}}</label>
                        <span class=" text-danger">*</span>
                        <div class="">
                            <input name="name" value="{{ old('name', $data->name ?? '') }}" class="form-control" placeholder="{{__('lang.country')}}">
                        </div>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="pt-6">
                     <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{route('country.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
