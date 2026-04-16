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
                            <h5>{{__('lang.languages_list')}}</h5>
                        </div>
                        @can('language.store')
                        <div class="col-md-6">
                            <div class="table-btn-css">
                                <a href="{{route('language.form')}}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light">
                                        <span class="ti-xs ti ti-plus me-1"></span>{{__('lang.add_languages')}}
                                    </button>
                                </a>
                            </div>
                        </div>
                        @endcan
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
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('language.index') }}">{{__('lang.reset')}}</a>
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
                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.code')}}</th>
                                <th>{{__('lang.position')}}</th>
                                @can('language.updateStatus')
                                <th>{{__('lang.status')}}</th>
                                @endcan
                                <th>{{__('lang.default')}}</th>
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->code }}</td>
                                <td>{{ $row->position }}</td>
                                @can('language.updateStatus')
                                <td>
                                    <a href="{{route('language.updateStatus', $row->id) }}">
                                        <span class="badge {{ $row->status == 1 ? 'bg-success' : 'bg-warning' }}">{{ $row->status == 1 ? __('lang.active') : __('lang.deactive') }}</span>
                                    </a>
                                </td>
                                @endcan
                                <td>
                                    @if($row->is_default==1)
                                    <span class="badge bg-success">{{__('lang.yes')}}</span>
                                    @else
                                    <span class="badge bg-danger">{{__('lang.no')}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('language.update')
                                            <a href="{{ route('language.form', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>
                                            @endcan
                                            @can('language.destroy')
                                            @if($row->is_default != 1)
                                            <a onclick="showDeleteConfirmation('language', {{ $row->id }})" class="dropdown-item">
                                                <i class="ti ti-trash me-1"></i>{{__('lang.delete')}}
                                            </a>
                                            @endcan
                                            @endif
                                            @can('translation.index')
                                            <a href="{{ route('translation.index', $row->id) }}" class="dropdown-item">
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
