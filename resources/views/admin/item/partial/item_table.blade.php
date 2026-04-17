<!-- Bordered Table -->
<div class="card mt-4">
    <div class="card-header">
        <form method="get">
            <div class="row ">
                <div class="col-md-12">
                    <h5>{{__('lang.item_list')}}</h5>
                </div>
                <div class="col-sm-3 display-inline-block mb-3">
                    <select class="form-control select2 form-select" name="pageno">
                        <option value="">{{__('lang.page')}}</option>
                        @foreach (config('constants.pagination_options') as $page)
                        <option value="{{ $page }}" {{ request('pageno') == $page ? 'selected' : '' }}>
                            {{ $page }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 display-inline-block mb-3">
                    <input type="text" class="form-control dt-full-name" placeholder="{{__('lang.title')}}" name="title" value="@if(isset($_GET['title']) && $_GET['title']!=''){{$_GET['title']}}@endif">
                </div>
                <div class="col-sm-3 display-inline-block mb-3">
                    <select class="form-control select2 form-select" name="user_id">
                        <option value="" {{ is_null(request('status')) ? 'selected' : '' }}>{{__('lang.select_user')}}</option>
                        @if(count($users))
                            @foreach($users as $each)
                                <option value="{{$each->id}}" @if(isset($_GET['user_id']) && $_GET['user_id']!='') @if($_GET['user_id']==$each->id) selected @endif @endif>{{$each->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-3 display-inline-block mb-3">
                    <select class="form-control select2 form-select" name="status">
                        <option value="" {{ is_null(request('status')) ? 'selected' : '' }}>{{__('lang.select_status')}}</option>
                        @foreach(config('constants.status_types') as $value => $label)
                        <option value="{{ $value }}" {{ request('status') !== null && request('status') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 display-inline-block mb-3">
                    <select class="form-control select2 form-select" name="is_sold">
                        <option value="" {{ is_null(request('is_sold')) ? 'selected' : '' }}>{{__('lang.select_sold_status')}}</option>
                        @foreach(config('constants.sold_status_types') as $value => $label)
                        <option value="{{ $value }}" {{ request('is_sold') !== null && request('is_sold') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 display-inline-block mb-3">
                    <button type="submit" class="btn btn-primary data-submit">{{__('lang.search')}}</button>
                    <a type="reset" class="btn btn-outline-secondary" href="{{ route('item.index') }}">{{__('lang.reset')}}</a>
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
                        <th>{{__('lang.username')}}</th>
                        <th>{{__('lang.title')}}</th>
                        <th>{{__('lang.price')}}</th>
                        <th>{{__('lang.created_at')}}</th>
                        @can('item.updateStatus')
                        <th>{{__('lang.status')}}</th>
                        @endcan
                    </tr>
                <tbody>
                    @if($result->count() > 0)
                    @foreach($result as $index => $row)
                    <tr>
                        <td>{{ $result->firstItem() + $index }}</td>
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