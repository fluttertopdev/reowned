@extends('admin.layout.app')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-md-9">
                <h4 class="py-3 mb-4">
                  <span class="text-muted fw-light">
                    <a href="{{url('admin/dashboard')}}">{{__('lang.admin_dashboard')}}</a> /
                  </span><span class="text-muted fw-light">
                    <a href="{{route('userreport.index')}}">{{__('lang.userreport')}} {{__('lang.admin_list')}}</a> /
                  </span>
                  {{__('lang.view')}}</h4>
            </div>
             <div class="col-md-3">
                <div class="table-btn-css">
                    <a type="reset" class="btn btn-outline-secondary" href="{{route('userreport.index')}}">{{__('lang.admin_back')}}</a>
                </div>
            </div>
        </div>

        <!-- Bordered Table -->
        <div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-nowrap">
                                <th>#</th>
                                <th>{{ __('lang.image') }}</th>
                                <th>{{ __('lang.name') }}</th>
                                <th>{{ __('lang.email') }}</th>
                                <th>{{ __('lang.phone') }}</th>
                                <th>{{ __('lang.reason') }}</th>
                                <th>{{ __('lang.reported_at') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>

                                <!-- Image -->
                                <td>
                                    <img src="{{ $row->user && $row->user->image 
                                        ? url('uploads/user/'.$row->user->image) 
                                        : asset('uploads/Image-not-found.png') }}"
                                        width="50"
                                        class="img-thumbnail">
                                </td>

                                <!-- Name -->
                                <td>{{ $row->user->name ?? '--' }}</td>

                                <!-- Email -->
                                <td>{{ $row->user->email ?? '--' }}</td>

                                <!-- Phone -->
                                <td>{{ $row->user->phone ?? '--' }}</td>

                                <!-- Reason -->
                                <td>{{ $row->reportReason->reason ?? '--' }}</td>

                                <!-- Date -->
                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="record-not-found">
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
                        {{__('lang.showing')}} {{ $result->firstItem() }}-{{ $result->lastItem() }} of {{ $result->total() }}
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
    <!-- / Content -->
</div>
<!-- Content wrapper -->

@endsection