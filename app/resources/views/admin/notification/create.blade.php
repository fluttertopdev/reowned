@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('notification.update') : route('notification.store') }}" method="POST" enctype="multipart/form-data" id="description-form">
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.title')}}</label>
                         <span class="text-danger">*</span>
                        <input type="text" id="multicol-username" name="title" class="form-control" placeholder="{{__('lang.title')}}" value="{{ old('title', $data->title ?? '') }}" />
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <div class="col-md-6">
                            <label class="form-label">{{__('lang.name')}}</label>
                            <span class="text-danger">*</span>
                            <select class="form-control select2 form-select" name="user_id" >
                                <option value="">{{__('lang.select_user')}}</option>
                                @foreach ($users as $id => $name)
                                <option value="{{ $id }}" {{ isset($data) && $data->user_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{__('lang.item')}}</label>
                            <span class="text-danger">*</span>
                            <select class="form-control select2 form-select" name="item_id">
                                <option value="">{{__('lang.select_item')}}</option>
                                @foreach ($item as $id => $name)
                                <option value="{{ $id }}" {{ isset($data) && $data->item_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                                @endforeach
                            </select>
                            @error('item_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    <div class="col-md-6">
                        <label class="form-label" for="multicol-discount">{{__('lang.message')}}</label>
                        <span class="text-danger">*</span>
                        <textarea type="text" id="multicol-discount" class="form-control" name="msg" placeholder="{{__('lang.message')}}" value="{{ old('msg', $data->msg ?? '') }}">{{ old('msg', $data->msg ?? '') }}</textarea>

                        @error('msg')
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
                            <img id="image-preview" src="{{ $data && $data->image ? asset('uploads/notification/' . $data->image) : asset('uploads/Image-not-found.png') }}" alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                                <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>

                    <a href="{{route('notification.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>




@endsection
