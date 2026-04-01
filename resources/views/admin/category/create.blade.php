@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>
            <form id="categoryForm" class="card-body"
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
                        <input type="file"
                           name="image"
                           id="imageInput"
                           class="form-control"
                           accept="image/*"
                           onchange="previewImage(event)" />

                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image_preview')}}</label>
                        <span class="text-danger">*</span>
                        <img id="image-preview"
                             data-existing="{{ $data && $data->image ? 1 : 0 }}"
                             src="{{ $data && $data->image 
                                    ? asset('uploads/category/' . $data->image) 
                                    : asset('uploads/Image-not-found.png') }}"
                             alt="Image Preview"
                             style="width: 200px; border: 1px solid #ccc; display: block;" />
                    </div>
                </div>

                <input type="hidden" name="parent_id" value="{{ old('parent_id', request()->get('category', 0)) }}" />


                @if($isSubcategory)

                    <hr class="my-4">
                    <h5 class="mb-3">Custom Fields</h5>

                    <div id="custom-fields-wrapper"></div>

                    <button type="button" class="btn btn-primary btn-sm mb-3" id="add-field-btn">
                        + Add Field
                    </button>

                    <input type="hidden" name="custom_fields" id="custom_fields_input">

                @endif

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

<script>
document.addEventListener('DOMContentLoaded', function () {

    let form = document.getElementById('categoryForm');

    if (!form) return;

    form.addEventListener('submit', function(e) {

        let imageInput = document.getElementById('imageInput');
        let previewImage = document.getElementById('image-preview');

        let hasExistingImage = previewImage.getAttribute('data-existing') == "1";
        let newImageSelected = imageInput.files.length > 0;

        if (!hasExistingImage && !newImageSelected) {
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

@if(isset($data) && $data->parent_id != 0)
<script>
    window.existingCustomFields = {!! 
        json_encode(
            $data->customFields()
                  ->with('options')
                  ->orderBy('sort_order')
                  ->get()
        ) 
    !!};
</script>
@endif

<script>

let fieldCounter = 0;

/* ===============================
   ADD FIELD BUTTON
=================================*/
document.addEventListener("DOMContentLoaded", function() {

    const addBtn = document.getElementById("add-field-btn");

    if(addBtn){
        addBtn.addEventListener("click", function(){
            appendField();
        });
    }

    // Load existing fields (Edit case)
    if (typeof window.existingCustomFields !== "undefined") {
        window.existingCustomFields.forEach(field => {
            appendField(field);
        });
    }

});


/* ===============================
   APPEND FIELD BLOCK
=================================*/
function appendField(data = null) {

    let index = fieldCounter++;

    let html = `
    <div class="card p-3 mb-3 custom-field-item" data-index="${index}">
        <div class="row g-3">

            <div class="col-md-3">
                <label>Field Name</label>
                <input type="text" class="form-control field-name"
                    value="${data ? data.field_name : ''}">
            </div>

            <div class="col-md-3">
                <label>Field Type</label>
                <select class="form-control field-type">
                    <option value="textbox">Text Input</option>
                    <option value="number">Number Input</option>
                    <option value="dropdown">Dropdown</option>
                    <option value="checkbox">Checkbox</option>
                </select>
            </div>

            <div class="col-md-2 length-section">
                <label>Min</label>
                <input min="1" type="text" class="form-control field-min only-positive-number"
                    value="${data ? data.min_length ?? '' : ''}">
            </div>

            <div class="col-md-2 length-section">
                <label>Max</label>
                <input min="1" type="text" class="form-control field-max only-positive-number"
                    value="${data ? data.max_length ?? '' : ''}">
            </div>

            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-danger btn-sm mt-4 remove-field">
                    Remove
                </button>
            </div>

            <div class="col-md-12 options-section d-none">
                <label>Field Values</label>
                <input type="text" class="form-control option-input"
                       placeholder="Type value & press Enter">
                <div class="mt-2 option-tags"></div>
            </div>

            <div class="col-md-6 mt-2">
                <label>
                    <input type="checkbox" class="field-required"
                        ${data && data.is_required ? 'checked' : ''}>
                    Required
                </label>
            </div>

            <div class="col-md-6 mt-2">
                <label>
                    <input type="checkbox" class="field-active"
                        ${data && data.is_active ? 'checked' : 'checked'}>
                    Active
                </label>
            </div>

        </div>
    </div>
    `;

    document.getElementById("custom-fields-wrapper")
            .insertAdjacentHTML("beforeend", html);

    let container = document.querySelector(`.custom-field-item[data-index="${index}"]`);

    // Set field type
    if(data){
        container.querySelector(".field-type").value = data.field_type;
    }

    toggleSections(container);

    // Load existing options
    if(data && data.options){
        data.options.forEach(opt => {
            addTag(container, opt.option_value);
        });
    }
}


/* ===============================
   REMOVE FIELD
=================================*/
document.addEventListener("click", function(e){
    if(e.target.classList.contains("remove-field")){
        e.target.closest(".custom-field-item").remove();
    }
});


/* ===============================
   CHANGE FIELD TYPE
=================================*/
document.addEventListener("change", function(e){
    if(e.target.classList.contains("field-type")){
        toggleSections(e.target.closest(".custom-field-item"));
    }
});


/* ===============================
   TOGGLE SECTIONS
=================================*/
function toggleSections(container){

    let type = container.querySelector(".field-type").value;

    if(type === "textbox" || type === "number"){
        container.querySelectorAll(".length-section")
                 .forEach(el => el.classList.remove("d-none"));
        container.querySelector(".options-section")
                 .classList.add("d-none");
    } else {
        container.querySelectorAll(".length-section")
                 .forEach(el => el.classList.add("d-none"));
        container.querySelector(".options-section")
                 .classList.remove("d-none");
    }
}


/* ===============================
   TAG SYSTEM
=================================*/
document.addEventListener("keypress", function(e){

    if(e.target.classList.contains("option-input") && e.key === "Enter"){
        e.preventDefault();
        let value = e.target.value.trim();
        if(value){
            addTag(e.target.closest(".custom-field-item"), value);
            e.target.value = "";
        }
    }

});

function addTag(container, value){

    let tagHtml = `
        <span class="badge bg-info me-1 tag-item">
            ${value}
            <span class="remove-tag ms-1" style="cursor:pointer;">×</span>
        </span>
    `;

    container.querySelector(".option-tags")
             .insertAdjacentHTML("beforeend", tagHtml);
}

document.addEventListener("click", function(e){
    if(e.target.classList.contains("remove-tag")){
        e.target.parentElement.remove();
    }
});


/* ===============================
   BEFORE SUBMIT → CONVERT TO JSON
=================================*/
document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("categoryForm");

    if(form){
        form.addEventListener("submit", function(){

            let allFields = [];

            document.querySelectorAll(".custom-field-item")
            .forEach((item, index) => {

                let field = {
                    name: item.querySelector(".field-name")?.value || '',
                    type: item.querySelector(".field-type")?.value || '',
                    min: item.querySelector(".field-min")?.value || null,
                    max: item.querySelector(".field-max")?.value || null,
                    required: item.querySelector(".field-required")?.checked ? 1 : 0,
                    active: item.querySelector(".field-active")?.checked ? 1 : 0,
                    options: []
                };

                item.querySelectorAll(".tag-item")
                .forEach(tag => {
                    let text = tag.textContent.trim();
                    field.options.push(text.slice(0, -1));
                });

                allFields.push(field);
            });

            let hiddenInput = document.getElementById("custom_fields_input");

            if(hiddenInput){
                hiddenInput.value = JSON.stringify(allFields);
            }

        });
    }

});
document.addEventListener("paste", function (e) {
    if (e.target.classList.contains("only-positive-number")) {
        let paste = (e.clipboardData || window.clipboardData).getData('text');
        if (/[^0-9]/.test(paste)) {
            e.preventDefault();
        }
    }
});
document.addEventListener("input", function (e) {
    if (e.target.classList.contains("only-positive-number")) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    }
});
</script>