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
                            <h5>
                                @if(request()->has('category'))
                                {{__('lang.subcategory_list')}} - <span class="text-primary">({{ $result->first()?->parent?->name ?? 'N/A' }})</span>
                                @else
                                {{__('lang.category_list')}}
                                @endif
                            </h5>

                        </div>

                        <div class="col-md-6">
                            @can('add-category')
                            <div class="table-btn-css">
                                <a href="{{ isset(request()->category) ? route('category.form') . '?category=' . request()->category : route('category.form') }}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light">
                                        <span class="ti-xs ti ti-plus me-1"></span>
                                        {{ isset(request()->category) ? __('lang.add_subcategory') : __('lang.add_category') }}
                                    </button>

                                </a>
                            </div>
                            @endcan
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
                                <th>{{__('lang.image')}}</th>
                                <th>{{ isset(request()->category) ? __('lang.subcategory') : __('lang.category') }}</th>
                                @if(!isset(request()->category))
                                <th>{{__('lang.subcategory')}}</th>
                                @endif
                                <th>{{__('lang.created_at')}}</th>
                                <th>{{__('lang.status')}}</th>
                                @if(!isset(request()->category))
                                <th>{{__('lang.featured')}}</th>
                                @endif
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody id="category_table">
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr class="row1" data-id="{{ $row->id }}" data-featured="{{ $row->is_featured }}">
                                <td>{{ $result->firstItem() + $index }}</td>
                                <td aria-colindex="2" role="cell">
                                    <span class="b-avatar mr-1 badge-secondary rounded-circle">
                                        <span class="b-avatar-img">
                                            <img src="{{ isset($row->image) ? url('uploads/category/'.$row->image) : asset('uploads/Image-not-found.png') }}"
                                                width="50px"
                                                class="img-thumbnail zoom-image"
                                                onclick="openImageModal(this)">
                                        </span>
                                    </span>
                                </td>

                                <td>{{ $row->name }}</td>

                                @if(!isset(request()->category))
                                <td>
                                    <a href="{{ route('category.index', ['category' => $row->id]) }}">
                                        @php
                                            $subcategories = $row->subcategories->pluck('name');
                                        @endphp

                                        @if($subcategories->count() > 2)
                                            {{ $subcategories->take(2)->implode(', ') . '...' }}
                                        @else
                                            {{ $subcategories->implode(', ') ?: 'N/A' }}
                                        @endif
                                    </a>
                                </td>
                                @endif

                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                @can('category-status')
                                <td>
                                    <a href="{{ route('category.updateStatus', $row->id) }}">
                                        <span class="badge {{ $row->status == 1 ? 'bg-success' : 'bg-warning' }}">
                                            {{ $row->status == 1 ? __('lang.active') : __('lang.deactive') }}
                                        </span>

                                    </a>

                                </td>
                                @endcan
                                @if(!isset(request()->category))
                                <td>
                                    <a href="{{ route('category.updateFeatured', $row->id) }}">
                                        <span class="badge {{ $row->is_featured == 1 ? 'bg-success' : 'bg-warning' }}">
                                            {{ $row->is_featured == 1 ? __('lang.yes') : __('lang.no') }}
                                        </span>
                                    </a>
                                </td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if(!isset(request()->category))
                                            @can('view-category')
                                            <a href="{{ route('category.index', ['category' => $row->id]) }}" class="dropdown-item" type="button">
                                                <i class="ti ti-eye me-1"></i>{{__('lang.view')}}
                                            </a>
                                            @endcan
                                            @endif
                                            @can('update-category')
                                            <a href="{{ request()->has('category') ? route('category.form', $row->id) . '?category=' . request()->category : route('category.form', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>
                                            @endcan

                                            @can('delete-category')
                                            <a onclick="showDeleteConfirmation('category', <?= $row->id ?>)" class="dropdown-item">
                                                <i class="ti ti-trash me-1"></i>{{__('lang.delete')}}
                                            </a>
                                            @endcan

                                            @if(!isset(request()->category))
                                            <!-- Show 'Add Subcategory' for Categories only -->
                                            @can('add-subcategory')
                                            <a href="{{ route('category.index', ['category' => $row->id]) }}" class="dropdown-item">
                                                <i class="ti ti-plus me-1"></i>{{__('lang.add_subcategory')}}
                                            </a>
                                            @endcan
                                            @endif
                                            @can('category-translation')
                                            <a href="{{ route('category.translation', $row->id) }}" class="dropdown-item">
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

<!-- 1. jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- 2. jQuery UI SECOND -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- 3. YOUR SCRIPT LAST -->
<script>
$(document).ready(function(){

    $("#category_table").sortable({
        items: "tr.row1[data-featured='1']",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderofCategoryToServer();
        }
    });

});

function sendOrderofCategoryToServer() {
    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');

    $('#category_table tr.row1').each(function(index, element) {
        order.push({
            id: $(this).attr('data-id'),
            position: index + 1
        });
    });

    $.ajax({
        type: "POST",
        dataType: "json",
        url: base_url + "/admin/category-sortable",
        data: {
            order: order,
            _token: token
        },
        success: function(response) {
            console.log(response);
        }
    });
  }
</script>

@endsection