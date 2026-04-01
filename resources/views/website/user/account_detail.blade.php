@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum">
      <ul>
        <li><a href="{{'/'}}">Home</a></li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">Designer</a></li>
      </ul>
    </div>
    <div class="designer-row-box-saction">
      <div class="row">
        <div class="col-md-4">
          <div class="desginer-left-box">
            <div class="sell-informaction">
              <h3>Seller information</h3>
              <ul>
                <li> <a href="#" class="open-box-soler"><img
                      src="{{asset('website_assets/images/solar_share-linear.svg')}}"></a>
                  <div class="solar-share-box">
                    <ul>
                      <li><a href="#"><img src="{{asset('website_assets/images/solor-icon-1.png')}}"> Facebook</a></li>
                      <li><a href="#"><img src="{{asset('website_assets/images/solor-icon-2.png')}}"> X</a></li>
                      <li><a href="#"><img src="{{asset('website_assets/images/solor-icon-3.png')}}"> WhatsApp</a></li>
                      <li><a href="#"><img src="{{asset('website_assets/images/solor-icon-4.png')}}"> Copy link</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
            <div class="designer-box">
              <div class="designer-box-image"> 
                @php
                  $image = !empty($user->image) 
                    ? asset('uploads/user/' . $user->image) 
                    : asset('website_assets/images/parofile-image.png');
                @endphp
                <img src="{{$image}}" alt="#">
              </div>
              <div class="designer-box-text"> <span>{{$user->name}}</span>
                <p>{{ $user->email }}</p>
                <p>Member since: {{ date('Y', strtotime($user->created_at)) }}</p>
              </div>
              <a href="#" class="desiginer-link"><img
                  src="{{asset('website_assets/images/sms-black.svg')}}">{{ $user->email }}</a> <a href="tel:{{ $user->phone }}"
                class="desiginer-link"><img src="{{asset('website_assets/images/call-black.svg')}}">{{ $user->phone }}</a>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="desginer-right-box">
            <div class="tabs">
              <div class="tab-left-right">
                <ul id="tabs-nav">
                  <li><a href="#tab1">Live Ads</a></li>
                  <li><a href="#tab2">Reviews</a></li>
                </ul>
                <div class="tab-right-box">
                  <div class="short-by-btn">
                    <div class="select">
                      <div class="selectBtn" data-type="firstOption">Newest to oldest</div>
                      <div class="selectDropdown">
                        <div class="option sort-option" data-sort="low_to_high">Low to High</div>
                        <div class="option sort-option" data-sort="high_to_low">High to Low</div>
                        <div class="option sort-option" data-sort="oldest">Oldest to Newest</div>
                        <div class="option sort-option" data-sort="newest">Newest to Oldest</div>
                      </div>
                    </div>
                  </div>
                  <div class="grid-list-button">
                    <button class="list-view on active"><img
                        src="{{asset('website_assets/images/list-btn.png')}}"></button>
                    <button class="grid-view"><img src="{{asset('website_assets/images/grid-btn.png')}}"></button>
                  </div>
                </div>
              </div>
              <!-- END tabs-nav -->
              <div id="tabs-content">
                <div class="wrapper list">
                  <div id="tab1" class="tab-content">
                    <div class="body-tab">
                      <div class="recommendations-saction-shop list-boxlayout">
                        <div class="row" id="item-container">
                          @include('website.partial.item_card_list_account',['items'=>$allItemData])
                        </div>
                        @if($totalItemCount > 8)
                          <div class="load-more text-center mt-4">
                            <button class="btn-load">Load More</button>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div id="tab2" class="tab-content">
                    <div class="body-tab">
                      <div class="reviews-found">
                        <img src="{{asset('website_assets/images/confused-postman.png')}}">
                        <h4>No Reviews Found</h4>
                        <p>We're sorry what you were looking for. please try another way</p>
                      </div>
                    </div>
                  </div>
                  <!-- END tabs-content -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-4.0.0.min.js"
    integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function () {
      $('.grid-view').on('click', function () {
        // Remove list layout and update button states
        $('.recommendations-saction-shop').removeClass('list-boxlayout');

        // Toggle button classes
        $('.grid-view').addClass('on active');
        $('.list-view').removeClass('on active');
      });

      $('.list-view').on('click', function () {
        // Add list layout and update button states
        $('.recommendations-saction-shop').addClass('list-boxlayout');

        // Toggle button classes
        $('.list-view').addClass('on active');
        $('.grid-view').removeClass('on active');
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#tabs-nav li a').on('click', function (e) {
        e.preventDefault(); // prevent default anchor behavior

        const target = $(this).attr('href');

        if (target === '#tab2') {
          $('.tab-right-box').addClass('reviews-filtr-non');
        } else if (target === '#tab1') {
          $('.tab-right-box').removeClass('reviews-filtr-non');
        }

        // Optional: if you're using tabs and want to show/hide content
        $('.tab-content').hide(); // hide all tab content
        $(target).show(); // show selected tab content
      });
    });
  </script>
  <script>
    let offset = 8;
    let sort = 'newest';
    let loading = false;

    $('.btn-load').click(function(){

        if(loading) return;

        loading = true;

        $.ajax({

            url: "{{ route('ajax.load.items') }}",
            type: "GET",
            data:{
                offset: offset,
                sort: sort
            },

            success:function(response){

                if(response.count > 0){

                    $('#item-container').append(response.html);

                    offset += 8;

                }else{

                    $('.load-more').hide();

                }

                loading = false;

            }

        });

    });

    $('.sort-option').click(function(){

      sort = $(this).data('sort');

      offset = 0;

      $.ajax({

          url: "{{ route('ajax.load.items') }}",
          type: "GET",
          data:{
              offset: offset,
              sort: sort
          },

          success:function(response){

              $('#item-container').html(response.html);

              offset = 8;

              $('.load-more').show();

          }

      });

  });
  </script>

@endsection