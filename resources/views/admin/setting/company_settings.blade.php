<h5 class="font-weight-bold mt-2 mb-2">{{__('lang.general_settings')}}</h5>
<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="mailer">{{ __('lang.name') }}</label>
    <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.name') }}"
        name="name" value="{{ setting('name') }}" required />
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="host">{{ __('lang.email') }}</label>
    <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.email') }}"
        name="email" value="{{ setting('email') }}" required />
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="contact_number1">{{ __('lang.contact_number1') }}</label>
    <span class="text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.contact_number1') }}"
        name="contact_number1" value="{{ setting('contact_number1') }}"
        required maxlength="12" pattern="[0-9]+" title="Only numbers are allowed, max 12 digits" />
</div>



<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="contact_number1">{{ __('lang.contact_number2') }}</label>
    <span class="text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.contact_number2') }}"
        name="contact_number2" value="{{ setting('contact_number2') }}"
        required maxlength="12" pattern="[0-9]+" title="Only numbers are allowed, max 12 digits" />
</div>


<div class="col-md-12 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="mailer">{{ __('lang.address') }}</label>
    <span class=" text-danger">*</span>
    <textarea type="text" class="form-control" placeholder="{{ __('lang.address') }}"
        name="address" value="{{ setting('address') }}" required />{{ setting('address') }}</textarea>

</div>
<div class="row">
    @foreach($result as $row)
        @if($row->key == 'logo')
        <div class="col-md-4 mt-3">
            <label class="form-label">{{__('lang.logo')}}</label>
            <span class="text-danger">*</span>
            <div class="d-flex">
                <img src="{{ url('uploads/setting/'.$row->value) }}" class="rounded me-50" id="site-logo-preview" alt="logo" height="80" width="80"
                    onerror="this.onerror=null;this.src='{{ asset('uploads/no-image.png') }}'" />
                <div class="mt-75 ms-1">
                    <label class="btn btn-primary me-75 mb-0" for="change-site-logo">
                        {{__('lang.upload')}}
                        <input type="file" name="logo" id="change-site-logo" hidden accept="image/*"
                            onchange="showImagePreview(this, 'site-logo-preview');" />
                    </label>
                </div>
            </div>
        </div>
        @endif

        @if($row->key == 'footer_logo')
        <div class="col-md-4 mt-3">
            <label class="form-label">{{__('lang.footer_logo')}}</label>
            <span class="text-danger">*</span>
            <div class="d-flex">
                <img src="{{ url('uploads/setting/'.$row->value) }}" class="rounded me-50" id="site-footer-logo-preview" alt="footer_logo" height="80" width="80"
                    onerror="this.onerror=null;this.src='{{ asset('uploads/no-image.png') }}'" />
                <div class="mt-75 ms-1">
                    <label class="btn btn-primary me-75 mb-0" for="change-site-footer-logo">
                        {{__('lang.upload')}}
                        <input type="file" name="footer_logo" id="change-site-footer-logo" hidden accept="image/*"
                            onchange="showImagePreview(this, 'site-footer-logo-preview');" />
                    </label>
                </div>
            </div>
        </div>
        @endif

        @if($row->key == 'favicon')
        <div class="col-md-4 mt-3">
            <label class="form-label">{{__('lang.favicon')}}</label>
            <span class="text-danger">*</span>
            <div class="d-flex">
                <img src="{{ url('uploads/setting/'.$row->value) }}" class="rounded me-50" id="favicon-preview" alt="favicon" height="80" width="80"
                    onerror="this.onerror=null;this.src='{{ asset('uploads/no-image.png') }}'" />
                <div class="mt-75 ms-1">
                    <label class="btn btn-primary me-75 mb-0" for="change-favicon">
                        {{__('lang.upload')}}
                        <input type="file" name="favicon" id="change-favicon" hidden accept="image/*" onchange="showImagePreview(this, 'favicon-preview');" />
                    </label>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    
    @foreach($result as $row)
        @if($row->key == 'currency')
        <div class="col-md-6 mt-3">
            <label class="form-label">{{__('lang.currency')}}</label>
            <span class=" text-danger">*</span>
            <input type="text" class="form-control" name="currency" value="{{ $row->value }}" placeholder="{{__('lang.currency')}}" required>
        </div>
        @endif
    @endforeach

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.showImagePreview = function(input, previewId) {
            if (input && input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
    });
</script>