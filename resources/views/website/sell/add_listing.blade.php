@extends('website.layout.app')
@section('content')

<div class="container">
  <div class="brudcrum brudcrum-defrent">
    <ul>
      <li>{{ __('lang.website.home_appliances') }}</li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="{{route('sell.index')}}">{{ __('lang.website.sell') }}</a></li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="#" class="active">{{ $subcategory->name }}</a></li>
    </ul>
  </div>
</div>


<div class="sell-add-listing">
  <div class="container">
    <form id="sellForm" action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <input type="hidden" name="category_id" value="{{ $subcategory->parent_id }}">
      <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">

      <div class="sell-add-listing-inner">
        <h2>{{ __('lang.website.ad_listing') }}</h2>

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <div class="select-cetagory-box">
          <h4>{{ __('lang.website.selected_category') }}</h4>
          <span>{{ $subcategory->name }}</span>
        </div>

        <div class="add-listing-one-box">
          <h4>{{ __('lang.website.include_some_details') }}</h4>
          <div class="full-text-area">
            <label>{{ __('lang.website.ad_title') }} *</label>
            <div class="word-cont">0/70</div>
            <textarea name="title" class="textarea-1"
              placeholder="{{ __('lang.website.ad_title_placeholder') }}"></textarea>
          </div>
          <div class="full-text-area">
            <label>{{ __('lang.website.description') }} *</label>
            <div class="word-cont">0/4000</div>
            <textarea name="description" class="textarea-2"
              placeholder="{{ __('lang.website.description_placeholder') }}"></textarea>
          </div>

          <h4 class="mt-4">{{ __('lang.website.include_some_details') }}</h4>

          @foreach($customFields as $field)

              <div class="mb-4 mt-3">

                  <label>
                      {{ $field->field_name }}
                      @if($field->is_required)
                          *
                      @endif
                  </label>

                  {{-- NUMBER --}}
                  @if($field->field_type == 'number')
                      <input type="text"
                             name="custom_fields[{{ $field->id }}]"
                             class="form-control"
                             minlength="{{ $field->min_length }}"
                             maxlength="{{ $field->max_length }}"
                             {{ $field->is_required ? 'required' : '' }}>

                  {{-- TEXT --}}
                  @elseif($field->field_type == 'textbox')
                      <input type="text"
                             name="custom_fields[{{ $field->id }}]"
                             class="form-control"
                             minlength="{{ $field->min_length }}"
                             maxlength="{{ $field->max_length }}"
                             {{ $field->is_required ? 'required' : '' }}>

                  {{-- TEXTAREA --}}
                  @elseif($field->field_type == 'textarea')
                      <textarea name="custom_fields[{{ $field->id }}]"
                                class="form-control"
                                minlength="{{ $field->min_length }}"
                                maxlength="{{ $field->max_length }}"
                                {{ $field->is_required ? 'required' : '' }}></textarea>

                  {{-- SELECT --}}
                  @elseif($field->field_type == 'dropdown')
                      <select name="custom_fields[{{ $field->id }}]" class="form-control form-select" {{ $field->is_required ? 'required' : '' }}>
                          <option value="">{{ __('lang.website.select') }} {{ $field->field_name }}</option>
                          @foreach($field->options as $option)
                              <option value="{{ $option->option_value }}">
                                  {{ $option->option_value }}
                              </option>
                          @endforeach
                      </select>

                  {{-- RADIO --}}
                  @elseif($field->field_type == 'radio')
                      @foreach($field->options as $option)
                          <div class="form-check">
                              <input type="radio"
                                     name="custom_fields[{{ $field->id }}]"
                                     value="{{ $option->option_value }}"
                                     {{ $field->is_required ? 'required' : '' }}>
                              <label>{{ $option->option_value }}</label>
                          </div>
                      @endforeach

                  {{-- CHECKBOX --}}
                  @elseif($field->field_type == 'checkbox')
                      @foreach($field->options as $option)
                          <div class="form-check">
                              <input type="checkbox"
                                     name="custom_fields[{{ $field->id }}][]"
                                     value="{{ $option->option_value }}">
                              <label>{{ $option->option_value }}</label>
                          </div>
                      @endforeach
                  @endif

              </div>

          @endforeach

        </div>

        <div class="add-listing-one-box">
          <h4>{{ __('lang.website.set_a_price') }}</h4>
          <div class="brand-year-box brand-year-box-full">
            <div class="brand-year-box-right">
              <label>{{ __('lang.website.price') }} *</label>
              <input type="number" name="price" class="input-text" min="1">
            </div>
          </div>
        </div>


        <div class="add-listing-one-box">
          <h4>{{ __('lang.website.upload_photos') }}</h4>
          <div class="multi-image">
            <div class="upload__box">
              <div class="upload__btn-box">
                <label class="form-label upload__btn">
                  <img src="{{asset('website_assets/images/multiimage.png')}}">
                  <h6>{{ __('lang.website.main_picture') }}</h6>
                  <p class="mb-1">{{ __('lang.website.drag_drop') }}</p>
                  <span>{{ __('lang.website.upload') }}</span>
                  <input type="file" name="images[]" multiple accept="image/*" data-max_length="20" class="form-control upload__inputfile" accept="image/jpeg, image/png, image/jpg">
                </label>
              </div>
              <div class="upload__img-wrap row"></div>
            </div>
          </div>
        </div>
        <div class="add-listing-one-box confirom-box">
          <h4>{{ __('lang.website.confirm_location') }}</h4>
          <div class="confirm-row">
            <label>{{ __('lang.website.area') }} *</label>
            <input type="text" id="listing_area" name="area" class="form-control" placeholder="{{ __('lang.website.enter_area') }}">
          </div>
          <input type="hidden" name="city" id="listing_city">
          <input type="hidden" name="state" id="listing_state">
          <input type="hidden" name="country" id="listing_country">
          <input type="hidden" name="pincode" id="listing_pincode">
          <input type="hidden" name="latitude" id="listing_latitude">
          <input type="hidden" name="longitude" id="listing_longitude">
        </div>
        <div class="post-now">
          <button>{{ __('lang.website.post_now') }}</button>
        </div>
      </div>

    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>

