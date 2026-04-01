@foreach($items as $row)
	<div class="col-md-4"> 
	  <a href="{{ route('item.detail',$row->slug) }}">
	    <div class="recommendations-saction-shop-box">
	      <div class="product-box-image">
	        <img src="{{ isset($row->latestImage) ? url($row->latestImage?->image) : url('uploads/Image-not-found.png') }}" class="item-list-img">
	        <a href="javascript:void(0)"
	           class="hart toggle-favorite"
	           data-item="{{ $row->id }}"
	           data-add="{{ asset('website_assets/images/hart-red.png') }}"
	           data-remove="{{ asset('website_assets/images/hart.svg') }}">

	            @php
	            $icon = $row->is_favorite ? 'hart-red.png' : 'hart.svg';
	            @endphp

	            <img src="{{asset('website_assets/images/'.$icon)}}" class="favorite-img">
	        </a>
	      </div>
	      <div class="product-box-text">
	        <span>{{ \Helpers::commonCurrencyFormate().$row->price }}</span>
	        <p>{{ $row->title }}</p>
	        <div class="ul-li">
	          <em>
	            <img src="{{asset('website_assets/images/map-small.svg')}}">
	            {{ $row->area != '' ? $row->area . ', ' . $row->city : '' }}
	          </em>

	          <h6>{{ $row->created_at->diffForHumans() }}</h6>
	        </div>
	      </div>
	    </div>
	  </a> 
	</div>
@endforeach