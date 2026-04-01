@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-6">

            <h5 class="card-header">{{ isset($data) ? __('lang.edit') : __('lang.add') }}</h5>
            <form class="card-body" action="{{ isset($data) ? route('language.update') : route('language.store') }}" method="POST">
                @csrf
                @if(isset($data))
                <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="row g-6">

                    <!-- Language Code Dropdown -->
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">{{__('lang.language_code')}}</label>
                        <span class=" text-danger">*</span>
                        <select class="select2 form-control" name="code_id">
                            <option value="">{{__('lang.please_select')}}</option>
                            @if(count($code))
                            @foreach($code as $code_data)
                            <option value="{{ $code_data->id }}"
                                {{ (old('code_id', $data->code_id ?? '') == $code_data->id) ? 'selected' : '' }}>
                                {{ $code_data->code }} ({{ $code_data->name }})
                            </option>
                            @endforeach
                            @endif
                        </select>
                        @error('code_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Position Dropdown -->
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-price">{{__('lang.position')}}</label>
                        <span class=" text-danger">*</span>
                        <select class="form-control select2 form-select" name="position">
                            <option value="">{{__('lang.please_select')}}</option>
                            @foreach(config('constants.language_position') as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('position', $data->position ?? '') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('position')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Default Toggle Switch -->
                    <div class="col-md-12">
                        <label class="switch switch-square">
                            <input type="checkbox" class="switch-input" id="is_default" name="is_default"
                                {{ old('is_default', $data->is_default ?? false) ? 'checked' : '' }}>
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">{{__('lang.default')}}</span>
                        </label>
                    </div>

                </div>

                <div class="pt-6">
                   <button type="submit" class="btn btn-primary me-4">
                     {{ isset($data) ? __('lang.update') : __('lang.submit') }}
                      </button>
                    <a href="{{ route('language.index') }}" class="btn btn-label-secondary">{{__('lang.back')}}</a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
