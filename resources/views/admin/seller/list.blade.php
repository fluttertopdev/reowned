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
                            <h5>{{__('lang.sellerverification')}}</h5>
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
                            <select class="form-control select2 form-select" name="status">
                                <option value="" {{ is_null(request('status')) ? 'selected' : '' }}>{{__('lang.select_status')}}</option>
                                @foreach(config('constants.status_types') as $value => $label)
                                <option value="{{ $value }}" {{ request('status') !== null && request('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 display-inline-block mt-3">

                            <button type="submit" class="btn btn-primary data-submit">
                                {{__('lang.search')}}
                            </button>

                            <a class="btn btn-outline-secondary"
                                href="{{ route('seller.index') }}">
                                {{__('lang.reset')}}
                            </a>

                            <!-- Export Dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bi bi-download"></i> {{__('lang.export')}}
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('seller.export.excel') }}">
                                            {{__('lang.export_to_excel')}}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('seller.export.pdf') }}">
                                            {{__('lang.export_to_pdf')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.email')}}</th>
                                <th>{{__('lang.phone')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                                @can('seller.updateStatus')
                                <th>{{__('lang.status')}}</th>
                                @endcan
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        <tbody>
                            @if($result->count() > 0)
                            @foreach($result as $index => $row)
                            <tr>
                                <td>{{ $result->firstItem() + $index }}</td>
                                <td aria-colindex="2" role="cell">
                                    <span class="b-avatar mr-1 badge-secondary rounded-circle">
                                        <span class="b-avatar-img">
                                            <img src="{{ isset($row->image) ? url('uploads/user/'.$row->image) : asset('uploads/Image-not-found.png') }}"
                                                width="50px"
                                                class="img-thumbnail zoom-image"
                                                onclick="openImageModal(this)">
                                        </span>
                                    </span>
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                @can('seller.updateStatus')
                                <td>
                                    <a href="{{ route('seller.updateStatus', $row->id) }}">
                                        <span class="badge {{ $row->status == 1 ? 'bg-success' : 'bg-warning' }}">
                                            {{ $row->status == 1 ? __('lang.approved') : __('lang.pending') }}
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
                                            @can('seller.update')
                                            <a href="{{ route('seller.form', $row->id) }}" class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i>{{__('lang.edit')}}
                                            </a>
                                            @endcan

                                            @can('seller.destroy')
                                            <a onclick="showDeleteConfirmation('user', {{ $row->id }})" class="dropdown-item">
                                                <i class="ti ti-trash me-1"></i> {{__('lang.delete')}}
                                            </a>
                                            @endcan

                                            <a href="javascript:void(0);"
                                                class="dropdown-item"
                                                onclick="openVerificationModal('{{ $row->id_proof_front }}','{{ $row->id_proof_back }}')">
                                                <i class="ti ti-file me-1"></i> {{__('lang.identity_proff')}}
                                            </a>

                                            <a href="{{url('admin/seller/view-details/'.$row->id)}}" class="dropdown-item">
                                                <i class="ti ti-eye me-1"></i> {{__('lang.view_details')}}
                                            </a>

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


<!-- Verification Modal -->
<div class="modal fade" id="verificationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{__('lang.verification_details')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                <div class="row">
                    <div class="col-md-6">
                        <h6>{{__('lang.id_proff')}} ({{__('lang.front')}})</h6>
                        <img id="idFrontImage"
                            src=""
                            class="img-fluid img-thumbnail"
                            style="max-height:300px;">
                    </div>

                    <div class="col-md-6">
                        <h6>{{__('lang.id_proff')}} ({{__('lang.back')}})</h6>
                        <img id="idBackImage"
                            src=""
                            class="img-fluid img-thumbnail"
                            style="max-height:300px;">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection