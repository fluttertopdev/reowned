@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>Home appliances</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">Add</a></li>
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
                  <h4>Total ads</h4>
                </div>
                <div class="header-add-box-right">
                  <form method="GET" id="filterForm">
                      <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
                      <input type="hidden" name="status" id="statusInput" value="{{ request('status') }}">

                      <!-- SORT -->
                      <div class="news-oldst-box">
                          <div class="select" id="sortSelect">
                              <div class="selectBtn">
                                  {{ request('sort') == 'oldest' ? 'Oldest to Newest' : (request('sort') == 'price_high' ? 'Price High → Low' : (request('sort') == 'price_low' ? 'Price Low → High' : 'Newest')) }}
                              </div>
                              <div class="selectDropdown">
                                  <div class="option" data-value="">Newest</div>
                                  <div class="option" data-value="oldest">Oldest to Newest</div>
                                  <div class="option" data-value="price_high">Price High → Low</div>
                                  <div class="option" data-value="price_low">Price Low → High</div>
                              </div>
                          </div>
                      </div>

                      <!-- STATUS -->
                      <div class="all-totle-add">
                          <div class="select" id="statusSelect">
                              <div class="selectBtn">
                                  {{ request('status') == 'under_review' ? 'Under Review' : (request('status') == 'live' ? 'Live' : (request('status') == 'rejected' ? 'Rejected' : (request('status') == 'sold' ? 'Sold' : 'All'))) }}
                              </div>
                              <div class="selectDropdown">
                                  <div class="option" data-value="">All</div>
                                  <div class="option" data-value="under_review">Under Review</div>
                                  <div class="option" data-value="live">Live</div>
                                  <div class="option" data-value="rejected">Rejected</div>
                                  <div class="option" data-value="sold">Sold</div>
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
                    @if($items->count() > 6)
                      <div class="load-more text-center mt-4">
                          <button class="btn-load" id="loadMoreBtn">Load More</button>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
              @else
              <div class="no-ads-found">
                <img src="{{asset('website_assets/images/no-chat-icon.png')}}">
                <span>No ads found</span>
                <p>There are currently no ads available. Start by creating your first ad now!</p>
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

@endsection