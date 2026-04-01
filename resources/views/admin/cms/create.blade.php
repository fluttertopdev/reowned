@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>

            <form class="card-body"
                action="{{ isset($data) ? route('cms.update') : route('cms.store') }}"
                method="POST" id="description-form">

                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="name">{{__('lang.page_name')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="name" name="page_name" class="form-control"
                            placeholder="{{__('lang.page_name')}}" value="{{ old('page_name', $data->page_name ?? '') }}"
                            onkeyup="generateSlug()" />
                        @error('page_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="slug">{{__('lang.slug')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="slug" name="slug" class="form-control"
                            placeholder="{{__('lang.slug')}}" value="{{ old('slug', $data->slug ?? '') }}" readonly />
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                   <div class="col-md-12">
                        <label class="form-label">{{__('lang.description')}}</label>
                        <span class=" text-danger">*</span>
                        <!-- Quill Editor -->
                    <div id="full-editor"></div>
                        <!-- Hidden textarea for storing content -->
                    <textarea name="description" id="description" hidden>{{ old('description', $data->description ?? '') }}</textarea>

                    <span class="text-danger" id="description-error">
                        @error('description') {{ $message }} @enderror
                    </span>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{route('cms.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
