@extends('admin.layout.app')
@section('content')


<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
      <!-- View sales -->

      <!-- View sales -->

      <!-- Statistics -->
      <div class="col-xl-12 col-md-12">
        <div class="card h-100">
          <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">{{__('lang.statistics')}}</h5>

          </div>
          <div class="card-body d-flex align-items-end">
            <div class="w-100">
              <div class="row gy-3">
                <div class="col-md-3 col-6">
                  @can('category.index')
                    <a href="{{url('admin/category')}}">
                  @endcan
                      <div class="d-flex align-items-center">
                        <div class="badge rounded bg-label-primary me-4 p-2">
                          <i class="ti ti-category ti-lg"></i>
                        </div>
                        <div class="card-info">
                          <h5 class="mb-0">{{$categoryCount}}</h5>
                          <small>{{__('lang.categories')}}</small>
                        </div>
                      </div>
                  @can('category.index')
                    </a>
                  @endcan
                </div>
                <div class="col-md-3 col-6">
                  @can('customer.index')
                    <a href="{{url('admin/customer')}}">
                  @endcan
                        <div class="d-flex align-items-center">
                            <div class="badge rounded bg-label-info me-4 p-2"><i class="ti ti-users ti-lg"></i></div>
                            <div class="card-info">
                              <h5 class="mb-0">{{$userCount}}</h5>
                              <small>{{__('lang.customers')}}</small>
                            </div>
                        </div>
                  @can('customer.index')
                    </a>
                  @endcan
                </div>
                <div class="col-md-3 col-6">
                  @can('item.index')
                    <a href="{{url('admin/item')}}">
                  @endcan
                    <div class="d-flex align-items-center">
                        <div class="badge rounded bg-label-danger me-4 p-2">
                          <i class="ti ti-package ti-lg"></i>
                        </div>
                        <div class="card-info">
                          <h5 class="mb-0">{{$itemCount}}</h5>
                          <small>{{__('lang.item')}}</small>
                        </div>
                    </div>
                  @can('item.index')
                    </a>
                  @endcan
                </div>
                <div class="col-md-3 col-6">
                  @can('contact_us.index')
                    <a href="{{url('admin/contact_us')}}">
                  @endcan
                    <div class="d-flex align-items-center">
                        <div class="badge rounded bg-label-success me-4 p-2">
                          <i class=" ti ti-article ti-lg"></i>
                        </div>
                        <div class="card-info">
                          <h5 class="mb-0">{{$contactusCount}}</h5>
                          <small>{{__('lang.contact_us')}}</small>
                        </div>
                    </div>
                  @can('contact_us.index')
                    </a>
                  @endcan
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Statistics -->

    </div>
  </div>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container">
           @include('admin.item.partial.item_table')
        </div>
    </div>
  <!-- / Content -->

  <!-- Footer -->
  <footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
      <div
        class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
        <div class="text-body">
          ©
          <script>
            document.write(new Date().getFullYear());
          </script>
        </div>
      </div>
    </div>
  </footer>
  <!-- / Footer -->

  <div class="content-backdrop fade"></div>
</div>


@endsection