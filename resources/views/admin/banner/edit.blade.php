@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <h5 class="card-header">{{ __('lang.edit') }}</h5>
            <form class="card-body" action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data" id="description-form">
                @csrf

                <!-- Hidden ID -->
                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                <div class="row g-6">

                    <!-- Link Input Field -->
                    <div class="col-md-12">
                        <label class="form-label" for="link">{{ __('lang.link') }}</label>
                        <span class="text-danger">*</span>
                        <input type="url" 
                               name="link" 
                               id="link" 
                               class="form-control" 
                               placeholder="{{ __('lang.link') }}"
                               value="{{ isset($data) ? $data->link : '' }}" />
                        
                        @error('link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <label class="form-label" for="image">{{ __('lang.image') }}</label>
                        <span class="text-danger">*</span>

                        <div class="input-group input-group-merge">
                            <input type="file" 
                                   id="banner-image" 
                                   name="image" 
                                   class="form-control" 
                                   accept="image/*" 
                                   onchange="previewImage(event)" />
                        </div>
                        <p class="text-danger mt-2">Resolution 1236 × 424 px</p>

                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.image_preview') }}</label>
                        <span class="text-danger">*</span>

                        <div>
                            <img id="image-preview"
                                 src="{{ $data && $data->image 
                                        ? asset('uploads/banner/' . $data->image) 
                                        : asset('uploads/Image-not-found.png') }}"
                                 alt="Image Preview"
                                 style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div class="col-md-12">
                        <label class="form-label" for="status">{{ __('lang.select_status') }}</label>
                        <span class="text-danger">*</span>

                        <select class="form-control select2 form-select" name="status" id="status">
                            <option value="1" {{ isset($data) && $data->status == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ isset($data) && $data->status == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                        {{ __('lang.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection