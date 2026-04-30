@if(!empty($rows) && count($rows))

  @foreach($rows as $row)
    <div class="row mb-4">

      @foreach($row as $item)
        <div class="col-md-3"> 
          <a href="{{ route('item.detail',$item->slug) }}">
            <div class="recommendations-saction-shop-box" data-aos="fade-up" data-aos-duration="1000">
              
              <div class="product-box-image">

                <img src="{{ isset($item->latestImage) ? url($item->latestImage?->image) : url('uploads/Image-not-found.png') }}" class="item-list-img">

                <a href="javascript:void(0)"
                   class="hart toggle-favorite"
                   data-item="{{ $item->id }}"
                   data-add="{{ asset('website_assets/images/hart-red.png') }}"
                   data-remove="{{ asset('website_assets/images/hart.svg') }}">

                    @php
                    $icon = $item->is_favorite ? 'hart-red.png' : 'hart.svg';
                    @endphp

                    <img src="{{asset('website_assets/images/'.$icon)}}" class="favorite-img">

                </a>

              </div>

              <div class="product-box-text">
                <span>{{ \Helpers::commonCurrencyFormate().$item->price }}</span>
                <p>{{ $item->title }}</p>

                <div class="ul-li">
                  <em>
                    <img src="{{asset('website_assets/images/map-small.svg')}}">
                    {{ $item->area != '' ? $item->area . ', ' . $item->city : '' }}
                  </em>

                  <h6>{{ $item->created_at->diffForHumans() }}</h6>
                </div>

              </div>
            </div>
          </a> 
        </div>
      @endforeach

    </div>
  @endforeach

@else
  <p class="text-center mb-3">{{ __('lang.website.no_item_found') }}</p>
@endif