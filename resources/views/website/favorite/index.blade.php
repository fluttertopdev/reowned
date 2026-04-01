@extends('website.layout.app')
@section('content')

<div class="container">
  <div class="brudcrum brudcrum-defrent">
    <ul>
      <li>Home appliances</li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="#" class="active">Favorites</a></li>
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
                  @each('website.partial.item_list', $favoriteItems, 'row')
                @else
                  <div class="no-ads-found">
                    <img src="{{asset('website_assets/images/no-chat-icon.png')}}">
                    <span>No favourites items found</span>
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