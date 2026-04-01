@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('seo.update') : route('seo.store') }}" method="POST" enctype="multipart/form-data" id="description-form">
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.page_name')}}</label>
                        <span class="text-danger">*</span>
                        <input type="text" id="multicol-username" name="page" class="form-control" placeholder="{{__('lang.page_name')}}" value="{{ old('page', $data->page ?? '') }}" />
                        @error('page')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.title')}}</label>
                        <span class="text-danger">*</span>
                        <input type="text" id="multicol-username" name="title" class="form-control" placeholder="{{__('lang.title')}}" value="{{ old('title', $data->title ?? '') }}" />
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.keyword')}}</label>
                        <span class="text-danger">*</span>
                        <input type="text" id="multicol-username" name="keyword" class="form-control" placeholder="{{__('lang.keyword')}}" value="{{ old('keyword', $data->keyword ?? '') }}" />
                        @error('keyword')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label class="form-label" for="multicol-discount">{{__('lang.description')}}</label>
                        <span class="text-danger">*</span>
                        <textarea type="text" id="multicol-discount" class="form-control" name="description" placeholder="{{__('lang.description')}}" value="{{ old('description', $data->description ?? '') }}">{{ old('description', $data->description ?? '') }}</textarea>

                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="category-image">{{__('lang.image')}}</label>
                        <span class="text-danger">*</span>
                        <input type="file" id="packageimage-image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" />
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image_preview')}}</label>
                        <span class="text-danger">*</span>
                        <div>
                            <img id="image-preview" src="{{ $data && $data->image ? asset('uploads/seo/' . $data->image) : asset('uploads/Image-not-found.png') }}" alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                        {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                    </button>

                    <a href="{{route('seo.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>




@endsection