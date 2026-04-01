@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
           <h5 class="card-header">{{ $data ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('advertisement-package.update') : route('advertisement-package.store') }}" method="POST" enctype="multipart/form-data" id="description-form-ads">
                @csrf
                @if(isset($data))
                    <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.name')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" name="name" class="form-control" placeholder="{{__('lang.name')}}" value="{{ old('name', $data->name ?? '') }}" />
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.price') }}</label>
                        <span class="text-danger">*</span>
                        <input type="number"
                               id="price"
                               name="price"
                               class="form-control"
                               placeholder="{{ __('lang.price') }}"
                               value="{{ old('price', $data->price ?? '') }}"
                               min="0"
                               step="0.01"
                               oninput="this.value = this.value.replace(/[^0-9.]/g, '')" />
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Discount -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('lang.discount') }} (%)</label>
                        <span class="text-danger">*</span>
                        <input type="number"
                               id="discount"
                               name="discount"
                               class="form-control"
                               placeholder="{{ __('lang.discount') }}"
                               value="{{ old('discount', $data->discount ?? '') }}"
                               min="0"
                               max="100"
                               oninput="this.value = this.value.replace(/[^0-9.]/g, '')" />
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Final -->
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="multicol-final-price">{{__('lang.final_price')}}</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="final_price" class="form-control" name="final_price" 
                                       value="{{ old('final_price', $data->final_price ?? '') }}" placeholder="Final Price" readonly />
                            </div>
                        </div>
                    </div>
                    <!-- Days Selection -->
                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.days')}}</label>
                        <span class=" text-danger">*</span>
                        <div class="col mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="limited" id="days-limited" name="days" 
                                       {{ old('days', $data->days ?? 'limited') == 'limited' ? 'checked' : '' }} onclick="toggleInput('days', true)" />
                                <label class="form-check-label" for="days-limited">{{__('lang.limited')}}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="unlimited" name="days" id="days-unlimited" 
                                       {{ old('days', $data->days ?? '') == 'unlimited' ? 'checked' : '' }} onclick="toggleInput('days', false)" />
                                <label class="form-check-label" for="days-unlimited">{{__('lang.unlimited')}}</label>
                                <span class=" text-danger">*</span>
                            </div>
                        </div>
                        @error('days') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- No. of Days Input -->
                    <div class="col-md-6" id="days-input">
                        <label class="form-label">{{__('lang.no_days')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" class="form-control" name="no_of_days" placeholder="{{__('lang.no_days')}}" value="{{ old('no_of_days', $data->no_of_days ?? '') }}"  oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>
                    </div>

                    <!-- Item Selection -->
                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.item')}}</label>
                        <span class=" text-danger">*</span>
                        <div class="col mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="limited" id="item-limited" name="item" 
                                       {{ old('item', $data->item ?? 'limited') == 'limited' ? 'checked' : '' }} onclick="toggleInput('item', true)" />
                                <label class="form-check-label" for="item-limited">{{__('lang.limited')}}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="unlimited" name="item" id="item-unlimited" 
                                       {{ old('item', $data->item ?? '') == 'unlimited' ? 'checked' : '' }} onclick="toggleInput('item', false)" />
                                <label class="form-check-label" for="item-unlimited">{{__('lang.unlimited')}}</label>
                                <span class=" text-danger">*</span>
                            </div>
                        </div>
                        @error('item') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- No. of Items Input -->
                    <div class="col-md-6" id="item-input">
                        <label class="form-label">{{__('lang.no_item')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="text" class="form-control" name="no_of_item" placeholder="{{__('lang.no_item')}}" value="{{ old('no_of_item', $data->no_of_item ?? '') }}"  oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mt-2">
                        <label class="form-label" for="description">{{__('lang.description')}}</label>
                        <span class="text-danger">*</span>

                        <!-- Quill Editor -->
                        <div id="full-editor" style="height: 300px;"></div>

                        <!-- Hidden textarea for storing content -->
                        <textarea name="description" id="description-ads" hidden>{{ old('description', $data->description ?? '') }}</textarea>

                        <span class="text-danger" id="description-error-ads">
                            @error('description') {{ $message }} @enderror
                        </span>
                    </div>


                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image')}}</label>
                        <span class=" text-danger">*</span>
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" />
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Image Preview -->
                    <div class="col-md-6">
                        <label class="form-label">{{__('lang.image_preview')}}</label>
                        <span class=" text-danger">*</span>
                        <img id="image-preview" src="{{ isset($data->image) ? asset('uploads/packages/'.$data->image) : asset('uploads/Image-not-found.png') }}" 
                             alt="Image Preview" style="width: 200px; border: 1px solid #ccc; display: block;" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                      <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{route('item-listing-package.index')}}" 
                     class="btn btn-label-secondary">
                       {{__('lang.back')}}
                       </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const priceInput = document.getElementById('price');
        const discountInput = document.getElementById('discount');
        const finalPriceInput = document.getElementById('final_price');

        function calculateFinalPrice() {
            let price = parseFloat(priceInput.value) || 0;
            let discount = parseFloat(discountInput.value) || 0;

            // Prevent invalid discount
            if (discount > 100) discount = 100;
            if (discount < 0) discount = 0;

            let final = price - (price * discount / 100);

            finalPriceInput.value = final.toFixed(2);
        }

        // Trigger on change
        priceInput.addEventListener('input', calculateFinalPrice);
        discountInput.addEventListener('input', calculateFinalPrice);

        // Trigger on page load (for edit form)
        calculateFinalPrice();
    });
</script>

@endsection