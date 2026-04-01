@extends('admin.layout.app')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Bordered Table -->
        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ __('lang.advertisement_package') }}</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <form action="{{route('customer.assignpackage')}}" method="POST" id="bulkDeleteForm">
                            @csrf
                            <input type="hidden" name="user_ids[]" value="<?php echo $segment1 =  Request::segment(4);  ?>" class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('lang.assignpackage') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-nowrap">
                                <th></th> <!-- Select All Checkbox -->
                                <th>#</th>
                                <th>{{__('lang.image')}}</th>
                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.price')}}</th>
                                <th>{{__('lang.discount')}}</th>
                                <th>{{__('lang.final_price')}}</th>
                                <th>{{__('lang.days')}}</th>
                                <th>{{__('lang.item')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                                <th>{{__('lang.status')}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($result->count() > 0)
                                @foreach($result as $index => $row)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_ids[]" value="{{ $row->id }}" class="rowCheckbox" form="bulkDeleteForm">
                                    </td>
                                    <td>{{ $result->firstItem() + $index }}</td>
                                    <td aria-colindex="2" role="cell">
                                        <span class="b-avatar mr-1 badge-secondary rounded-circle">
                                            <span class="b-avatar-img">
                                                <img src="{{ isset($row->image) ? url('uploads/packages/'.$row->image) : asset('uploads/Image-not-found.png') }}"
                                                    width="50px"
                                                    class="img-thumbnail zoom-image"
                                                    onclick="openImageModal(this)">
                                            </span>
                                        </span>
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ setting('currency') }}{{ $row->price }}</td>
                                    <td>{{ $row->discount }}</td>
                                    <td>{{ setting('currency') }}{{ $row->final_price }}</td>
                                    <td>{{ $row->days }}</td>
                                    <td>
                                        @if($row->item == 'limited')
                                        {{ $row->no_of_item }}
                                        @else
                                        {{ ucfirst($row->item) }}
                                        @endif
                                    </td>
                                    <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                    @can('status')
                                    <td>
                                        <a href="{{ route('advertisement-package.updateStatus', $row->id) }}">
                                            <span class="badge {{ $row->status == 1 ? 'bg-success' : 'bg-warning' }}">
                                                {{ $row->status == 1 ? __('lang.active') : __('lang.deactive') }}
                                            </span>
                                        </a>
                                    </td>
                                @endcan
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="10" class="record-not-found">
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
<!-- Assign Package Modal -->
<div class="modal fade" id="assignPackageModal" tabindex="-1" aria-labelledby="assignPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignPackageModalLabel">{{__('lang.assignpackage')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

           <form id="modalAssignForm" action="{{ route('customer.assignpackage') }}" method="POST">
                @csrf
                <input type="hidden" name="user_ids[]" id="modalUserIds">
                <input type="hidden" name="selected_ids[]" id="modalPackageIds">

                <div class="modal-body">
                    <textarea name="description" id="packageDescription" class="form-control" placeholder=" Description"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('lang.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('lang.assignpackage')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection