@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>

            <form class="card-body"
                action="{{ isset($data) ? route('state.update') : route('state.store') }}"
                method="POST" enctype="multipart/form-data">

                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">


                    <div class="row g-6">
                        <!-- Country Dropdown -->
                        <div class="col-md-12">
                            <label class="form-label">{{__('lang.country')}}</label>
                            <span class="text-danger">*</span>
                            <select class="form-control select2 form-select" name="country_id" required>
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

                        <div class="col-md-12">
                            <label class="form-label">{{__('lang.state')}}</label>
                            <span class=" text-danger">*</span>
                            <div class="">
                                <input name="name" value="{{ old('name', $data->name ?? '') }}" class="form-control" placeholder="State">
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-6">
                         <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                        <a href="{{route('state.index')}}"
                            class="btn btn-label-secondary">
                            {{__('lang.back')}}
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection
