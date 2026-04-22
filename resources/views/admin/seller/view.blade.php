@extends('admin.layout.app')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-9">
                <h4 class="py-3 mb-4">
                  {{__('lang.admin_view_seller_form')}}</h4>
            </div>
             <div class="col-md-3">
                <div class="table-btn-css">
                    <a type="reset" class="btn btn-outline-secondary" href="{{url('admin/seller')}}">{{__('lang.admin_back')}}</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <button
                                type="button"
                                class="nav-link active"
                                data-bs-toggle="tab"
                                data-bs-target="#form-tabs-item"
                                role="tab"
                                aria-selected="true"
                                >
                                {{__('lang.admin_items')}}
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                    type="button"
                                    class="nav-link"
                                    id="form-tabs-food-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#form-tabs-package"
                                    role="tab"
                                    aria-controls="form-tabs-food"
                                    aria-selected="false"
                                >
                                    {{__('lang.admin_packages')}}
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                type="button"
                                class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#form-tabs-transaction"
                                role="tab"
                                aria-selected="false"
                                >
                                {{__('lang.admin_transactions')}}
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <!-- Item-->
                        <div class="tab-pane fade active show" id="form-tabs-item" role="tabpanel">
                            <div class="row g-3">
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-light">
                                                <tr class="text-nowrap">
                                                    <th>#</th>
                                                    <th>{{__('lang.image')}}</th>
                                                    <th>{{__('lang.username')}}</th>
                                                    <th>{{__('lang.title')}}</th>
                                                    <th>{{__('lang.price')}}</th>
                                                    <th>{{__('lang.created_at')}}</th>
                                                    @can('item.updateStatus')
                                                    <th>{{__('lang.status')}}</th>
                                                    @endcan
                                                </tr>
                                            <tbody>
                                                @if($itemData->count() > 0)
                                                @foreach($itemData as $index => $row)
                                                <tr>
                                                    <td>{{ $itemData->firstItem() + $index }}</td>
                                                    <td aria-colindex="2" role="cell" class="">
                                                        <span class="b-avatar mr-1 badge-secondary rounded-circle">
                                                            <span class="b-avatar-img">
                                                                <img src="{{ isset($row->latestImage) ? url($row->latestImage?->image) : url('uploads/Image-not-found.png') }}" width="100px" class="item-list-img">
                                                            </span>
                                                        </span>
                                                    </td>
                                                    <td>{{ $row->user ? $row->user->name : '--'; }}</td>
                                                    <td>{{ $row->title }}</td>
                                                    <td>{{ \Helpers::commonCurrencyFormate().$row->price }}</td>
                                                    <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                                    @can('item.updateStatus')
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown">
                                                                {{ $row->status == 0 
                                                                    ? __('lang.under_review') 
                                                                    : ($row->status == 1 
                                                                        ? __('lang.approved') 
                                                                        : __('lang.rejected')) 
                                                                }}
                                                            </button>

                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('item.updateStatus', [$row->id, 0]) }}">
                                                                        {{ __('lang.under_review') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('item.updateStatus', [$row->id, 1]) }}">
                                                                        {{ __('lang.approve') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item text-danger" href="{{ route('item.updateStatus', [$row->id, 2]) }}">
                                                                        {{ __('lang.reject') }}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="mt-2">
                                                            @if($row->is_sold == 1)
                                                                <span class="badge bg-danger">{{ __('lang.sold') }}</span>
                                                            @else
                                                                <span class="badge bg-success">{{ __('lang.available') }}</span>
                                                            @endif
                                                        </div>   
                                                    </td>
                                                    @endcan
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="8" class="record-not-found">
                                                        <span>{{__('lang.no_record_found')}}</span>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-md-6">
                                            <h6 class="float-left">
                                                @if ($itemData->firstItem())
                                                {{__('lang.showing')}}{{ $itemData->firstItem() }}-{{ $itemData->lastItem() }} of {{ $itemData->total() }}
                                                @endif
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="pagination float-right">
                                                {{ $itemData->withQueryString()->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>             
                        </div>
                        
                        <!-- Package -->
                        <div class="tab-pane fade" id="form-tabs-package" role="tabpanel">
                            <div class="row g-3">
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                       <table class="table">
                                            <thead class="table-light">
                                                <tr class="text-nowrap">
                                                    <th>#</th>
                                                    <th>{{__('lang.name')}}</th>
                                                    <th>{{__('lang.email')}}</th>
                                                    <th>{{__('lang.packagename')}}</th>
                                                    <th>{{__('lang.startdate')}}</th>
                                                    <th>{{__('lang.enddate')}}</th>
                                                    <th>{{__('lang.totallimit')}}</th>
                                                    <th>{{__('lang.usedlimit')}}</th>
                                                    <th>{{__('lang.status')}}</th>
                                                    <th>{{__('lang.purchase_date')}}</th>
                                                </tr>
                                            <tbody>
                                                @if($result->count() > 0)
                                                @foreach($result as $index => $row)
                                                    <tr>
                                                        <td>{{ $result->firstItem() + $index }}</td>

                                                        <td>{{ $row->user->name ?? '--' }}</td>

                                                        <td>{{ $row->user->email ?? '--' }}</td>

                                                        <td>
                                                            {{ $row->itemPackage->name ?? $row->adPackage->name ?? '--' }}
                                                            <br>
                                                            <span class="badge bg-warning mt-1">{{ $row->item_package_id!=null ? 'Item Listing' : 'Advertisement' }}</span>
                                                        </td>

                                                        <td>{{ \Helpers::commonDateFormate($row->start_date) }}</td>

                                                        <td>
                                                            {{ $row->end_date ? \Helpers::commonDateFormate($row->end_date) : 'Unlimited' }}
                                                        </td>

                                                        <td>{{ $row->total_limit ?? 'Unlimited' }}</td>

                                                        <td>{{ $row->used_limit }}</td>

                                                        <td>
                                                            @php
                                                                $isExpired = false;

                                                                if ($row->end_date && \Carbon\Carbon::parse($row->end_date)->lt(now())) {
                                                                    $isExpired = true;
                                                                }
                                                            @endphp

                                                            <span class="badge 
                                                                {{ (!$isExpired && $row->is_active == 1) ? 'bg-success' : 'bg-danger' }}">
                                                                
                                                                {{ (!$isExpired && $row->is_active == 1) ? __('lang.active') : __('lang.expired') }}
                                                            
                                                            </span>
                                                        </td>

                                                        <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="10" class="record-not-found">
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

                        <!-- Transactions -->
                        <div class="tab-pane fade" id="form-tabs-transaction" role="tabpanel">
                            <div class="row g-3">
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-light">
                                                <tr class="text-nowrap">
                                                    <th>#</th>
                                                    <th>{{__('lang.username')}}</th>
                                                    <th>{{__('lang.packagename')}}</th>
                                                    <th>{{__('lang.amount')}}</th>
                                                    <th>{{__('lang.paymentgateway')}}</th>
                                                    <th>{{__('lang.paymentstatus')}}</th>
                                                    <th>{{__('lang.created_at')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($transactionData->count() > 0)
                                                    @foreach($transactionData as $index => $row)
                                                    <tr>
                                                        <td>{{ $transactionData->firstItem() + $index }}</td>
                                                        <td>{{ $row->user ? $row->user->name : '--' }}</td>
                                                        <td>{{ $row->package_name }}</td>
                                                        <td>{{ number_format($row->amount, 2) }} {{ strtoupper($row->currency) }}</td>
                                                        <td>
                                                            {{ ucfirst($row->payment_gateway ?? '--') }}
                                                        </td>
                                                        <td>
                                                            @if($row->payment_status == 'success')
                                                                <span class="badge bg-success">{{__('lang.paid')}}</span>
                                                            @elseif($row->payment_status == 'failed')
                                                                <span class="badge bg-danger">{{__('lang.failed')}}</span>
                                                            @else
                                                                <span class="badge bg-warning">{{__('lang.pending')}}</span>
                                                            @endif
                                                        </td>
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
                                            @if ($transactionData->firstItem())
                                            {{__('lang.showing')}} {{ $transactionData->firstItem() }}-{{ $transactionData->lastItem() }} of {{ $transactionData->total() }}
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="pagination float-right">
                                            {{ $transactionData->withQueryString()->links('pagination::bootstrap-4') }}
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
    <!-- / Content -->
</div>
<!-- Content wrapper -->

@endsection