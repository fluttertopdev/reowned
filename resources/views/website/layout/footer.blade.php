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
          <h3>Quick links</h3>
          <ul>
            <li><a href="{{url('about-us')}}">About us</a></li>
            <li><a href="{{url('contact-us')}}">Contact us</a></li>
            <li><a href="{{url('subscriptions')}}">Subscription</a></li>
            <li><a href="{{url('faqs')}}">FAQs</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <div class="footer-box">
          <h3>Legal</h3>
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
          <h3>Get in touch</h3>
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
          <div class="news-later">
            <input type="email" placeholder="Enter email address" />
            <button class="search-btn">Subscribe</button>
          </div>
        </div>
      </div>
    </div>
    <div class="copy-right">
      <p>Copyright© {{setting('name')}} {{date('Y')}}. All Rights Reserved.</p>
      <a href="#"><img src="{{asset('website_assets/images/languge.png')}}"></a>
    </div>
  </div>
</div>
<!-- Location -->
<div class="map-poup">
  <div id="myModal" class="modal">
    <div class="modal-content location-modal">

      <div class="modal-header">
        <h2>Edit location</h2>
        <button class="close-btn" id="closeModalBtn">
          <img src="{{asset('website_assets/images/close.svg')}}">
        </button>
      </div>

      <div class="location-top">
        <button class="curont-loc">
          <img src="{{asset('website_assets/images/crunt.png')}}">
          Current location
        </button>
      </div>

      <div class="map-search">
        <input type="text" id="locationSearch" placeholder="Search city / area">
      </div>

      <div class="map-wrapper">
        <div id="map"></div>
      </div>

      <div class="slider-container">
        <div class="slider-labels">
          <label>KM Range</label>
          <label id="rangeValue">20KM</label>
        </div>

        <input type="range" id="kmRange" min="0" max="100" value="20">
      </div>

      <div class="save-button">
        <button>Save</button>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAa8lv49sFP9c6gt001S-V4bUMRJflcgxI&libraries=places"></script>

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
</body>

</html>