@extends('website.layout.app')
@section('content')

  <div class="container">
      <div class="brudcrum brudcrum-defrent">
          <ul>
              <li><a href="{{url('/')}}">{{ __('lang.website.home') }}</a></li>
              <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
              <li><a href="#" class="active">{{ __('lang.website.sell') }}</a></li>
          </ul>
      </div>
  </div>

  <div class="sell-all-seaction">
      <div class="container">
          <h2>{{ __('lang.website.select_category') }}</h2>
          <div class="sell-all-seaction-inner">
              <div class="row">
                  <div class="col-md-4">
                      <div class="sell-all-seaction-left">
                          <h4>{{ __('lang.website.all_category') }}</h4>

                          <ul id="categoryList">
                              @foreach($categories as $index => $category)
                                  <li class="category-item {{ $index == 0 ? 'active' : '' }} {{ $index >= 10 ? 'd-none extra-category' : '' }}"
                                      data-id="{{ $category->id }}">
                                      <a href="javascript:void(0)">
                                        <img src="{{asset('uploads/category/'.$category->image)}}" class="sell-icon-black">
                                          {{ $category->name }}
                                      </a>
                                  </li>
                              @endforeach
                          </ul>

                          @if($categories->count() > 10)
                              <div class="load-more-btn">
                                  <button id="loadMoreBtn">{{ __('lang.website.load_more') }}</button>
                              </div>
                          @endif
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="home-appliances-right">
                          <h2 id="categoryTitle">
                              {{ $firstCategory->name ?? '' }}
                              <span>({{ __('lang.website.all_subcategory') }})</span>
                          </h2>

                          <div class="home-appliances-list">
                              <div class="row" id="subcategoryContainer">
                                  {{-- Subcategories will load here via AJAX --}}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection