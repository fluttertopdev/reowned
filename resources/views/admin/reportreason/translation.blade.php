@extends('admin.layout.app')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <!-- Add Product -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1">{{__('lang.translation')}}</h4>
                </div>
            </div>

            <div class="row">
                <form id="productform" action="{{ route('reportreason.updatetranslate', $reason->id) }}" method="POST">
                    @csrf

                    <!-- First column -->
                    <div class="col-12 col-lg-12">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-body">
                                @foreach ($languages as $language)
                                <div class="border rounded p-4 mb-4">
                                    <!-- Title Section -->
                                    <div class="form-group mb-4">
                                        <label for="translated-name-{{ $language->language_code }}" class="form-label">
                                            {{__('lang.reason')}} ({{ $language->reason }})
                                        </label>
                                        <span class=" text-danger">*</span>
                                        <input type="hidden" name="translation_id[]" value="{{ $language->details->id ?? null }}">
                                        <input type="hidden" name="language_code[]" value="{{ $language->code }}">
                                        <input type="text" class="form-control @error('reason.' . $loop->index) is-invalid @enderror"
                                            id="translated-name-{{ $language->language_code }}"
                                            name="reason[]"

                                            value="{{ old('reason.' . $loop->index, $language->details->reason ?? '') }}">

                                        <!-- Validation Error Message -->
                                        @error('name.' . $loop->index)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>
                                @endforeach



                                <div class="pt-6">
                                    <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                                    <a href="{{route('advertisement-package.index')}}"
                                        class="btn btn-label-secondary">
                                        {{__('lang.back')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
