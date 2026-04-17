@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>{{ __('lang.website.home_appliances') }}</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">{{ __('lang.website.add') }}</a></li>
      </ul>
    </div>
  </div>


  <div class="edit-profile-saction">
    <div class="container">
      <div class="row">
        @include('website.profile_partial.menu')
        <div class="col-md-9">
          <div class="edit-profile-saction-right">
            <div class="add-box-saction">
              <div class="header-add-box">
                <div class="header-add-box-left">
                  <h4>{{ __('lang.website.total_ads') }}</h4>
                </div>
                <div class="header-add-box-right">
                  <form method="GET" id="filterForm">
                      <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
                      <input type="hidden" name="status" id="statusInput" value="{{ request('status') }}">

                      <!-- SORT -->
                      <div class="news-oldst-box">
                          <div class="select" id="sortSelect">
                              <div class="selectBtn">
                                  {{ request('sort') == 'oldest' ? __('lang.website.oldest_to_newest') 
                                  : (request('sort') == 'price_high' ? __('lang.website.price_high_to_low') 
                                  : (request('sort') == 'price_low' ? __('lang.website.price_low_to_high') 
                                  : __('lang.website.newest'))) }}
                              </div>
                              <div class="selectDropdown">
                                  <div class="option" data-value="">{{ __('lang.website.newest') }}</div>
                                  <div class="option" data-value="oldest">{{ __('lang.website.oldest_to_newest') }}</div>
                                  <div class="option" data-value="price_high">{{ __('lang.website.price_high_to_low') }}</div>
                                  <div class="option" data-value="price_low">{{ __('lang.website.price_low_to_high') }}</div>
                              </div>
                          </div>
                      </div>

                      <!-- STATUS -->
                      <div class="all-totle-add">
                          <div class="select" id="statusSelect">
                              <div class="selectBtn">
                                  {{ request('status') == 'under_review' ? __('lang.website.under_review') 
                                  : (request('status') == 'live' ? __('lang.website.live') 
                                  : (request('status') == 'rejected' ? __('lang.website.rejected') 
                                  : (request('status') == 'sold' ? __('lang.website.sold') 
                                  : __('lang.website.all')))) }}
                              </div>
                              <div class="selectDropdown">
                                  <div class="option" data-value="">{{ __('lang.website.all') }}</div>
                                  <div class="option" data-value="under_review">{{ __('lang.website.under_review') }}</div>
                                  <div class="option" data-value="live">{{ __('lang.website.live') }}</div>
                                  <div class="option" data-value="rejected">{{ __('lang.website.rejected') }}</div>
                                  <div class="option" data-value="sold">{{ __('lang.website.sold') }}</div>
                              </div>
                          </div>
                      </div>

                  </form>
                </div>    

              </div>
              @if($items->count() > 0)
              <div class="total-add-saction">
                <div class="load-more-box">
                  <div class="product-box">
                    <div class="row" id="itemContainer">
                        @include('website.sell.partials.item_card', ['items' => $items])
                    </div>
                  </div>
                  <div class="product-box">
                    @if($items->count() > 5)
                      <div class="load-more text-center mt-4">
                          <button class="btn-load" id="loadMoreBtn">{{ __('lang.website.load_more') }}</button>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
              @else
              <div class="no-ads-found">
                <img src="{{asset('website_assets/images/no-chat-icon.png')}}">
                <span>{{ __('lang.website.not_ads_found') }}</span>
                <p>{{ __('lang.website.not_ads_found_description') }}</p>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    let offset = 6;

    document.getElementById('loadMoreBtn')?.addEventListener('click', function () {

      fetch("{{ route('sell.load.more.items') }}?offset=" + offset)
          .then(response => response.text())
          .then(data => {

              if (data.trim() === '') {
                  document.getElementById('loadMoreBtn').remove();
                  return;
              }

              document.getElementById('itemContainer')
                  .insertAdjacentHTML('beforeend', data);

              offset += 6;
          });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".select").forEach(select => {
          let btn = select.querySelector(".selectBtn");
          let dropdown = select.querySelector(".selectDropdown");

          btn.addEventListener("click", () => {
              dropdown.classList.toggle("active");
          });

          select.querySelectorAll(".option").forEach(option => {
              option.addEventListener("click", () => {

                  btn.innerText = option.innerText;
                  dropdown.classList.remove("active");

                  let value = option.getAttribute("data-value");

                  if (select.id === "sortSelect") {
                      document.getElementById("sortInput").value = value;
                  }

                  if (select.id === "statusSelect") {
                      document.getElementById("statusInput").value = value;
                  }

                  document.getElementById("filterForm").submit();
              });
          });
      });
  });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {

        const forms = document.querySelectorAll('.mark-as-sold-form');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: "{{__('lang.website.are_you_sure')}}",
                    text: "{{__('lang.website.mark_as_sold_swal_msg')}}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{__('lang.website.mark_as_sold_swal_btn_text')}}",
                    cancelButtonText: "{{__('lang.website.cancel')}}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

    });
    </script>

@endsection