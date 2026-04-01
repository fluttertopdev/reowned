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
                            <h5>{{__('lang.faq_list')}}</h5>
                        </div>
                          @can('add-faq')
                        <div class="col-md-6">
                            <div class="table-btn-css">
                                <a href="{{route('faq.create')}}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light">
                                        <span class="ti-xs ti ti-plus me-1"></span>{{__('lang.add_faq')}}
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

                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('faq.index') }}">{{__('lang.reset')}}</a>

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
                                <th>{{__('lang.question')}}</th>
                                 <th>{{__('lang.answer')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                                <th>{{__('lang.status')}}</th>
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>

                                <td>{{ $row->title }}</td>
                                
                               <td>{{ Str::limit(strip_tags($row->description), 100, '...') }}</td>

                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                <td>
                                    <a href="{{ route('faq.updateStatus', $row->id) }}">
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
                                             @can('update-faq')
                                            <a href="{{ route('faq.edit', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>
                                            @endcan
                                               @can('delete-faq')
                                            <a onclick="showDeleteConfirmation('faq', {{ $row->id }})" class="dropdown-item">
                                                <i class="ti ti-trash me-1"></i>{{__('lang.delete')}}
                                            </a>
                                              @endcan
                                                 @can('faq-translation')
                                             <a href="{{ route('faq.translation', $row->id) }}" class="dropdown-item">
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
                        Showing {{ $result->firstItem() }}-{{ $result->lastItem() }} of {{ $result->total() }}
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
