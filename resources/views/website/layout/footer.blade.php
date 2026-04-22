<!-- Footer -->
<div class="footer-saction">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="footer-box"> 
          <a href="#">
            <img src="{{url('uploads/setting/'.setting('footer_logo'))}}" alt="LOGO">
          </a>
          <p>{{setting('address')}}</p>
          <a href="#" class="link-g-p"><img
              src="{{asset('website_assets/images/icon-svg-1.svg')}}">{{setting('email')}}</a> <a href="#"
            class="link-g-p"><img src="{{asset('website_assets/images/icon-svg-2.svg')}}">{{setting('contact_number1')}}</a>
        </div>
      </div>
      <div class="col-md-2">
        <div class="footer-box">
          <h3>{{ __('lang.website.quick_links') }}</h3>
          <ul>
            <li><a href="{{url('contact-us')}}">{{ __('lang.website.contact_us') }}</a></li>
            <li><a href="{{url('subscriptions')}}">{{ __('lang.website.subscription') }}</a></li>
            <li><a href="{{url('faqs')}}">{{ __('lang.website.faqs') }}</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <div class="footer-box">
          <h3>{{ __('lang.website.legal') }}</h3>
          <ul>
            @php $cmsList = \Helpers::getCmsForSite(); @endphp
            @if(isset($cmsList) && count($cmsList))
              @foreach($cmsList as $cms)
                <li><a target="_blank" href="{{url('/'.$cms->slug)}}">{{$cms->page_name}}</a></li>
              @endforeach
            @endif
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="footer-box">
          <h3>{{ __('lang.website.get_in_touch') }}</h3>
          <ul class="get-in-tuch">
            @if(setting('facebook')!='')
            <li><a target="_blank" href="{{setting('facebook')}}"><img src="{{asset('website_assets/images/icon-svg-3.svg')}}"></a></li>
            @endif
            @if(setting('x_social_media'))
            <li><a target="_blank" href="{{setting('x_social_media')}}"><img src="{{asset('website_assets/images/icon-svg-4.svg')}}"></a></li>
            @endif
            @if(setting('instagram'))
            <li><a target="_blank" href="{{setting('instagram')}}"><img src="{{asset('website_assets/images/icon-svg-5.svg')}}"></a></li>
            @endif
            @if(setting('linkedin'))
            <li><a target="_blank" href="{{setting('linkedin')}}"><img src="{{asset('website_assets/images/icon-svg-6.svg')}}"></a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div class="copy-right">
      <p>{{ __('lang.website.copyright') }} {{setting('name')}} {{date('Y')}}. {{ __('lang.website.all_rights_reserved') }}.</p>

      @php
          $langList = \Helpers::getAllLangList();

          $langCode = Session()->has('website_locale') 
              ? Session()->get('website_locale') 
              : config('app.fallback_locale');

          $currentLang = collect($langList)->firstWhere('code', $langCode);
      @endphp

      <div class="lang-dropdown">
          <div class="lang-btn" onclick="toggleLangDropdown()">
              <span>{{ strtoupper($currentLang->code) }}</span>
              <i class="arrow-down"></i>
          </div>

          <ul class="lang-menu" id="langMenu">
              @foreach($langList as $langRow)
                  <li>
                      <a href="{{ route('setlang') }}?lang={{ $langRow->code }}"
                         class="{{ $langCode == $langRow->code ? 'active' : '' }}">
                          {{ $langRow->name }}
                      </a>
                  </li>
              @endforeach
          </ul>
      </div>
    </div>
  </div>
</div>
<!-- Location -->
<div class="map-poup">
  <div id="myLocationEditModal" class="modal">
    <div class="modal-content location-modal">

      <div class="modal-header">
        <h2>{{ __('lang.website.edit_location') }}</h2>
        <button class="close-btn" id="closeModalBtn">
          <img src="{{asset('website_assets/images/close.svg')}}">
        </button>
      </div>

      <div class="location-top">
        <button class="curont-loc">
          <img src="{{asset('website_assets/images/crunt.png')}}">
          {{ __('lang.website.current_location') }}
        </button>
      </div>

      <div class="map-search">
        <input type="text" id="mapLocationSearch" placeholder="{{ __('lang.website.search_city_area') }}">
      </div>

      <div class="map-wrapper">
       <div id="mapCanvas"></div>
      </div>

      <div class="slider-container">
        <div class="slider-labels">
          <label>{{ __('lang.website.km_range') }}</label>
          <label id="rangeValue">20KM</label>
        </div>
        <input type="range" id="kmRange" min="0" max="100" value="20">
      </div>

      <div class="save-button">
        <button>{{ __('lang.website.save') }}</button>
      </div>

    </div>
  </div>
</div>
<div class="overlay" id="overlay"></div>

<!-- =================================Script=========================== -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="{{asset('website_assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('website_assets/js/custom-all.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
<script src="https://unpkg.com/blaze-slider@latest/dist/blaze-slider.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/gh/linuxguist/countries@main/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_map_key')}}&libraries=places"></script>

  @if(session('success'))
  <script>
      toastr.success("{{ session('success') }}");
  </script>
  @endif

  @if(session('error'))
  <script>
      toastr.error("{{ session('error') }}");
  </script>
  @endif
  <script>
    function toggleLangDropdown() {
        document.getElementById("langMenu").classList.toggle("show");
    }

    window.onclick = function(e) {
        if (!e.target.closest('.lang-dropdown')) {
            document.getElementById("langMenu").classList.remove("show");
        }
    }
  </script>
</body>

</html>