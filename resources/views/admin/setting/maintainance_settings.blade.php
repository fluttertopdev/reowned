<div class="col-md-4 mt-4">
    <!-- Hidden input to send 0 when checkbox is unchecked -->
    <input type="hidden" name="enable_maintainance_mode" value="0">

    <label class="switch switch-square">
        <input value="1" type="checkbox" class="switch-input" id="enable_maintainance_mode" name="enable_maintainance_mode"
            {{ setting('enable_maintainance_mode') ? 'checked' : '' }}>
        <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
        </span>
        <span class="switch-label">{{ __('lang.admin_enable_maintainance_mode_placeholder') }}</span>
    </label>

</div>

<div class="col-md-8">
    <label class="form-label" for="maintainance_title">{{ __('lang.admin_maintainance_title') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" name="maintainance_title"
        value="{{ setting('maintainance_title') }}"
        placeholder="{{ __('lang.admin_maintainance_title_placeholder') }}" required>
</div>

<div class="col-md-12 mt-3 mb-3">
    <label class="form-label" for="maintainance_short_text">{{ __('lang.admin_maintainance_short_text') }}</label>
     <span class=" text-danger">*</span>
    <textarea class="form-control" name="maintainance_short_text"
        placeholder="{{ __('lang.admin_maintainance_short_text_placeholder') }}" required>{{ setting('maintainance_short_text') }}</textarea>
</div>
