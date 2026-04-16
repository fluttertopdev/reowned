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
                            <h5>{{__('lang.customers')}}</h5>
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
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('customer.index') }}">{{__('lang.reset')}}
                            </a>
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
                                <th>{{__('lang.email')}}</th>
                                <th>{{__('lang.phone')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                                @can('customer.updateStatus')
                                <th>{{__('lang.status')}}</th>
                                @endcan
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>
                                <td aria-colindex="2" role="cell">
                                    <span class="b-avatar mr-1 badge-secondary rounded-circle">
                                        <span class="b-avatar-img">
                                            <img src="{{ isset($row->image) ? url('uploads/user/'.$row->image) : asset('uploads/Image-not-found.png') }}"
                                                width="50px"
                                                class="img-thumbnail zoom-image"
                                                onclick="openImageModal(this)">
                                        </span>
                                    </span>
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                @can('customer.updateStatus')
                                <td>
                                    <a href="{{ route('customer.updateStatus', $row->id) }}">
                                        <span class="badge {{ $row->status == 1 ? 'bg-success' : 'bg-warning' }}">
                                            {{ $row->status == 1 ? __('lang.active') : __('lang.deactive') }}
                                        </span>
                                    </a>
                                </td>
                                @endcan
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('customer.update')
                                            <a href="{{ route('customer.form', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>
                                            @endcan
                                            @can('customer.assignpackage')
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#assignpackage" data-id="{{ $row->id }}">
                                                <i class="ti ti-package me-1"></i> {{ __('lang.assignpackage') }}
                                            </a> 
                                            @endcan
                                            @can('customer.userpackage')
                                            <a href="{{ route('customer.userpackage', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-eye"></i>{{__('lang.viewpackages')}}
                                            </a>
                                             @endcan 
                                            @can('customer.destroy') 
                                            <a onclick="showDeleteConfirmation('user', {{ $row->id }})" class="dropdown-item">
                                                <i class="ti ti-trash me-1"></i> {{__('lang.delete')}}
                                            </a>
                                            @endcan
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

<div class="modal fade" id="assignpackage" tabindex="-1" aria-labelledby="bulkUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkUploadModalLabel">{{__('lang.assignpackage')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Hidden input to store row ID -->
            <input type="hidden" id="rowIdInput" name="row_id">
            
            <div class="modal-body">
                <select class="form-control select2 form-select" id="packageSelect" required>
                    <option value="">{{ __('lang.please_select') }}</option>
                    <option value="{{ url('/admin/customer/ads-package') }}">{{ __('lang.advertisement_package') }}</option>
                    <option value="{{url('/admin/customer/item-package')}}">{{ __('lang.item_listing_package') }}</option>
                </select>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal">{{__('lang.cancel')}}</button>
            </div>
        </div>
    </div>
</div>



@endsection