@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('advertisement-package.update') : route('advertisement-package.store') }}" method="POST" enctype="multipart/form-data" id="description-form">
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.name')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-username" name="name" class="form-control" placeholder="{{__('lang.name')}}" value="{{ old('name', $data->name ?? '') }}" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-price">{{__('lang.price')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-price" name="price" class="form-control" placeholder="{{__('lang.price')}}" value="{{ old('price', $data->price ?? '') }}" />
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-discount">{{__('lang.discount')}} (%)</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-discount" class="form-control" name="discount" placeholder="{{__('lang.discount')}}" value="{{ old('discount', $data->discount ?? '') }}" />
                        @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="multicol-final-price">{{__('lang.final_price')}}</label>
                            <span class=" text-danger">*</span>
                            <div class="input-group input-group-merge">
                                <input type="text" id="multicol-final-price" class="form-control" name="final_price " placeholder="{{__('lang.final_price')}}"
                                    value="{{ old('final_price', $data->final_price ?? '') }}" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-days">{{__('lang.days')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-days" class="form-control" name="days" placeholder="{{__('lang.days')}}" value="{{ old('days', $data->days ?? '') }}" />
                        @error('days')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-item">{{__('lang.item')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-item" class="form-control" placeholder="{{__('lang.item')}}" name="item_limit" value="{{ old('item_limit', $data->item_limit ?? '') }}" />
                        @error('item_limit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-2">
                    <label class="form-label" for="description">{{__('lang.description')}}</label>
                    <span class="text-danger">*</span>

                    <!-- Quill Editor -->
                    <div id="full-editor"></div>

                    <!-- Hidden textarea for storing content -->
                    <textarea name="description" id="description" hidden>{{ old('description', $data->description ?? '') }}</textarea>

                    <span class="text-danger" id="description-error">
                        @error('description') {{ $message }} @enderror
                    </span>
                </div>

                    <div class="col-md-6">
                        <label class="form-label" for="category-image">{{__('lang.image')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="file" id="packageimage-image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" />
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image_preview')}}</label>
                        <span class=" text-danger">*</span>
                        <div>
                            <img id="image-preview" src="{{ $data && $data->image ? asset('uploads/packages/' . $data->image) : asset('uploads/Image-not-found.png') }}" alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                                <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>

                    <a href="{{route('advertisement-package.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>




@endsection
