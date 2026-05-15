@if($row->key == 'pusher_app_id')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label">{{__('lang.admin_pusher_app_id')}}</label>
    <input type="text"
           class="form-control"
           name="pusher_app_id"
           placeholder="{{__('lang.admin_pusher_app_id_placeholder')}}"
           value="{{$row->value}}">
</div>
@endif

@if($row->key == 'pusher_app_key')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label">{{__('lang.admin_pusher_app_key')}}</label>
    <input type="text"
           class="form-control"
           name="pusher_app_key"
           placeholder="{{__('lang.admin_pusher_app_key_placeholder')}}"
           value="{{$row->value}}">
</div>
@endif

@if($row->key == 'pusher_app_secret')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label">{{__('lang.admin_pusher_app_secret')}}</label>
    <input type="text"
           class="form-control"
           name="pusher_app_secret"
           placeholder="{{__('lang.admin_pusher_app_secret_placeholder')}}"
           value="{{$row->value}}">
</div>
@endif

@if($row->key == 'pusher_app_cluster')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label">{{__('lang.admin_pusher_app_cluster')}}</label>
    <input type="text"
           class="form-control"
           name="pusher_app_cluster"
           placeholder="{{__('lang.admin_pusher_app_cluster_placeholder')}}"
           value="{{$row->value}}">
</div>
@endif