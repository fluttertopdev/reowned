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
                            <h5>
                                {{__('lang.contact_us_list')}}
                            </h5>
                        </div>

                        <div class="col-sm-3 display-inline-block mt-3">
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
                            <button type="submit" class="btn btn-primary data-submit">{{__('lang.search')}}</button>
                            <a type="reset" class="btn btn-outline-secondary" href="{{ route('contact_us.index') }}">{{__('lang.reset')}}</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-nowrap">
                                <th>{{__('lang.admin_id')}}</th>
                                <th>{{__('lang.admin_name')}}</th>
                                <th>{{__('lang.admin_email')}}</th>
                                <th>{{__('lang.admin_subject')}}</th>
                                <th>{{__('lang.admin_message')}}</th>
                                <th>{{__('lang.admin_action')}}</th>
                            </tr>
                        </thead>
                        <tbody>    
                            @php $i=0; @endphp 
                            @if(count($result) > 0) 
                                @foreach($result as $row) 
                                    @php $i++; @endphp 
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->subject}}</td>
                                        <td>{{$row->message}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" title="{{__('lang.admin_select_action')}}">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#edit-new-record_{{$row->id}}" aria-controls="edit-new-record_{{$row->id}}" title="{{__('lang.admin_edit')}}">
                                                    <i class="ti ti-pencil me-1 margin-top-negative-4"></i> {{__('lang.admin_reply')}} </a>
                                                </div>
                                            </div>
                                            <div class="offcanvas offcanvas-end" id="edit-new-record_{{$row->id}}">
                                                <div class="offcanvas-header border-bottom">
                                                    <h5 class="offcanvas-title" id="exampleModalLabel">{{__('lang.admin_reply')}}</h5>
                                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body flex-grow-1">
                                                    <form class="add-new-record pt-0 row g-2" id="edit-record" action="{{route('contact_us.reply')}}" method="POST" enctype="multipart/form-data" > 
                                                        @csrf 
                                                        <div class="col-sm-12">
                                                            <input type="hidden" name="id" value="{{$row->id}}">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-fullname">{{__('lang.admin_reply')}} <span class="required">*</span></label>
                                                                <textarea type="text" class="form-control" value="{{$row->value}}" name="reply" placeholder="{{__('lang.admin_reply_placeholder')}}" required>{{$row->reply}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">{{__('lang.admin_button_send')}}</button>
                                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">{{__('lang.admin_button_cancel')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> 
                                @endforeach 
                            @else 
                                <tr>
                                    <td colspan="7" class="record-not-found">
                                        <span>{{__('lang.admin_record_not_found')}}</span>
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