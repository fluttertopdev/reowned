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
                        <div class="col-md-6">
                            <h5>{{__('lang.reportreasons')}}</h5>
                        </div>
                        <div class="col-md-6">
                            @can('reportreason.store')
                            <div class="table-btn-css">
                                <a href="{{route('reportreason.form')}}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light">
                                        <span class="ti-xs ti ti-plus me-1"></span>{{__('lang.addreportreasons')}}
                                    </button>
                                </a>
                            </div>
                            @endcan
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
                            <input type="text" class="form-control dt-full-name" placeholder="{{__('lang.reason')}}" name="name" value="@if(isset($_GET['name']) && $_GET['name']!=''){{$_GET['name']}}@endif">
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
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('reportreason.index') }}">{{__('lang.reset')}}</a>
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
                                <th>{{__('lang.reason')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                                @can('reportreason.updateStatus')
                                <th>{{__('lang.status')}}</th>
                                @endcan
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>
                                <td>{{ $row->reason }}</td>
                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                @can('reportreason.updateStatus')
                                <td>
                                    <a href="{{ route('reportreason.updateStatus', $row->id) }}">
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
                                            @can('reportreason.update')
                                            <a href="{{ route('reportreason.form', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>
                                            @endcan   
                                            @can('reportreason.destroy') 
                                            <a onclick="showDeleteConfirmation('reportreason', {{ $row->id }})" class="dropdown-item">
                                                <i class="ti ti-trash me-1"></i> {{__('lang.delete')}}
                                            </a>
                                            @endcan
                                            @can('reportreason.translation')
                                            <a href="{{ route('reportreason.translation', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-language me-1"></i> {{__('lang.translation')}}
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

@endsection