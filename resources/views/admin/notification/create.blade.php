@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.view') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('notification.update') : route('notification.store') }}" method="POST" enctype="multipart/form-data" id="description-form">
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <!-- Title Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.title')}}</label>
                        <span class="text-danger">*</span>
                        <input type="text" id="multicol-username" name="title" class="form-control" placeholder="{{__('lang.title')}}" value="{{ old('title', $data->title ?? '') }}"
                            @if(isset($data)) readonly disabled @endif />
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Multiple Select User with "Select All/Deselect All" -->
                    <div class="col-md-6 select2-primary">
                        <label class="form-label">{{__('lang.name')}}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="user_id[]" multiple data-placeholder="{{__('lang.select_user')}}" id="user-dropdown" @if(isset($data)) disabled @endif>
                            <option value="select_all">Select All</option>
                            <option value="deselect_all">Deselect All</option>
                            @foreach ($users as $id => $name)
                            <option value="{{ $id }}"
                                @if( old('user_id') ? in_array($id, old('user_id')) : (isset($data) && in_array($id, (array) json_decode($data->user_id, true)) ) ) selected @endif>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Multiple Select Item with "Select All/Deselect All" -->
                    <div class="col-md-6 select2-primary">
                        <label class="form-label">{{__('lang.item')}}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="item_id[]" multiple data-placeholder="{{__('lang.select_item')}}" id="item-dropdown" @if(isset($data)) disabled @endif>
                            <option value="select_all">Select All</option>
                            <option value="deselect_all">Deselect All</option>
                            @foreach ($item as $id => $name)
                            <option value="{{ $id }}"
                                @if( old('item_id') ? in_array($id, old('item_id')) : (isset($data) && in_array($id, (array) json_decode($data->item_id, true)) ) ) selected @endif>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @error('item_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Message Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-discount">{{__('lang.message')}}</label>
                        <span class="text-danger">*</span>
                        <textarea type="text" id="multicol-discount" class="form-control" name="msg" placeholder="{{__('lang.message')}}" @if(isset($data)) readonly disabled @endif>{{ old('msg', $data->msg ?? '') }}</textarea>
                        @error('msg')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload (Hidden in Edit Mode) -->
                    @if(!isset($data))
                    <div class="col-md-6">
                        <label class="form-label" for="category-image">{{__('lang.image')}}</label>
                        <span class="text-danger">*</span>
                        <input type="file" id="notification-image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" />
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    <!-- Image Preview -->
                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image_preview')}}</label>
                        <span class="text-danger">*</span>
                        <div>
                            <img id="image-preview" src="{{ isset($data->image) ? asset('uploads/notification/' . $data->image) : asset('uploads/Image-not-found.png') }}" alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    @if(!isset($data))
                    <button type="submit" class="btn btn-primary me-4">
                        {{ __('lang.submit') }}
                    </button>
                    @endif
                    <a href="{{route('notification.index')}}" class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
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

        let imageInput = document.getElementById('notification-image');

        // If image field exists (create mode)
        if (imageInput && imageInput.files.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Image Required',
                text: 'Please upload an image.'
            });

        }

    });

});
</script>
