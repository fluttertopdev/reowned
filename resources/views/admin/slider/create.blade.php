@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('slider.update') : route('slider.store') }}" method="POST" enctype="multipart/form-data" id="description-form">
                @csrf
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <!-- Type Selection -->
                    <div class="col-md-6">
                        <label class="form-label" for="type">{{__('lang.type')}}</label>
                        <span class=" text-danger">*</span>
                        <select class="form-control select2 form-select" name="type" id="type" onchange="toggleFields()" required>
                            <option value="">{{__('lang.please_select')}}</option>
                            @foreach(config('constants.slider_type') as $value => $label)
                            <option value="{{ $value }}" {{ (isset($data) && $data->type == $value) ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Item Dropdown -->
                    <div class="col-md-6 d-none" id="item-field">
                        <label class="form-label" for="item">{{__('lang.item')}}</label>
                        <span class=" text-danger">*</span>
                        <select class="form-control select2 form-select" id="item_value" onchange="updateValue(this.value)">
                            <option value="">{{__('lang.please_select')}}</option>
                            @foreach($item as $list)
                            <option value="{{ $list->id }}" {{ (isset($data) && $data->value == $list->id) ? 'selected' : '' }}>
                                {{ $list->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="col-md-6 d-none" id="category-field">
                        <label class="form-label" for="category_value">{{__('lang.category')}}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" id="category_value" onchange="updateValue(this.value)">
                            <option value="">{{__('lang.please_select')}}</option>

                            @foreach($category->where('parent_id', 0) as $parent)
                            <optgroup label="📁 {{ $parent->name }}">
                                @foreach($category->where('parent_id', $parent->id) as $sub)
                                <option value="{{ $sub->id }}" {{ (isset($data) && $data->value == $sub->id) ? 'selected' : '' }}>
                                    &nbsp;&nbsp;📂 {{ $sub->name }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach

                        </select>
                    </div>

                    <!-- Link Input Field -->
                    <div class="col-md-6 d-none" id="link-field">
                        <label class="form-label" for="link">{{__('lang.external_link')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="url" id="link_value" class="form-control" placeholder="{{__('lang.external_link')}}" value="{{ isset($data) ? $data->value : '' }}" oninput="updateValue(this.value)" />
                    </div>

                    <!-- Hidden Input to Store Final Value -->
                    <input type="hidden" name="value" id="final_value" value="{{ isset($data) ? $data->value : '' }}">

                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <label class="form-label" for="image">{{__('lang.image')}}</label>
                        <span class=" text-danger">*</span>
                        <div class="input-group input-group-merge">
                            <input type="file" id="slider-image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" />
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image_preview')}}</label>
                        <span class=" text-danger">*</span>
                        <div>

                            <img id="image-preview"
                                 data-existing="{{ $data && $data->image ? 1 : 0 }}"
                                 src="{{ $data && $data->image 
                                        ? asset('uploads/slider/' . $data->image) 
                                        : asset('uploads/Image-not-found.png') }}"
                                 alt="Image Preview"
                                 style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>
                </div>
                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                        {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                    </button>
                    <a href="{{route('slider.index')}}" class="btn btn-label-secondary">{{__('lang.back')}}</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {

        let form = document.getElementById('description-form');
        if (!form) return;

        form.addEventListener('submit', function(e) {

            let imageInput = document.getElementById('slider-image');
            let previewImage = document.getElementById('image-preview');

            let hasExistingImage = previewImage.getAttribute('data-existing') === "1";
            let newImageSelected = imageInput.files.length > 0;

            // Validate image required logic
            if (!hasExistingImage && !newImageSelected) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Image Required',
                    text: 'Please upload an image.'
                });
                return false;
            }

        });

    });
</script>