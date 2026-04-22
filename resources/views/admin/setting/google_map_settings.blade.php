@if($row->key == 'google_map_key')
<div class="col-md-12 mb-3 display-inline-block">
    <label class="form-label" for="google_map_key">{{__('lang.admin_google_map_key')}}</label>
    <input type="text" class="form-control" value="{{$row->value}}" name="google_map_key" placeholder="{{__('lang.admin_google_map_key_placeholder')}}">
</div>
@endif