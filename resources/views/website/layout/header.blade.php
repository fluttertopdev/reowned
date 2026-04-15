<!--Top-Header-->
<div id="myHeader" class="header-saction">
  <div class="container">
    <div class="header-saction-inner">
      <div class="row">
        <div class="col-md-2">
          <a href="{{url('/')}}">
            <img src="{{url('uploads/setting/'.setting('logo'))}}" alt="LOGO">
          </a>
        </div>
        <div class="col-md-10">
          <div class="header-right">
            <div class="search-loaction-box">
              <button id="openModalBtn">
                  <span id="currentLocation">{{ __('lang.website.select_location') }}</span>
                  <img src="{{asset('website_assets/images/icons-outline.svg')}}" class="icon-map">
              </button>
            </div>
            <div class="all-cetagory-box">
              <div class="low-higy-price-box">
                <div class="select">
                  @php
                    $currentSlug = request()->segment(2) ?? 'all';
                  @endphp
                  <div class="selectBtn option" data-type="{{ $currentSlug }}">
                    @if($currentSlug == 'all')
                        {{ __('lang.website.all_categories') }}
                    @else
                        {{ optional($headerCategories->firstWhere('slug', $currentSlug))->name ?? __('lang.website.all_categories') }}
                    @endif
                  </div>
                  <div class="selectDropdown">
                    <!-- ALL -->
                    <div class="option {{ $currentSlug == 'all' ? 'active' : '' }}" data-type="all">
                        <a>{{ __('lang.website.all_categories') }}</a>
                    </div>

                    <!-- FIRST 6 -->
                    @foreach($headerCategories as $category)
                        <div class="option {{ $currentSlug == $category->slug ? 'active' : '' }}" 
                             data-type="{{ $category->slug }}">
                            <a>{{ $category->name }}</a>
                        </div>
                    @endforeach

                    <!-- MORE BUTTON -->
                    @if($otherCategories->count() > 6)
                        <div class="more-toggle" id="moreBtn">
                            <a>+ {{ __('lang.website.more') }}</a>
                        </div>

                        <!-- REMAINING -->
                        <div id="moreCategories" style="display:none;">
                            @foreach($otherCategories as $category)
                                <div class="option {{ $currentSlug == $category->slug ? 'active' : '' }}" 
                                     data-type="{{ $category->slug }}">
                                    <a>{{ $category->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                  </div>
                </div>
              </div>
              <section class="main">
                <form class="search" method="get" action="{{url('category-detail')}}">
                  <input 
                    type="text" 
                    name="search" 
                    placeholder="{{ __('lang.website.search_placeholder') }}" 
                    value="{{ request('search') }}"
                  />
                  <img src="{{asset('website_assets/images/uil_search.svg')}}" class="search-button">
                </form>
              </section>
            </div>
            @if(!Auth::guard('web')->check())

              <div class="sell-button">
                  <a href="#" class="login-btn">{{ __('lang.website.login') }}</a>
              </div>

              <div class="sell-button">
                  <a href="#" class="register-btn">{{ __('lang.website.register') }}</a>
              </div>

            @else

              <div class="user-box-profile">
                  <a href="{{ url('profile') }}">
                      <img src="{{ asset('website_assets/images/user.svg') }}">
                  </a>
              </div>

              <div class="sell-button"><a href="{{url('sell')}}">{{ __('lang.website.sell') }} 
                <img src="{{asset('website_assets/images/pluse.svg')}}"></a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Sacend-Header-->
@if(count($mainCategories) > 0)
<div class="nav-bar-saction">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button id="menuToggle" class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse slide-menu" id="navbarSupportedContent">
        <button class="close-btn" id="closeMenu"><span>&times;</span></button>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          @foreach($mainCategories as $category)
            <li class="nav-item dropdown dropdown-hover">
              <a class="nav-link dropdown-toggle"
                 href="{{ url('category-detail/'.$category->slug) }}">
                 {{ $category->name }}
              </a>

              @if($category->children->count() > 0)
              <div class="dropdown-menu" style="width: 300px;">
                  <div class="container">
                      <div class="row">

                          @foreach($category->children->chunk(6) as $chunk)
                              <div class="col-md-6">
                                  <div class="list-group list-group-flush">
                                      @foreach($chunk as $sub)
                                          <a href="{{ url('category-detail/'.$sub->slug) }}"
                                             class="list-group-item list-group-item-action">
                                             {{ $sub->name }}
                                          </a>
                                      @endforeach
                                  </div>
                              </div>
                          @endforeach

                      </div>
                  </div>
              </div>
              @endif

            </li>
          @endforeach


        {{-- OTHER MENU --}}
        @if($otherCategories->count() > 0)
          <li class="nav-item dropdown dropdown-hover position-static">

            <span class="nav-link other-trigger">
                {{ __('lang.website.other') }} <strong> > </strong>
            </span>

            <div class="dropdown-menu dropdown-niv3 border-0 shadow">
              <div class="mega-wrapper">

                  @foreach($otherCategories as $category)
                      <div class="mega-col">

                          <a href="{{ url('category-detail/'.$category->slug) }}"
                             class="mega-heading">
                              <strong>{{ $category->name }}</strong>
                          </a>

                          @if($category->children->count() > 0)
                          <ul class="mega-list">
                              @foreach($category->children->take(6) as $sub)
                                  <li class="mega-list-child">
                                      <a href="{{ url('category-detail/'.$sub->slug) }}">
                                          {{ $sub->name }}
                                      </a>
                                  </li>
                              @endforeach
                          </ul>
                          @endif

                      </div>
                    @endforeach
                </div>
              </div>
            </li>
          @endif

          </ul>
      </div>
    </nav>
  </div>
</div>
@endif