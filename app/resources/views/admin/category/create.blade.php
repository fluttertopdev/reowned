@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>


            <form class="card-body"
                action="{{isset($data) ? route('category.update') : route('category.store') }}"
                method="POST" enctype="multipart/form-data">

                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif
                 @php
                    $isSubcategory = request()->has('category') || (!empty($data) && $data->parent_id);
                    $categoryLabel = $isSubcategory ? __('lang.subcategory_name') : __('lang.category_name');
                    $categoryPlaceholder = $isSubcategory ? __('lang.subcategory_name') : __('lang.category_name');
                @endphp

                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label">{{ $categoryLabel }}</label>
                        <span class="text-danger">*</span>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', $data->name ?? '') }}"
                            onkeyup="generateSlug()" placeholder="{{ $categoryPlaceholder }}" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.slug')}}</label>
                        <span class="text-danger">*</span>
                        <input type="text" id="slug" name="slug" class="form-control"
                            value="{{ old('slug', $data->slug ?? '') }}" placeholder="{{__('lang.slug')}}" readonly />
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{__('lang.description')}}</label>
                        <span class="text-danger">*</span>
                        <textarea name="description" placeholder="{{__('lang.description')}}" class="form-control">{{ old('description', $data->description ?? '') }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image')}}</label>
                        <span class="text-danger">*</span>
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" />
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image_preview')}}</label>
                        <span class="text-danger">*</span>
                        <img id="image-preview" src="{{ $data && $data->image ? asset('uploads/category/' . $data->image) : asset('uploads/Image-not-found.png') }}"
                            alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                    </div>
                </div>

                <input type="hidden" name="parent_id" value="{{ old('parent_id', request()->get('category', 0)) }}" />

                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">{{__('lang.submit')}}</button>
                    
                     @if(request()->has('category'))
                            <a type="reset" class="btn btn-outline-secondary"
                                href="{{ route('category.index', ['category' => request()->get('category')]) }}">
                                {{__('lang.back')}}
                            </a>
                            @else
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('category.index') }}">{{__('lang.back')}}</a>
                            @endif
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
