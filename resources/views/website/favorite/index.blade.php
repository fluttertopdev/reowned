@extends('website.layout.app')
@section('content')

<div class="container">
  <div class="brudcrum brudcrum-defrent">
    <ul>
      <li>{{ __('lang.website.home_appliances') }}</li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="#" class="active">{{ __('lang.website.favorites') }}</a></li>
    </ul>
  </div>
</div>


<div class="edit-profile-saction">
  <div class="container">
    <div class="row">
       @include('website.profile_partial.menu')
      <div class="col-md-9">
        <div class="edit-profile-saction-right favorites-box-all">
          <div class="add-box-saction">
            <div class="total-add-saction favorites-box">
              <div class="row">
                @if(count($favoriteItems) > 0)
                    @foreach($favoriteItems as $row)
                      <div class="col-md-4"> 
                        <a href="{{ route('item.detail',$row->slug) }}">
                          <div class="recommendations-saction-shop-box" data-aos="fade-up" data-aos-duration="1000">
                            
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
                                <p>
                                    {{ \Illuminate\Support\Str::limit($row->title, 55, '...') }}
                                </p>
                    
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
                @else
                  <div class="no-ads-found">
                    <img src="{{asset('website_assets/images/no-chat-icon.png')}}">
                    <span>{{ __('lang.website.no_favorites_items_found') }}</span>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection