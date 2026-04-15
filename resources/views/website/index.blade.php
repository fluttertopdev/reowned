@extends('website.layout.app')
@section('content')

  <!--Categories-saction-->
  @if(count($homeCategories) > 0)
  <div class="container">
    <div class="Explore Popular Categories">
      <h2 data-aos="fade-up" data-aos-duration="1000">{{ __('lang.website.explore_popular_categories') }}</h2>
      <div class="blaze-slider home-banner-new">
        <div class="blaze-container">
          <div class="blaze-track-container">
            <button class="blaze-prev left-right" data-aos="fade-up" data-aos-duration="1000"><span><img src="{{asset('website_assets/images/left.png')}}"></span></button>
            <div class="blaze-track" data-aos="fade-up" data-aos-duration="1000">
              @foreach($homeCategories as $category)
              <div class="based-saction-box"> 
                <a href="{{url('category-detail/'.$category->slug)}}"> 
                  <img src="{{$category->image ? asset('uploads/category/'.$category->image) : asset('uploads/Image-not-found.png')}}" alt="#" class="home-cat-image"> 
                  <span>{{ $category->name }}</span> 
                </a> 
              </div>
              @endforeach
            </div>
          </div>
          <button class="blaze-next left-right" data-aos="fade-up" data-aos-duration="1000"><span><img
                src="{{asset('website_assets/images/right.png')}}"></span></button>
        </div>
        <!--<div class="blaze-pagination"></div>-->
      </div>
    </div>
  </div>
  @endif

  <!--Bringing-Fashion-->
  @if($bannerData)
  <div class="container">
    <div class="bringing-fashion-saction" data-aos="fade-up" data-aos-duration="1000">
      <div class="row">
        <div class="col-md-12">
          <div class="bringing-fashion-saction-right"> 
            <a target="_blank" href="{{$bannerData->link}}">
              <img src="{{ $bannerData->image ? asset('uploads/banner/'.$bannerData->image) : asset(
              'uploads/default-banner.png')}}" alt="#" data-aos="fade-up" data-aos-duration="1000" width="100%" height="424px"> 
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  <!--Recommendations-->
  @if(count($recommendateItemData) > 0)
  <div class="container">
    <div class="recommendations-saction">
      <h2 data-aos="fade-up" data-aos-duration="1000">{{ __('lang.website.recommendations') }}</h2>
      <a href="{{url('item/list?type=recommendation')}}" data-aos="fade-up" data-aos-duration="1000">{{ __('lang.website.view_all') }}</a>
      <div class="recommendations-saction-shop">
        <div class="row">
          @each('website.partial.item_list', $recommendateItemData, 'row')
        </div>
      </div>
    </div>
  </div>
  @endif

  <!--Popular-Item-->
  @if(count($popularItemData) > 0)
  <div class="container">
    <div class="recommendations-saction">
      <h2 data-aos="fade-up" data-aos-duration="1000">{{ __('lang.website.popular_items') }}</h2>
      <a href="{{url('item/list?type=popular')}}" data-aos="fade-up" data-aos-duration="1000">{{ __('lang.website.view_all') }}</a>
      <div class="recommendations-saction-shop">
        <div class="row">
          @each('website.partial.item_list', $popularItemData, 'row')
        </div>
      </div>
    </div>
  </div>
  @endif

  <!--Google ad banner-->
  <div class="container">
    <div class="google-ad-banner" data-aos="fade-up" data-aos-duration="1000"> <img
        src="{{asset('website_assets/images/google-banner.png')}}" alt="#"> </div>
  </div>

  <!--All-Item-->
  @if(count($allItemData) > 0)
  <div class="container">
    <div class="recommendations-saction all-itmes">
      <h2 data-aos="fade-up" data-aos-duration="1000">{{ __('lang.website.all_item') }}</h2>
      <div class="low-higy-price-box">
        <div class="select">
          <div class="selectBtn" data-type="firstOption">{{ __('lang.website.category') }}</div>
          <div class="selectDropdown">
            @foreach($homeCategories as $category)
              <div class="option category-option" data-id="{{ $category->id }}">
                {{ $category->name }}
              </div>
            @endforeach
          </div>
        </div>
        <div class="select">
          <div class="selectBtn" data-type="firstOption">
              {{ __('lang.website.price_low_to_high') }}
          </div>
          <div class="selectDropdown">
              <div class="option sort-option" data-sort="low_to_high">
                  {{ __('lang.website.low_to_high') }}
              </div>
              <div class="option sort-option" data-sort="high_to_low">
                  {{ __('lang.website.high_to_low') }}
              </div>
              <div class="option sort-option" data-sort="oldest">
                  {{ __('lang.website.oldest_to_newest') }}
              </div>
              <div class="option sort-option" data-sort="newest">
                  {{ __('lang.website.newest_to_oldest') }}
              </div>
          </div>
        </div>
      </div>
      <div class="recommendations-saction-shop">
        <div class="load-more-box">
          <div class="product-box">
            <div class="row" id="item-container">
              @include('website.partial.item_card_list',['items'=>$allItemData])
            </div>
          </div>
          @if($totalItemCount > 8)
            <div class="load-more text-center mt-4">
              <button class="btn-load btn btn-primary">{{ __('lang.website.load_more') }}</button>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endif

  <script>
    let offset = 8;
    let category_id = '';
    let sort_by = '';

    // CATEGORY FILTER
    $(document).on('click', '.category-option', function () {

        category_id = $(this).data('id');
        offset = 0;

        loadItems(true);
    });

    // SORT FILTER
    $(document).on('click', '.sort-option', function () {

        sort_by = $(this).data('sort');
        offset = 0;

        loadItems(true);
    });

    // LOAD MORE BUTTON
    $(document).on('click', '.btn-load', function () {
        loadItems(false);
    });

    function loadItems(reset = false) {

        $.ajax({
            url: "{{route('load.items')}}",
            type: "GET",
            data: {
                offset: offset,
                category_id: category_id,
                sort_by: sort_by
            },
            success: function (response) {

                if (reset) {
                    $('#item-container').html(response);
                    offset = 8;
                } else {

                    if (response.trim() == '') {
                        $('.btn-load').hide();
                    } else {
                        $('#item-container').append(response);
                        offset += 8;
                    }
                }
            }
        });
    }
</script>
@endsection