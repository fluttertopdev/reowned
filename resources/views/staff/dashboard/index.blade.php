@extends('staff.layout.app')
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
                  <div class="d-flex align-items-center">
                    <div class="badge rounded bg-label-primary me-4 p-2">
                      <i class="ti ti-category ti-lg"></i>
                    </div>
                    <div class="card-info">
                      <h5 class="mb-0">{{$categoryCount}}</h5>
                      <small>{{__('lang.categories')}}</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-6">
                  <div class="d-flex align-items-center">
                    <div class="badge rounded bg-label-info me-4 p-2"><i class="ti ti-chart-bar"></i></div>
                    <div class="card-info">
                      <h5 class="mb-0">{{$adspackages}}</h5>
                      <small>{{__('lang.advertisement_package')}}</small>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 col-6">
                  <div class="d-flex align-items-center">
                    <div class="badge rounded bg-label-success me-4 p-2">
                      <i class=" ti ti-list-check"></i>
                    </div>
                    <div class="card-info">
                      <h5 class="mb-0">{{$itempackagCount}}</h5>
                      <small>{{__('lang.item_listing_package')}}</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-6">
                  <div class="d-flex align-items-center">
                    <div class="badge rounded bg-label-danger me-4 p-2">
                      <i class="ti ti-package ti-lg"></i>
                    </div>
                    <div class="card-info">
                      <h5 class="mb-0">0</h5>
                      <small>{{__('lang.item')}}</small>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Statistics -->

    </div>
  </div>
  <!-- / Content -->
  <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container">
          <div class="card">
            <div class="card-header">
                <form method="get">
                    <div class="row ">
                        <div class="col-md-6">
                            <h5>{{__('lang.recentitem')}}</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="table-btn-css">

                            </div>
                        </div>


                        <div class="col-sm-2 display-inline-block mt-3">

                            <select class="form-control select2 form-select" name="pageno">
                                <option value="">{{__('lang.page')}}</option>
                                @foreach (config('constants.pagination_options') as $page)
                                <option value="{{ $page }}" {{ request('pageno') == $page ? 'selected' : '' }}>
                                    {{ $page }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <input type="text" class="form-control dt-full-name" placeholder="{{__('lang.name')}}" name="name" value="@if(isset($_GET['name']) && $_GET['name']!=''){{$_GET['name']}}@endif">
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <select class="form-control select2 form-select" name="status">
                                <option value="" {{ is_null(request('status')) ? 'selected' : '' }}>{{__('lang.select_status')}}</option>
                                @foreach(config('constants.status_types') as $value => $label)
                                <option value="{{ $value }}" {{ request('status') !== null && request('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <button type="submit" class="btn btn-primary data-submit">{{__('lang.search')}}</button>

                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('staffdashboard.index') }}">{{__('lang.reset')}}</a>

                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-nowrap">
                                <th>#</th>
                                <th>{{__('lang.image')}}</th>
                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.price')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                                <th>{{__('lang.status')}}</th>
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>
                                <td aria-colindex="2" role="cell" class="">
                                    <span class="b-avatar mr-1 badge-secondary rounded-circle">
                                        <span class="b-avatar-img">

                                            <img src="{{ isset($row->image) ? url('uploads/blog/'.$row->image) : url('uploads/Image-not-found.png') }}" width="100px">


                                        </span>
                                    </span>
                                </td>
                                <td>{{ $row->name }}</td>
                                  <td>{{ $row->price }}</td>
                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                <td>
                                    <a href="">
                                        <span class="badge {{ $row->status == 1 ? 'bg-success' : 'bg-warning' }}">
                         {{ $row->status == 1 ? __('lang.active') : __('lang.deactive') }}
                            </span>
                                    </a>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('item.form', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="record-not-found">
                                    <span>{{__('lang.no_record_found')}}</span>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <div class="col-md-6">
                    <h6 class="float-left">
                        @if ($result->firstItem())
                        {{__('lang.showing')}}{{ $result->firstItem() }}-{{ $result->lastItem() }} of {{ $result->total() }}
                        @endif
                    </h6>
                </div>
                <div class="col-md-6">
                    <div class="pagination float-right">
                        {{ $result->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>

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
          , made with ❤️ by <a href="#" target="_blank" class="footer-link">Fluttertop</a>
        </div>
      </div>
    </div>
  </footer>
  <!-- / Footer -->

  <div class="content-backdrop fade"></div>
</div>






@endsection