<script>
  jQuery(document).ready(function () {
    ImgUpload();
  });

  function ImgUpload() {
    let imgArray = [];

    $('.upload__inputfile').on('change', function (e) {
      const imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      const maxLength = parseInt($(this).attr('data-max_length'), 10) || 20;
      const files = e.target.files;
      const filesArr = Array.from(files);

      filesArr.forEach((f) => {
        if (!f.type.match('image.*')) return;
        if (imgArray.length >= maxLength) return;

        imgArray.push(f);
        const reader = new FileReader();

        reader.onload = function (e) {
          const html = `
          <div class="col-auto">
            <div class="upload__img-box" style="background-image: url('${e.target.result}')">
              <div class="upload__img-close" data-file="${f.name}">&times;</div>
            </div>
          </div>
        `;
          imgWrap.append(html);
        };

        reader.readAsDataURL(f);
      });
    });

    $('body').on('click', '.upload__img-close', function () {
      const file = $(this).attr('data-file');
      imgArray = imgArray.filter(f => f.name !== file);
      $(this).closest('.col-auto').remove();
    });
  }
</script>

<script>
$(document).ready(function(){

    $("#sellForm").on("submit", function(e){

        let valid = true;
        $(".error").remove();

        // Title
        let title = $("textarea[name='title']").val().trim();
        if(title == ""){
            valid = false;
            $("textarea[name='title']").after("<span class='error text-danger'>Title is required</span>");
        }

        // Description
        let desc = $("textarea[name='description']").val().trim();
        if(desc == ""){
            valid = false;
            $("textarea[name='description']").after("<span class='error text-danger'>Description is required</span>");
        }

        // Price
        let price = $("input[name='price']").val();
        if(price == "" || price <= 0){
            valid = false;
            $("input[name='price']").after("<span class='error text-danger'>Valid price required</span>");
        }

        // Area
        if($("#listing_area").val().trim() == ""){
            valid = false;
            $("#listing_area").after("<span class='error text-danger'>Select valid area</span>");
        }

        // Custom Fields Required
        

        // Images validation
        let files = $(".upload__inputfile")[0].files;

        if(files.length == 0){
            valid = false;
            $(".upload__btn-box").after("<span class='error text-danger'>Upload at least one image</span>");
        }

        if(files.length > 20){
            valid = false;
            $(".upload__btn-box").after("<span class='error text-danger'>Maximum 20 images allowed</span>");
        }

        if(!valid){
            e.preventDefault();
        }

    });

});
</script>


<script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_map_key')}}&libraries=places"></script>
<script>
function initAutocomplete() {

    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('listing_area'),
        {
            types: ['geocode'], // important
            componentRestrictions: { country: "in" } // India only
        }
    );

    autocomplete.addListener('place_changed', function () {

      let place = autocomplete.getPlace();

      let lat = place.geometry.location.lat();
      let lng = place.geometry.location.lng();

      $("#listing_latitude").val(lat);
      $("#listing_longitude").val(lng);

      let area = '', city = '', state = '', country = '', pincode = '';

      place.address_components.forEach(function(component) {

          let types = component.types;

          if (
              types.includes("sublocality_level_1") ||
              types.includes("sublocality") ||
              types.includes("neighborhood")
          ) {
              area = component.long_name;
          }

          if (!area && types.includes("locality")) {
              area = component.long_name;
          }

          if (types.includes("locality")) {
              city = component.long_name;
          }

          if (types.includes("administrative_area_level_1")) {
              state = component.long_name;
          }

          if (types.includes("country")) {
              country = component.long_name;
          }

          if (types.includes("postal_code")) {
              pincode = component.long_name;
          }
      });

      $("#listing_area").val(area);
      $("#listing_city").val(city);
      $("#listing_state").val(state);
      $("#listing_country").val(country);
      $("#listing_pincode").val(pincode);
    });
}

// init
google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>
@endsection