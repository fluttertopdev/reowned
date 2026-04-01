@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">
            <h5 class="card-header">{{ isset($data) ? 'Edit City' : 'Add City' }}</h5>

            <form class="card-body"
                action="{{ isset($data) ? route('city.update') : route('city.store') }}"
                method="POST" enctype="multipart/form-data">

                @csrf
                @if(isset($data))

                <input type="hidden" name="id" value="{{ $data->id }}"> {{-- Hidden Input for Update --}}
                <input type="hidden" id="selected_state" value="{{ $data->state_id }}"> {{-- Hidden Input for JavaScript --}}
                <input type="hidden" id="selected_country" value="{{ $data->country_id }}"> {{-- Hidden Input for JavaScript --}}
                @endif

                <div class="row g-6">
                    <!-- Country Dropdown -->
                    <div class="col-md-12">
                        <label class="form-label">Country</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="country_id" id="country" required>
                            <option value="">Select Country</option>
                            @foreach ($countries as $id => $name)
                            <option value="{{ $id }}"
                                {{ isset($data) && $data->country_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State Dropdown -->
                    <div class="col-12">
                        <label class="form-label">State Name</label>
                        <span class="text-danger">*</span>
                        <select class="form-control select2 form-select" name="state_id" id="state" required>
                            <option value="">Select State</option>
                        </select>
                        @error('state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City Name Input -->
                    <div class="col-md-12">
                        <label class="form-label">City</label>
                        <span class="text-danger">*</span>
                        <input name="name" value="{{ old('name', $data->name ?? '') }}"
                            class="form-control" placeholder="City" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <div class="col-md-12">
                        <label class="form-label">Latitude</label>
                        <span class="text-danger">*</span>
                        <input name="latitude" value="{{ old('latitude', $data->latitude ?? '') }}"
                            class="form-control" placeholder="Latitude" required>
                        @error('latitude')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                     <div class="col-md-12">
                        <label class="form-label">longitude</label>
                        <span class="text-danger">*</span>
                        <input name="longitude" value="{{ old('longitude', $data->longitude ?? '') }}"
                            class="form-control" placeholder="Longitude" required>
                        @error('longitude')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" class="btn btn-primary me-4">
                        {{ isset($data) ? 'Update' : 'Submit' }}
                    </button>
                    <a href="{{ route('city.index') }}" class="btn btn-label-secondary">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection