@if($row->key == 'enable_google_login')
<div class="col-md-12 mb-3 display-inline-block mr-10">
    <label class="switch switch-square">
        <input value="1" type="checkbox" class="switch-input" id="enable_google_login" name="enable_google_login" @if($row->value == 1) checked @endif>
        <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
        </span>
        <span class="switch-label">{{__('lang.admin_enable_google_login_placeholder')}}</span>
    </label>
</div>
@endif
@if($row->key == 'google_client_id')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label" for="google_client_id">{{__('lang.admin_google_client_id')}}</label>
    <input type="text" class="form-control" value="{{ \Helpers::maskApiKey($row->value) }}" name="google_client_id" placeholder="{{__('lang.admin_google_client_id_placeholder')}}">
</div>
@endif
@if($row->key == 'google_client_secret')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label" for="google_client_secret">{{__('lang.admin_google_client_secret')}}</label>
    <input type="text" class="form-control" value="{{ \Helpers::maskApiKey($row->value) }}" name="google_client_secret" placeholder="{{__('lang.admin_google_client_secret_placeholder')}}">
</div>
@endif
@if($row->key == 'google_redirect_url')
<div class="col-md-12 mb-3 display-inline-block">
    <label class="form-label" for="google_redirect_url">{{__('lang.admin_google_redirect_url')}}</label>
    <input type="text" class="form-control" value="{{$row->value}}" name="google_redirect_url" placeholder="{{__('lang.admin_google_redirect_url_placeholder')}}">
</div>
@endif