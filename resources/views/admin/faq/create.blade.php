@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>

            <form class="card-body"
                action="{{ isset($data) ? route('faq.update') : route('faq.store') }}"
                method="POST"  id="description-form-faq" novalidate>

                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <div class="col-md-12">
                        <label class="form-label" for="name">{{__('lang.question')}}</label>
                        <span class="text-danger">*</span>
                        <textarea id="name" name="title" class="form-control"
                            placeholder="{{__('lang.question')}}" value="{{ old('title', $data->title ?? '') }}" >{{ old('title', $data->title ?? '') }}</textarea>
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <label class="form-label" for="description">{{__('lang.answer')}}</label>
                    <span class="text-danger">*</span>

                    <!-- Quill Editor -->
                    <div id="full-editor"></div>

                    <!-- Hidden textarea for storing content -->
                    <textarea name="description" id="description-faq" style="display:none;">{{ old('description', $data->description ?? '') }}</textarea>

                    <span class="text-danger" id="description-error-faq">
                        @error('description') {{ $message }} @enderror
                    </span>
                </div>

                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{route('faq.index')}}" class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection