@extends('admin.layout.app')
@section('content')



<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Bordered Table -->
        <div class="card mt-4">
            <div class="card-header">
                <form method="get">
                    <div class="row ">
                        <div class="col-md-12">
                            <h5>{{__('lang.userreport')}}</h5>
                        </div>
                        <div class="col-sm-2 display-inline-block mt-3">
                            <select class="form-control select2 form-select" name="pageno">
                                <option value=""> {{__('lang.page')}}</option>
                                @foreach (config('constants.pagination_options') as $page)
                                <option value="{{ $page }}" {{ request('pageno') == $page ? 'selected' : '' }}>
                                    {{ $page }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <input type="text" class="form-control dt-full-name" placeholder="{{__('lang.name')}}/{{__('lang.item')}}" name="name" value="@if(isset($_GET['name']) && $_GET['name']!=''){{$_GET['name']}}@endif">
                        </div>
                       
                        <div class="col-sm-3 display-inline-block mt-3">
                            <button type="submit" class="btn btn-primary data-submit">{{__('lang.search')}}</button>
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('userreport.index') }}">{{__('lang.reset')}}</a>
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
                                <th>{{__('lang.ad_id')}}</th>
                                <th>{{__('lang.image')}}</th>
                                <th>{{__('lang.title')}}</th>
                                <th>{{__('lang.user_name')}}</th>
                                <th>{{__('lang.created_date')}}</th>
                                <th>{{__('lang.reported_no')}}</th>
                                <th>{{__('lang.status')}}</th>
                                <th>{{__('lang.action')}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>

                                <!-- Ad ID -->
                                <td>{{ $row->item_id }}</td>

                                <!-- Image -->
                                <td>
                                    <img src="{{ $row->item && $row->item->latestImage 
                                        ? url($row->item->latestImage?->image) 
                                        : url('uploads/Image-not-found.png') }}" 
                                        width="50">
                                </td>

                                <!-- Title -->
                                <td>{{ $row->item->title ?? '--' }}</td>

                                <!-- Username -->
                                <td>{{ $row->item->user->name ?? '--' }}</td>

                                <!-- Created Date -->
                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>

                                <!-- Report Count -->
                                <td>{{ $row->total_reports }}</td>

                                <!-- Status -->
                                <td>
                                    @if($row->item && $row->item->status == 1)
                                        <span class="badge bg-success">{{__('lang.active')}}</span>
                                    @else
                                        <span class="badge bg-danger">{{__('lang.deactive')}}</span>
                                    @endif
                                </td>

                                <!-- Action -->
                                <td>
                                    <a href="{{ route('userreport.form', $row->item_id) }}" class="btn btn-sm btn-primary">
                                        {{__('lang.view_detail')}}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="9" class="record-not-found">
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