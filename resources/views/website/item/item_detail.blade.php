@extends('website.layout.app')
@section('content')

<div class="product-detals-saction">
  <div class="container">
    <div class="brudcrum">
      <ul>
        <li><a href="{{url('/')}}">Home</a></li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">{{ $item->title }}</a></li>
      </ul>
    </div>
    <div class="product-row-box-saction">
      <div class="row">
        <div class="col-md-8">
          <div class="product-slider-container">
            <div class="thumbnail_slider">
              <div id="primary_slider" class="splide">
                <div class="splide__track">
                  <ul class="splide__list">
                    @foreach($item->images as $img)
                      <li class="splide__slide">
                        <img src="{{ url($img->image) }}">
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div id="thumbnail_slider" class="splide">
                <div class="splide__track">
                  <ul class="splide__list">
                    @foreach($item->images as $img)
                      <li class="splide__slide">
                        <img src="{{ url($img->image) }}">
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="description-highlights-box">
            <div class="tabs">
              <ul id="tabs-nav">
                <li><a href="#tab1">Description</a></li>
                @if(count($item->customFields) > 0)
                <li><a href="#tab2">Highlights</a></li>
                @endif
              </ul>
              <!-- END tabs-nav -->
              <div id="tabs-content">
                <div id="tab1" class="tab-content">
                  <div class="body-tab">
                    <p>{!! $item->description !!}</p>
                  </div>
                </div>
                @if(count($item->customFields) > 0)
                <div id="tab2" class="tab-content">
                  <div class="body-tab">
                    <ul>
                      @foreach($item->customFields as $field)
                        <li>
                          <span>{{ $field->field->field_name }} :</span>
                          {{ $field->value }}
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                @endif
              </div>
              <!-- END tabs-content -->
            </div>
            <!-- END tabs -->
          </div>
        </div>
        <div class="col-md-4">
          <div class="product-text-box">
            <div class="mobile-layout">
              <h2>{{ $item->title }}</h2>
              <ul>
                <li>
                  <button
                    class="favorite-button"
                    data-item="{{ $item->id }}">
                    @php
                    $icon = $isFavorite ? 'hart-red.png' : 'hart.svg';
                    @endphp
                      <a href="javascript:void(0)"
                        class="toggle-favorite"
                        data-item="{{ $item->id }}"
                        data-add="{{ asset('website_assets/images/hart-red.png') }}"
                        data-remove="{{ asset('website_assets/images/hart.svg') }}">

                        <img src="{{ asset('website_assets/images/'.$icon) }}" class="favorite-img">

                      </a>
                    </button>
                </li>
                @php
                    $shareUrl = url()->current();
                    $shareText = "Check this item";
                @endphp

                <li class="position-relative">
                    <a href="javascript:void(0)" class="open-box-soler">
                        <img src="{{asset('website_assets/images/solar_share-linear.svg')}}">
                    </a>

                    <div class="solar-share-box">
                        <ul>

                            <!-- Facebook -->
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank">
                                    <img src="{{asset('website_assets/images/solor-icon-1.png')}}"> Facebook
                                </a>
                            </li>

                            <!-- X (Twitter) -->
                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank">
                                    <img src="{{asset('website_assets/images/solor-icon-2.png')}}"> X
                                </a>
                            </li>

                            <!-- WhatsApp -->
                            <li>
                                <a href="https://wa.me/?text={{ $shareText }} {{ $shareUrl }}" target="_blank">
                                    <img src="{{asset('website_assets/images/solor-icon-3.png')}}"> WhatsApp
                                </a>
                            </li>

                            <!-- Copy Link -->
                            <li>
                                <a href="javascript:void(0)" onclick="copyShareLink()">
                                    <img src="{{asset('website_assets/images/solor-icon-4.png')}}"> Copy link
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
              </ul>
              <span class="price">
                {{ \Helpers::commonCurrencyFormate().$item->price }}
              </span>
              <div class="date-box"><img src="{{asset('website_assets/images/date.svg')}}">Posted on : {{ $item->created_at->format('M d, Y') }}</div>
              <div class="designer-box">
                <a href="{{ $item->user ? route('account-detail', $item->user->id) : '#' }}">
                  <div class="designer-box-image">
                    <img src="{{ $item->user->image ? url('uploads/user/'.$item->user->image) : url('uploads/default-user.png') }}">
                  </div>
                  <div class="designer-box-text">
                    <span>{{ $item->user ? $item->user->name : '--' }}</span>
                    <p>{{ $item->user ? $item->user->email : '--' }}</p>
                    <p>{{ $item->user ? $item->user->phone : '--' }}</p>
                  </div>
                </a>
              </div>
              <div class="start-chate-call">
                <a href="{{ route('chat.start', $item->id) }}" class="start-chate"><img src="{{asset('website_assets/images/chate.svg')}}">Start chat</a>
                <a href="tel:{{$item->user ? $item->user->phone : '--'}}" class="call-button"><img src="{{asset('website_assets/images/call.svg')}}">Call</a>
              </div>
            </div>

          </div>
          @if($item->area!=null)
          <div class="posted-in-box"> <span>Posted in</span>
            <p><img src="{{asset('website_assets/images/map-small.svg')}}">
              {{ $item->area }}, {{ $item->city }}, {{ $item->state }}
            </p>
            @php
              $location = $item->area . ', ' . $item->city . ', ' . $item->state . ', ' . $item->country . ' ' . $item->pincode;
            @endphp
            <div class="map-box">
              <iframe
                  width="100%"
                  height="300"
                  style="border:0;"
                  loading="lazy"
                  allowfullscreen
                  src="https://maps.google.com/maps?q={{ urlencode($location) }}&t=&z=13&ie=UTF8&iwloc=&output=embed">
              </iframe>
            </div>
          </div>
          <div class="view-on-google-map">
            <a target="_blank"
               href="https://www.google.com/maps/search/?api=1&query={{ urlencode($location) }}">
               View on Google map
            </a>
          </div>
          @endif
          <div class="did-you-box">
            <p><img src="{{asset('website_assets/images/red-icon.png')}}">Did you find any problem with this item?</p>
            <span>Ad id#652</span> <button class="report-button" id="openModalBtn1">Report this ad</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="related-ads-saction">
  <div class="container">
    <h2>Related Ads</h2>
    <div class="recommendations-saction-shop">
      <div class="row">
        @each('website.partial.item_list', $relatedItems, 'row')
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-0 border-0 bg-transparent">

            <div class="not-fill-bg-image-login">
                <div class="login-all-screen">
                    <div class="login-all-screen-inner">

                        <!-- Close Button -->
                        <button type="button" class="close-btn" data-bs-dismiss="modal">
                            <img src="{{asset('website_assets/images/tage-close.png')}}">
                        </button>

                        <h2>Report</h2>

                        <form id="registerForm" method="POST" action="{{ route('user.do-signup') }}">
                            @csrf

                            <div class="form-group">
                              <ul class="custom_radio">
                                  <li><input type="radio" id="featured-1" name="featured" checked><label for="featured-1">Custom Radio Button
                                      1</label></li>
                                  <li><input type="radio" id="featured-2" name="featured" checked><label for="featured-2">Custom Radio Button
                                      1</label></li>
                                  <li><input type="radio" id="featured-3" name="featured" checked><label for="featured-3">Custom Radio Button
                                      1</label></li>
                                  <li><input type="radio" id="featured-4" name="featured" checked><label for="featured-4">Custom Radio Button
                                      1</label></li>
                                  <li><input type="radio" id="featured-5" name="featured" checked><label for="featured-5">Custom Radio Button
                                      1</label></li>
                                  <li><input type="radio" id="featured-6" name="featured" checked><label for="featured-6">Custom Radio Button
                                      1</label></li>
                                  <li><input type="radio" id="featured-7" name="featured" checked><label for="featured-7">Custom Radio Button
                                      1</label></li>
                                </ul>
                            </div>

                            <button type="submit" class="singup-btn">Report</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
  $(document).on('click', '.report-button', function () {
        $('#reportModal').modal('show');
    });
</script>

<script>
  const favoriteButton = document.querySelector(".favorite-button");
  favoriteButton.addEventListener("click", (event) => {
    const button = event.currentTarget;
    button.classList.toggle("is-favorite");
  });
</script>
<script>
function copyShareLink() {

    const url = "{{ url()->current() }}";

    navigator.clipboard.writeText(url).then(function() {
      Swal.fire({
          icon: 'success',
          title: 'Copied!',
          text: 'Link copied to clipboard',
          timer: 1500,
          showConfirmButton: false
      });
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
    });

}
</script>
@endsection