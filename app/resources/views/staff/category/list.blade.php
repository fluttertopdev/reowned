@extends('staff.layout.app')
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
                            <h5>
                                @if(request()->has('category'))
                                Subcategory List - <span class="text-primary">({{ $result->first()?->parent?->name ?? 'N/A' }})</span>
                                @else
                                {{__('lang.category_list')}}
                                @endif
                            </h5>

                        </div>

                        <div class="col-md-6">
                            <div class="table-btn-css">
                                <a href="{{ isset(request()->category) ? route('category.form') . '?category=' . request()->category : route('category.form') }}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light">
                             <span class="ti-xs ti ti-plus me-1"></span>
                           {{ isset(request()->category) ? __('lang.add_subcategory') : __('lang.add_category') }}
                                </button>

                                </a>
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

                        @if(request()->has('category'))
                        <input type="hidden" name="category" value="{{ request()->get('category') }}">
                        @endif
                        <div class="col-sm-3 display-inline-block mt-3">
                            <button type="submit" class="btn btn-primary data-submit">{{__('lang.search')}}</button>
                            @if(request()->has('category'))
                            <a type="reset" class="btn btn-outline-secondary"
                                href="{{ route('category.index', ['category' => request()->get('category')]) }}">
                                {{__('lang.reset')}}
                            </a>
                            @else
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('category.index') }}">{{__('lang.reset')}}</a>
                            @endif
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
                                <th>{{ isset(request()->category) ? __('lang.subcategory') : __('lang.category') }}</th>

                                @if(!isset(request()->category)) <!-- Show subcategories only for main categories -->
                                <th>{{__('lang.subcategory')}}</th>
                                @endif
                                <th>{{__('lang.created_at')}}</th>
                                <th>{{__('lang.status')}}</th>
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>

                                <td>{{ $row->name }}</td>

                                @if(!isset(request()->category))

                                <td>
                                    <a href="{{ route('category.index', ['category' => $row->id]) }}">
                                        {{ $row->subcategories->pluck('name')->implode(', ') ?: 'N/A' }}
                                    </a>
                                </td>



                                @endif

                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>

                                <td>
                                    <a href="{{ route('category.updateStatus', $row->id) }}">
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
                                            @if(!isset(request()->category))
                                            <a href="{{ route('category.index', ['category' => $row->id]) }}" class="dropdown-item" type="button">
                                                <i class="ti ti-eye me-1"></i>{{__('lang.view')}}
                                            </a>
                                            @endif

                                            <a href="{{ request()->has('category') 
                          ? route('category.form', $row->id) . '?category=' . request()->category 
                                  : route('category.form', $row->id) }}"
                                                class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>



                                            <a onclick="showDeleteConfirmation('category', {{ $row->id }})" class="dropdown-item">
                                                <i class="ti ti-trash me-1"></i>{{__('lang.delete')}}
                                            </a>

                                            @if(!isset(request()->category))
                                            <!-- Show 'Add Subcategory' for Categories only -->
                                            <a href="{{ route('category.index', ['category' => $row->id]) }}" class="dropdown-item">
                                                <i class="ti ti-plus me-1"></i>{{__('lang.add_subcategory')}}
                                            </a>

                                            @endif
                                              <a href="{{ route('category.translation', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-language me-1"></i> {{__('lang.translation')}}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="{{ isset(request()->category) ? 5 : 6 }}" class="record-not-found">
                                    <span>No data found</span>
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
    <!-- / Content -->
</div>
<!-- Content wrapper -->

@endsection
