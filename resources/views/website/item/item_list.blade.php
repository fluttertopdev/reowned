@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum">
      <ul>
        <li><a href="{{url('/')}}">{{ __('lang.website.home') }}</a></li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li class="mt-3">
          <a href="#" class="active">
            @if($type == 'recommendation')
                {{ __('lang.website.recommended_for_you') }}
            @elseif($type == 'popular')
                {{ __('lang.website.popular_in_your_area') }}
            @else
                {{ __('lang.website.all_items') }}
            @endif
          </a>
        </li>
      </ul>
    </div>
    <div class="designer-row-box-saction">
      <div class="row">
        <div class="col-md-12">
          <div class="desginer-right-box home-apliances-right recommendations-page">
            <div class="tabs">
              <div class="tab-left-right">
                <h5>{{ __('lang.website.item_lists') }}</h5>
                <div class="tab-right-box">
                  <div class="grid-list-button">
                    <button class="list-view on"><img src="{{asset('website_assets/images/list-btn.png')}}"></button>
                    <button class="grid-view active"><img src="{{asset('website_assets/images/grid-btn.png')}}"></button>
                  </div>
                </div>
              </div>

              <div id="tabs-content">
                <div class="wrapper list">
                  <div id="tab1" class="tab-content">
                    <div class="body-tab">
                      <div class="recommendations-saction-shop">
                        <div class="row">
                          @include('website.partial.item_card_list',['items'=>$allItemData])
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection