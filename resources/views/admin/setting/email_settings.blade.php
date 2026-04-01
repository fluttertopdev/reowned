<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="mailer">{{ __('lang.admin_mailer') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.admin_mailer_placeholder') }}"
        name="mailer" value="{{ setting('mailer') }}" required/>
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="host">{{ __('lang.admin_host') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.admin_host_placeholder') }}"
        name="host" value="{{ setting('host') }}" required/>
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="port">{{ __('lang.admin_port') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.admin_port_placeholder') }}"
        name="port" value="{{ setting('port') }}" required/>
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="username">{{ __('lang.admin_username') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.admin_username_placeholder') }}"
        name="username" value="{{ setting('username') }}" required/>
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="password">{{ __('lang.admin_password') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.admin_password_placeholder') }}"
        name="password" value="{{ setting('password') }}" required/>
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="encryption">{{ __('lang.admin_encryption') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" placeholder="{{ __('lang.admin_encryption_placeholder') }}"
        name="encryption" value="{{ setting('encryption') }}" required/>
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="from_name">{{ __('lang.admin_from_name') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" name="from_name" placeholder="{{ __('lang.admin_from_name_placeholder') }}"
        value="{{ setting('from_name') }}" required>
</div>

<div class="col-md-3 mb-3 display-inline-block width-32-percent mr-10">
    <label class="form-label" for="from_email_address">{{ __('lang.admin_from_email_address') }}</label>
     <span class=" text-danger">*</span>
    <input type="text" class="form-control" name="from_email_address"
        placeholder="{{ __('lang.admin_from_email_address_placeholder') }}" value="{{ setting('from_email_address') }}" required>
</div>
