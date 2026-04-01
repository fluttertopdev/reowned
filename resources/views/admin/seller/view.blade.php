@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('seller.update') : route('seller.store') }}" method="POST" enctype="multipart/form-data" id="description-form">
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
                        <label class="form-label" for="multicol-price">{{__('lang.email')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-price" name="email" class="form-control" placeholder="{{__('lang.email')}}" value="{{ old('email', $data->email ?? '') }}" />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-discount">{{__('lang.phone')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" id="multicol-discount" class="form-control" name="phone" placeholder="{{__('lang.phone')}}" value="{{ old('phone', $data->phone ?? '') }}" />
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label class="form-label" for="multicol-discount">{{__('lang.address')}}</label>
                        <span class=" text-danger">*</span>
                        <textarea type="text" id="multicol-discount" class="form-control" name="address" placeholder="{{__('lang.address')}}" value="{{ old('address', $data->address ?? '') }}" >{{ old('address', $data->address ?? '') }}</textarea>
                      
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                            <img id="image-preview" src="{{ $data && $data->image ? asset('uploads/user/' . $data->image) : asset('uploads/Image-not-found.png') }}" alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>


                     <div class="col-md-6">
                        <label class="form-label" for="id_proof_front">{{ __('lang.idprooffront') }}</label>
                        <span class="text-danger">*</span>
                        <input type="file" id="id_proof_front" name="id_proof_front" class="form-control" accept="image/*" onchange="showImagePreview(event, 'preview_id_proof_front')" />
                        @error('id_proof_front')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.image_preview') }}</label>
                        <span class="text-danger">*</span>
                        <div>
                            <img id="preview_id_proof_front" src="{{ $data && $data->id_proof_front ? asset('uploads/user/' . $data->id_proof_front) : asset('uploads/Image-not-found.png') }}" alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="id_proof_back">{{ __('lang.idproofback') }}</label>
                        <span class="text-danger">*</span>
                        <input type="file" id="id_proof_back" name="id_proof_back" class="form-control" accept="image/*" onchange="showImagePreview(event, 'preview_id_proof_back')" />
                        @error('id_proof_back')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.image_preview') }}</label>
                        <span class="text-danger">*</span>
                        <div>
                            <img id="preview_id_proof_back" src="{{ $data && $data->id_proof_back ? asset('uploads/user/' . $data->id_proof_back) : asset('uploads/Image-not-found.png') }}" alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>
                </div>
                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>

                    <a href="{{route('seller.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection