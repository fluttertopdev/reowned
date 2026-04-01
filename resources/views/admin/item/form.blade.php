@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <h5 class="card-header">{{ __('lang.edit') }}</h5>

            <form class="card-body" action="" method="POST">
                @csrf


                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" id="selected_state" value="{{ $data->state_id }}">
                <input type="hidden" id="selected_country" value="{{ $data->country_id }}">
                <input type="hidden" id="selected_city" value="{{ $data->city_id }}">

                <div class="row g-6">

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.name')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-username" name="name" class="form-control" placeholder="{{__('lang.name')}}" value="{{ old('name', $data->name) }}" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.price')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-username" name="price" class="form-control" placeholder="{{__('lang.price')}}" value="{{ old('price', $data->price) }}" />
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.slug')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-username" name="slug" class="form-control" placeholder="{{__('lang.slug')}}" value="{{ old('slug', $data->slug) }}" />
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.phone')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-username" name="price" class="form-control" placeholder="{{__('lang.phone')}}" value="{{ old('phone', $data->phone) }}" />
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Country Dropdown -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.country') }}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="country_id" id="country" required>
                            <option value="">{{ __('lang.select_country') }}</option>
                            @foreach ($countries as $id => $name)
                                <option value="{{ $id }}" {{ $data->country_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State Dropdown -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.state') }}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="state_id" id="state" required>
                            <option value="">{{ __('lang.select_state') }}</option>
                        </select>
                        @error('state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City Dropdown -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.city') }}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="city_id" id="city" required>
                            <option value="">{{ __('lang.select_city') }}</option>
                        </select>
                        @error('city_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Area Name Input -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.area') }}</label>
                        <span class="text-danger">*</span>
                        <textarea name="name" class="form-control" placeholder="Area" required></textarea>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                      <div class="col-md-6">
                        <label class="form-label" for="blog-image">{{__('lang.image')}}</label>
                        <span class=" text-danger">*</span>
                        <div class="input-group input-group-merge">
                            <input type="file" id="blog-image" name="image" class="form-control" accept="image/*"
                                onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Image Preview --}}
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label">{{__('lang.image_preview')}}</label>
                             <span class=" text-danger">*</span>
                            <div>
                                <img id="image-preview"
                                    src="{{ isset($data->image) ? url('uploads/blog/'.$data->image) : url('uploads/Image-not-found.png') }}"
                                    alt="Image Preview"
                                    style="width: 200px; border: 1px solid #ccc; display: block;" />
                            </div>
                        </div>
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

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">{{ __('lang.update') }}</button>
                    <a href="{{ route('item.index') }}" class="btn btn-label-secondary">{{ __('lang.back') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
