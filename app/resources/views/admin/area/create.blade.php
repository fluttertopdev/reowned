@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>

            <form class="card-body"
                action="{{ isset($data) ? route('area.update') : route('area.store') }}"
                method="POST">

                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" id="selected_state" value="{{ $data->state_id }}">
                <input type="hidden" id="selected_country" value="{{ $data->country_id }}">
                <input type="hidden" id="selected_city" value="{{ $data->city_id }}">
                @endif

                <div class="row g-6">
                    <!-- Country Dropdown -->
                    <div class="col-md-12">
                        <label class="form-label">{{__('lang.country')}}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="country_id" id="country" required>
                            <option value="">{{__('lang.select_country')}}</option>
                            @foreach ($countries as $id => $name)
                            <option value="{{ $id }}" {{ isset($data) && $data->country_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State Dropdown -->
                    <div class="col-md-12">
                        <label class="form-label">{{__('lang.state')}}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="state_id" id="state" required>
                            <option value="">{{__('lang.select_state')}}</option>
                        </select>
                        @error('state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City Dropdown -->
                    <div class="col-md-12">
                        <label class="form-label">{{__('lang.city')}}</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="city_id" id="city" required>
                            <option value="">{{__('lang.select_city')}}</option>
                        </select>
                        @error('city_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Area Name Input -->
                    <div class="col-md-12">
                        <label class="form-label">{{__('lang.area')}}</label>
                        <span class="text-danger">*</span>
                        <textarea name="name" value="{{ old('name', $data->name ?? '') }}"
                            class="form-control" placeholder="Area" required>{{ old('name', $data->name ?? '') }}</textarea>

                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{ route('area.index') }}" class="btn btn-label-secondary">
                        {{__('lang.back')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
