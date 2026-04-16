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
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{__('lang.translation_list')}}</h5>
                        </div>
                        <div class="col-md-6">
                            @can('translation.store')
                            <div class="table-btn-css">
                                <a href="{{ route('translation.create', Request::segment(4)) }}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light">
                                        <span class="ti-xs ti ti-plus me-1"></span>{{__('lang.add_translation')}}
                                    </button>
                                </a>
                            </div>
                            @endcan
                        </div>
                        <div class="col-sm-2 display-inline-block mt-3">
                            <select class="form-control select2 form-select" name="perpage" onchange="this.form.submit()">
                                <option value="">{{__('lang.page')}}</option>
                                @foreach (config('constants.pagination_options') as $page)
                                    <option value="{{ $page }}" {{ request('perpage') == $page ? 'selected' : '' }}>
                                        {{ $page }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <input type="text" class="form-control dt-full-name" placeholder="{{__('lang.value')}}" name="value" value="{{ request('value') }}">
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <select class="form-control select2 form-select" name="group">
                                <option value="" {{ is_null(request('group')) ? 'selected' : '' }}>{{__('lang.select_group')}}</option>
                                @foreach(config('constants.group') as $value => $label)
                                    <option value="{{ $value }}" {{ request('group') !== null && request('group') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 display-inline-block mt-3">
                            <button type="submit" class="btn btn-primary data-submit">{{__('lang.search')}}</button>
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('translation.index', Request::segment(4)) }}">{{__('lang.reset')}}</a>
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
                                <th>{{__('lang.group_name')}}</th>
                                <th>{{__('lang.value')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($result->count() > 0)
                                @foreach($result as $index => $row)
                                    <tr>
                                        <td>{{ $result->firstItem() + $index }}</td>
                                        <td>{{ $row->group ?? '--' }}</td>
                                        <td>
                                            <input type="text" name="value" value="{{ $row->value }}" class="form-control update-value" data-id="{{ $row->id }}">
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
                <div class="d-flex justify-content-between align-items-center">
                    <h6>
                        @if ($result->firstItem())
                            {{__('lang.showing')}} {{ $result->firstItem() }}-{{ $result->lastItem() }} of {{ $result->total() }}
                        @endif
                    </h6>
                    <div class="pagination">
                        {{ $result->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>

@endsection