@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body"
                action="{{ isset($data) ? route('blogs.update') : route('blogs.store') }}"
                method="POST" enctype="multipart/form-data" id="description-form">
                @csrf
                @if(isset($data))
                @method('POST')

                <input type="hidden" name="id" value="{{ $data->id }}">


                @endif

                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label" for="blog-title">{{__('lang.title')}}</label><span class=" text-danger">*</span>
                        <input type="text" id="name" name="title" class="form-control"
                            placeholder="{{__('lang.title')}}" value="{{ old('title', $data->title ?? '') }}" onkeyup="generateSlug()" />
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="blog-slug">{{__('lang.slug')}}</label>
                        <span class=" text-danger">*</span>

                        <input type="text" id="slug" name="slug" class="form-control"
                            placeholder="{{__('lang.slug')}}" value="{{ old('slug', $data->slug ?? '') }}" readonly />
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>




                    {{-- Tags Dropdown --}}
                    <div class="col-md-12 select2-primary">
                        <label class="form-label" for="blog-tags">{{__('lang.tag')}}</label>
                        <span class=" text-danger">*</span>
                        <select id="blog-tags" name="tag_id[]" class="select2 form-select" multiple>
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @selected(isset($selectedTags) && in_array($tag->id, $selectedTags))>
                                {{ $tag->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('tag_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
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
                </div>

                <div class="pt-6">
                          <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{route('blogs.index')}}"
                        class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
