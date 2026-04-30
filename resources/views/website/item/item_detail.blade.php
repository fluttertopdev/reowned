@extends('website.layout.app')
@section('content')

<div class="product-detals-saction">
  <div class="container">
    <div class="brudcrum">
      <ul>
        <li><a href="{{url('/')}}">{{ __('lang.website.home') }}</a></li>
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
                <li><a href="#tab1">{{ __('lang.website.description') }}</a></li>
                @if(count($item->customFields) > 0)
                <li><a href="#tab2">{{ __('lang.website.highlights') }}</a></li>
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
                                    <img src="{{asset('website_assets/images/solor-icon-1.png')}}"> {{ __('lang.website.facebook') }}
                                </a>
                            </li>

                            <!-- X (Twitter) -->
                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank">
                                    <img src="{{asset('website_assets/images/solor-icon-2.png')}}"> {{ __('lang.website.x') }}
                                </a>
                            </li>

                            <!-- WhatsApp -->
                            <li>
                                <a href="https://wa.me/?text={{ $shareText }} {{ $shareUrl }}" target="_blank">
                                    <img src="{{asset('website_assets/images/solor-icon-3.png')}}"> {{ __('lang.website.whatsApp') }}
                                </a>
                            </li>

                            <!-- Copy Link -->
                            <li>
                                <a href="javascript:void(0)" onclick="copyShareLink()">
                                    <img src="{{asset('website_assets/images/solor-icon-4.png')}}"> {{ __('lang.website.copy_link') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
              </ul>
              <span class="price">
                {{ \Helpers::commonCurrencyFormate().$item->price }}
              </span>
              <div class="date-box"><img src="{{asset('website_assets/images/date.svg')}}">{{ __('lang.website.posted_on') }} {{ $item->created_at->format('M d, Y') }}</div>
              <div class="designer-box">
                <a href="{{ $item->user ? route('account-detail', $item->user->id) : '#' }}">
                  <div class="designer-box-image">
                    <img src="{{ $item->user->image ? url('uploads/user/'.$item->user->image) : url('uploads/default-user.png') }}">
                  </div>
                  <div class="designer-box-text">
                    <span>
                        {{ $item->user ? $item->user->name : '--' }}

                        @if($item->user && $item->user->status == 1)
                            <i class="fa fa-check-circle text-success ms-1" title="{{ __('lang.website.verified') }}"></i>
                        @endif
                    </span>
                </div>
                </a>
              </div>
              @if(!$isOwner)
              <div class="start-chate-call">
                <a href="{{ route('chat.start', $item->id) }}" class="start-chate"><img src="{{asset('website_assets/images/chate.svg')}}">{{ __('lang.website.start_chat') }}</a>
                <a href="tel:{{$item->user ? $item->user->phone : '--'}}" class="call-button"><img src="{{asset('website_assets/images/call.svg')}}">{{ __('lang.website.call') }}</a>
              </div>
              @endif
            </div>

          </div>
          @if($item->area!=null)
          <div class="posted-in-box"> <span>{{ __('lang.website.posted_in') }}</span>
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
                  src="https://maps.google.com/maps?q={{ urlencode($location) }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
              </iframe>
            </div>
          </div>
          <div class="view-on-google-map">
            <a target="_blank"
               href="https://www.google.com/maps/search/?api=1&query={{ urlencode($location) }}">
               {{ __('lang.website.view_on_google_map') }}
            </a>
          </div>
          @endif
          @if(!$isOwner)
          <div class="did-you-box">
            <p><img src="{{asset('website_assets/images/red-icon.png')}}">{{ __('lang.website.did_you_find_problem') }}</p>
            <span>{{ __('lang.website.ad_name') }} #{{$item->title}}</span>
            @if(count($reportReasons) > 0)
            <button class="report-button" id="openModalBtn1">{{ __('lang.website.report_this_ad') }}</button>
            @endif
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="related-ads-saction">
  <div class="container">
    <h2>{{ __('lang.website.related_ads') }}</h2>
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
                      <h2>{{ __('lang.website.report') }}</h2>
                      <form id="reportForm">
                        @csrf
                        <div class="form-group">
                          <ul class="custom_radio">
                              @foreach($reportReasons as $each)
                                  <li>
                                      <input type="radio" id="featured-{{$each->id}}" name="reason_id" value="{{$each->id}}">
                                      <label for="featured-{{$each->id}}">{{$each->reason}}</label>
                                  </li>
                              @endforeach
                          </ul>
                          <input type="hidden" name="item_id" value="{{$item->id}}">
                        </div>
                        <button type="submit" class="singup-btn">{{ __('lang.website.report') }}</button>
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
          title: "{{ __('lang.website.copied') }}",
          text: "{{ __('lang.website.link_copied_to_clipboard') }}",
          timer: 1500,
          showConfirmButton: false
      });
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
    });

}
</script>

<script>
  $(document).ready(function () {
    $('#reportForm').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('item.report') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.status === true) {
                    toastr.success(response.message);
                    $('#reportForm')[0].reset();
                    $('#reportModal').modal('hide');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr) {
                toastr.error('{{ __('lang.website.something_went_wrong') }}');
            }
        });
    });
  });
</script>
@endsection