@extends('admin.layout.app')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{__('lang.item_listing_package')}}</h5>
                    </div>
                    <div class="col-md-6 text-end">
                         <input type="hidden" name="user_ids[]" value="<?php echo $segment1 =  Request::segment(4);  ?>" class="">
                        <button type="button" class="btn btn-primary" id="assignItemPackageBtn">
                            {{ __('lang.assignpackage') }}
                        </button>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th></th>
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
                                    <input type="checkbox" name="selected_ids[]" value="{{ $row->id }}" class="itemRowCheckbox">
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
                                <td>{{setting('currency') }}{{ $row->price }}</td>
                                <td>{{ $row->discount }} %</td>
                                <td>{{setting('currency') }}{{ $row->final_price }}</td>
                                <td>
                                    @if($row->days == 'limited')
                                    {{ $row->no_of_days }}
                                    @else
                                    {{ ucfirst($row->days) }}
                                    @endif
                                </td>
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
                                    <a href="{{ route('item-listing-package.updateStatus', $row->id) }}">
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
        </div>
    </div>
</div>

<!-- Modal for Assigning Package -->
<div class="modal fade" id="assignItemPackageModal" tabindex="-1" aria-labelledby="assignItemPackageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignItemPackageLabel">{{__('lang.assignpackage')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{route('customer.assignitempackage')}}" method="POST" id="itemModalAssignForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_ids[]" id="itemModalUserIds">
                    <input type="hidden" name="selected_ids[]" id="itemModalPackageIds">
                    <div class="mb-3">
                        <label for="description" class="form-label">{{__('lang.description')}}</label>
                        <textarea class="form-control" placeholder="Description" name="description" id="description" rows="3"></textarea>
                    </div>
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