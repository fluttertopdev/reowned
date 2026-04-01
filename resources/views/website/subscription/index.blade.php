@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>Home appliances</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">Subscription</a></li>
      </ul>
    </div>
  </div>


  <div class="edit-profile-saction">
    <div class="container">
      <div class="row">
        @include('website.profile_partial.menu')
        <div class="col-md-9">
          <div class="edit-profile-saction-right">

            <div class="subscription-box">
              <h2>Pricing plans</h2>
              <div class="subscription-box-inner">
                <div class="tabs">
                  <ul id="tabs-nav">
                    <li><a href="#tab1">Ad Listing Plan</a></li>
                    <li><a href="#tab2">Featured Ad Plan</a></li>
                  </ul>
                  <div id="tabs-content">
                    <div id="tab1" class="tab-content">
                      <div class="box-pricing-plan">
                        <div class="row">
                          @forelse($adsPackages as $row)
                            <div class="col-md-4">
                                <div class="box-pricing-plan-box">

                                    <!-- Package Header -->
                                    <div class="pakege-box text-center">
                                      <span>{{ $row->name }}</span>
                                      @if($row->final_price > 0)
                                          <h4>
                                              {{ \Helpers::commonCurrencyFormate().$row->final_price }}
                                              @if($row->discount > 0)
                                                  <small class="text-muted text-decoration-line-through">
                                                      {{ \Helpers::commonCurrencyFormate().$row->price }}
                                                  </small>
                                              @endif
                                          </h4>
                                      @else
                                          <h4>Free</h4>
                                      @endif
                                    </div>

                                    <!-- Plan Details -->
                                    <div class="plan-list-box">
                                      <ul>
                                          {{-- Description (from Quill) --}}
                                          @if($row->description)
                                              {!! $row->description !!}
                                          @endif
                                      </ul>
                                    </div>
                                    <div class="choose-plan">
                                      <button 
                                          class="choose-plan-btn"
                                          data-id="{{ $row->id }}"
                                          data-price="{{ $row->final_price }}"
                                          data-type="ads"
                                      >
                                          Choose plan
                                      </button>
                                    </div>
                                </div>
                            </div>
                          @empty
                            <div class="col-12 text-center">
                                <p>No Packages Found</p>
                            </div>
                          @endforelse
                        </div>
                      </div>
                    </div>
                    <div id="tab2" class="tab-content">
                      <div class="box-pricing-plan">
                        <div class="row">
                          @forelse($itemPackages as $row)
                            <div class="col-md-4">
                                <div class="box-pricing-plan-box">

                                    <!-- Package Header -->
                                    <div class="pakege-box text-center">
                                      <span>{{ $row->name }}</span>
                                      @if($row->final_price > 0)
                                          <h4>
                                              {{ \Helpers::commonCurrencyFormate().$row->final_price }}
                                              @if($row->discount > 0)
                                                  <small class="text-muted text-decoration-line-through">
                                                      {{ \Helpers::commonCurrencyFormate().$row->price }}
                                                  </small>
                                              @endif
                                          </h4>
                                      @else
                                          <h4>Free</h4>
                                      @endif
                                    </div>

                                    <!-- Plan Details -->
                                    <div class="plan-list-box">
                                      <ul>
                                          {{-- Description (from Quill) --}}
                                          @if($row->description)
                                              {!! $row->description !!}
                                          @endif
                                      </ul>
                                    </div>
                                    <div class="choose-plan">
                                      <button 
                                          class="choose-plan-btn"
                                          data-id="{{ $row->id }}"
                                          data-price="{{ $row->final_price }}"
                                          data-type="item"
                                      >
                                          Choose plan
                                      </button>
                                    </div>
                                </div>
                            </div>
                          @empty
                            <div class="col-12 text-center">
                                <p>No Packages Found</p>
                            </div>
                          @endforelse
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="choose-plan-popup">
    <div id="planModal" class="modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Payment with</h2>
        <div class="payment-list-popup">
          <ul>
            @if(setting('enable_razorpay') == 1)
              <li>
                  <a href="javascript:void(0)" onclick="payWithRazorpay()">
                      <img style="height: 48px" src="{{asset('website_assets/images/payment-icon-2.png')}}"> Razorpay
                  </a>
              </li>
            @endif
            @if(setting('enable_stripe') == 1 && setting('currency') == '$')
              <li>
                <a id="stripePayBtn" style="cursor: pointer;">
                  <img style="height: 48px" src="{{asset('website_assets/images/payment-icon-1.png')}}"> Stripe
                </a>
              </li>
            @else
              <p class="text-warning">
                Stripe available only for USD payments
              </p>
            @endif
            <li>
              <a href="javascript:void(0)" onclick="showPaypal()">
                <img style="height: 48px" src="{{asset('website_assets/images/payment-icon-paypal.png')}}"> Paypal
              </a>
            </li>
          </ul>
        </div>
        <div id="paypal-button-container" style="display:none; margin-top: 20px;"></div>
      </div>
    </div>
  </div>

  <script>
    let selectedPackage = {
      id: null,
      price: null,
      type: null
    };
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {

      const modal = document.getElementById('planModal');
      const closeBtn = modal.querySelector('.close-btn');

      document.querySelectorAll('.choose-plan-btn').forEach(button => {
        button.addEventListener('click', () => {

            selectedPackage.id = button.dataset.id;
            selectedPackage.price = button.dataset.price;
            selectedPackage.type = button.dataset.type;

            console.log(selectedPackage);

            document.getElementById('planModal').style.display = 'block';
        });
      });

      closeBtn.addEventListener('click', () => {
          modal.style.display = 'none';
      });

      window.addEventListener('click', (e) => {
          if (e.target === modal) {
              modal.style.display = 'none';
          }
      });
  });
  </script>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  
  <script>
    function payWithRazorpay() {

      if (!selectedPackage.id) {
          alert("Please select a package");
          return;
      }

      fetch("{{ route('razorpay.order') }}", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
              item_package_id: selectedPackage.id,
              type: selectedPackage.type
          })
      })
      .then(res => res.json())
      .then(data => {

          var options = {
              "key": "{{ setting('razorpay_key') }}",
              "amount": data.amount,
              "currency": "INR",
              "name": "Reowned",
              "description": "Subscription Payment",
              "order_id": data.order_id,

              "handler": function (response){
                  verifyPayment(response);
              },

              "prefill": {
                  "name": "{{ auth()->user()->name ?? '' }}",
                  "email": "{{ auth()->user()->email ?? '' }}"
              },

              "theme": {
                  "color": "#3399cc"
              }
          };

          var rzp = new Razorpay(options);
          rzp.open();
      });
    }

    function verifyPayment(response) {

      response.item_package_id = selectedPackage.id;

      fetch("{{ route('razorpay.verify') }}", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify(response)
      })
      .then(res => res.json())
      .then(data => {
          if(data.success){
              toastr.success("Payment Successful ✅");
              location.reload();
          } else {
              toastr.error("Payment Failed ❌");
          }
      });
    }
  </script>

  <script src="https://js.stripe.com/v3/"></script>

  <script>
    const stripe = Stripe("{{ setting('stripe_key') }}");

    document.getElementById('stripePayBtn').addEventListener('click', function () {

        if (!selectedPackage.id) {
            alert("Please select a package");
            return;
        }

        fetch("{{ route('stripe.order') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                item_package_id: selectedPackage.id,
                type: selectedPackage.type
            })
        })
        .then(res => res.json())
        .then(data => {
            return stripe.redirectToCheckout({ sessionId: data.id });
        })
        .catch(err => console.error(err));
    });
  </script>

  <script src="https://www.paypal.com/sdk/js?client-id={{ setting('paypal_client_id') }}"></script>

  <script>
    function showPaypal() {

      if (!selectedPackage.id) {
          alert("Please select a package");
          return;
      }

      let container = document.getElementById('paypal-button-container');
      container.style.display = 'block';

      if (container.innerHTML.trim() !== "") return;

      paypal.Buttons({

          createOrder: function(data, actions) {
              return fetch("{{ route('paypal.order') }}", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                      "X-CSRF-TOKEN": "{{ csrf_token() }}"
                  },
                  body: JSON.stringify({
                      item_package_id: selectedPackage.id,
                      type: selectedPackage.type
                  })
              })
              .then(res => res.json())
              .then(data => data.orderID);
          },

          onApprove: function(data, actions) {
              return fetch("{{ route('paypal.capture') }}", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                      "X-CSRF-TOKEN": "{{ csrf_token() }}"
                  },
                  body: JSON.stringify({
                      orderID: data.orderID
                  })
              })
              .then(res => res.json())
              .then(data => {
                  if (data.status) {
                      closePlanModal();
                      toastr.success("Payment Successful ✅");

                      setTimeout(() => {
                          window.location.reload();
                      }, 500);
                  }
              });
          }

      }).render('#paypal-button-container');
    }
  </script>

  <script>
    function closePlanModal() {
        document.getElementById('planModal').style.display = 'none';

        // optional: reset PayPal container
        document.getElementById('paypal-button-container').innerHTML = '';
    }
  </script>
@endsection