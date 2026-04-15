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
                            <h5>{{__('lang.paymenttransactions')}}</h5>
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
                            <select class="form-control form-select select2" name="payment_gateway">
                                <option value="">{{__('lang.all_gateways')}}</option>
                                @foreach($paymentMethods as $key => $value)
                                    <option value="{{ $key }}" {{ request('payment_gateway') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <button type="submit" class="btn btn-primary data-submit">{{__('lang.search')}}</button>

                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('transactions.index') }}">{{__('lang.reset')}}</a>
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
                                <th>{{__('lang.username')}}</th>
                                <th>{{__('lang.packagename')}}</th>
                                <th>{{__('lang.amount')}}</th>
                                <th>{{__('lang.paymentgateway')}}</th>
                                <th>{{__('lang.paymentstatus')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($result->count() > 0)
                                @foreach($result as $index => $row)
                                <tr>
                                    <td>{{ $result->firstItem() + $index }}</td>
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