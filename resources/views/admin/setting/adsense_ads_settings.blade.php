@if($row->key == 'enable_adsense_horizontal_ad')
<div class="col-md-12 mb-3 display-inline-block mr-10">
    <label class="switch switch-square">
        <input value="1" type="checkbox" class="switch-input" id="enable_adsense_horizontal_ad" name="enable_adsense_horizontal_ad" @if($row->value == 1) checked @endif>
        <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
        </span>
        <span class="switch-label">{{__('lang.admin_enable_adsense_horizontal_ad_placeholder')}}</span>
    </label>
</div>
@endif
@if($row->key == 'adsense_horizontal_ad_client')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label" for="adsense_horizontal_ad_client">{{__('lang.admin_adsense_horizontal_ad_client')}}</label>
    <input type="text" class="form-control" name="adsense_horizontal_ad_client" placeholder="{{__('lang.admin_adsense_horizontal_ad_client_placeholder')}}" value="{{$row->value}}">
</div>
@endif
@if($row->key == 'adsense_horizontal_ad_slot')
<div class="col-md-6 mb-3 display-inline-block">
    <label class="form-label" for="adsense_horizontal_ad_slot">{{__('lang.admin_adsense_horizontal_ad_slot')}}</label>
    <input type="text" class="form-control" name="adsense_horizontal_ad_slot" placeholder="{{__('lang.admin_adsense_horizontal_ad_slot_placeholder')}}" value="{{$row->value}}">
</div>
@endif