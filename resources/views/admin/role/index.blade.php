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
                            <h5>{{__('lang.rolelist')}}</h5>
                        </div>
                        <div class="col-md-6">
                            @can('role.store')
                            <div class="table-btn-css">
                                <button class="btn btn-secondary btn-primary float-right mt-3" type="button" href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal">
                                    <span>
                                        <i class="ti ti-plus me-md-1"></i>
                                        <span class="d-md-inline-block d-none">{{__('lang.admin_create_role')}}</span>
                                    </span>
                                </button>
                            </div>
                            @endcan
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
                                <th>{{__('lang.admin_role_name')}}</th>
                                <th>{{__('lang.created_at')}}</th>
                                <th>{{__('lang.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @if(count($result) > 0)
                            @foreach($result as $row)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    @if($row->name!='')<a class="cursor-pointer" href="javascript:;" data-bs-toggle="modal" data-bs-target="#editRoleModal_{{$row->id}}" class="role-edit-modal">{{$row->name}}</a>@else -- @endif
                                </td>
                                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
                                @canany(['role.update','role.destroy'])
                                <td>
                                    <div class="inline_action_btn">
                                        @can('role.update')
                                            <a class="edit_icon role-edit-modal" type="button" href="javascript:;" data-bs-toggle="modal" data-bs-target="#editRoleModal_{{$row->id}}" title="{{__('lang.admin_edit')}}"><i class="ti ti-pencil me-1"></i>
                                            </a>
                                        @endcan
                                        @can('role.update')
                                            @if($row->name != 'admin' && $row->name != 'staff')
                                                <a class="delete_icon" href="javascript:void(0);"
                                                    onclick="showDeleteConfirmation('role' , {{ $row->id }})" title="{{__('lang.admin_delete')}}"
                                                    ><i class="ti ti-trash me-1"></i>
                                                </a>
                                            @endif
                                        @endcan
                                    </div>
                                    <div class="modal fade" id="editRoleModal_{{$row->id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered modal-add-new-role">
                                            <div class="modal-content p-3 p-md-5">
                                                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="modal-body">
                                                    <div class="text-center mb-4">
                                                        <h3 class="role-title mb-2">{{__('lang.edit')}}</h3>
                                                        <p class="text-muted">{{__('lang.admin_set_role_permission')}}</p>
                                                    </div>

                                                    <!-- Edit role form -->
                                                    <form class="row g-3" id="edit-record_{{$row->id}}" onsubmit="return validateRole('edit-record_{{$row->id}}');" action="{{route('role.update')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$row->id}}">

                                                        <!-- Role Name -->
                                                        <div class="col-12 mb-4">
                                                            <label class="form-label" for="name">{{__('lang.admin_role_name')}} <span class="required">*</span></label>
                                                            <input type="text" id="name" name="name" class="form-control" placeholder="{{__('lang.admin_role_name_placeholder')}}" value="{{$row->name}}" />

                                                        </div>

                                                        <!-- Role Permissions -->
                                                        <div class="col-12 mb-4">
                                                            <h5>{{__('lang.admin_role_permissions')}}</h5>
                                                            <div class="row mb-3">
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_List" type="checkbox" value="List" data-permission="List" onclick="selectAllSameData('permission-all-checkbox_List','permission-checkbox_List');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_list')}}">{{__('lang.admin_all_list')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_Add" type="checkbox" value="Add" data-permission="Add" onclick="selectAllSameData('permission-all-checkbox_Add','permission-checkbox_Add');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_add')}}">{{__('lang.admin_all_add')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_Update" type="checkbox" value="Update" data-permission="Update" onclick="selectAllSameData('permission-all-checkbox_Update','permission-checkbox_Update');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_update')}}">{{__('lang.admin_all_update')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_Status" type="checkbox" data-permission="Status" onclick="selectAllSameData('permission-all-checkbox_Status','permission-checkbox_Status');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_status_change')}}">{{__('lang.admin_all_status_change')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_Delete" type="checkbox" value="Delete" data-permission="Delete" onclick="selectAllSameData('permission-all-checkbox_Delete','permission-checkbox_Delete');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_delete')}}">{{__('lang.admin_all_delete')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_Translation" type="checkbox" value="Translation" data-permission="Translation" onclick="selectAllSameData('permission-all-checkbox_Translation','permission-checkbox_Translation');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_translation')}}">{{__('lang.admin_all_translation')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_Reply" type="checkbox" value="Reply" data-permission="Reply" onclick="selectAllSameData('permission-all-checkbox_Reply','permission-checkbox_Reply');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_reply')}}">{{__('lang.admin_all_reply')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_Assign_Package"type="checkbox" onclick="selectAllSameData('permission-all-checkbox_Assign_Package','permission-checkbox_Assign_Package');" />


                                                                        <label class="form-check-label" for="{{__('lang.admin_all_Assign Package')}}">{{__('lang.admin_all_assign_package')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-all-checkbox_User_Package"type="checkbox" onclick="selectAllSameData('permission-all-checkbox_User_Package','permission-checkbox_User_Package');" />
                                                                        <label class="form-check-label" for="{{__('lang.admin_all_userPackage')}}">{{__('lang.admin_all_user_package')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Permission table -->
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{__('lang.admin_all_module')}}</th>
                                                                            <th>{{__('lang.admin_all_permissions')}}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($permission as $value)
                                                                        <tr>
                                                                            <td class="fw-semibold">{{$value->permission[0]->module}}</td>
                                                                            <td>
                                                                                <div class="d-flex flex-wrap gap-2">
                                                                                    @foreach($value->permission as $detail)
                                                                                    <div class="form-check me-3">
                                                                                        @php
                                                                                            $className = str_replace(' ', '_', $detail->permission_name);
                                                                                        @endphp

                                                                                        <input class="form-check-input permission-checkbox_{{ $className }}"
                                                                                               type="checkbox"
                                                                                               id="{{ $detail->name }}"
                                                                                               name="permission[]"
                                                                                               value="{{$detail->id}}"
                                                                                               {{ \Helpers::checkRoleHasPermission($row->id, $detail->id) || $detail->is_default ? 'checked' : '' }}
                                                                                               @if($detail->name == 'dashboard') onclick="return false;" @endif
                                                                                        />
                                                                                        <label class="form-check-label" for="{{ $detail->name }}"> {{ $detail->permission_name }} </label>
                                                                                    </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- Permission table -->

                                                        <!-- Submit & Cancel Buttons -->
                                                        <div class="col-12 text-center mt-4">
                                                            <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('lang.save')}}</button>
                                                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">{{__('lang.cancel')}}</button>
                                                        </div>
                                                    </form>
                                                    <!--/ Edit role form -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endcanany
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="record-not-found">
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

    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="role-title mb-2">{{__('lang.admin_add_role')}}</h3>
                        <p class="text-muted">{{__('lang.admin_set_role_permission')}}</p>
                    </div>

                    <!-- Add role form -->
                    <form class="row g-3" id="add-record" onsubmit="return validateRole('add-record');" action="{{route('role.store')}}" method="POST">
                        @csrf
                        <div class="col-12 mb-4">
                            <label class="form-label" for="name"> {{__('lang.admin_role_name')}} <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="{{__('lang.admin_role_name_placeholder')}}" tabindex="-1" required/>
                        </div>

                        <div class="col-12 mb-4">
                            <h5>{{__('lang.admin_role_permissions')}}</h5>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_List" type="checkbox" value="List" data-permission="List" onclick="selectAllSameData('permission-all-checkbox_List','permission-checkbox_List');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_list')}}">{{__('lang.admin_all_list')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_Add" type="checkbox" value="Add" data-permission="Add" onclick="selectAllSameData('permission-all-checkbox_Add','permission-checkbox_Add');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_add')}}">{{__('lang.admin_all_add')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_Update" type="checkbox" value="Update" data-permission="Update" onclick="selectAllSameData('permission-all-checkbox_Update','permission-checkbox_Update');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_update')}}">{{__('lang.admin_all_update')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_Status" type="checkbox" data-permission="Status" onclick="selectAllSameData('permission-all-checkbox_Status','permission-checkbox_Status');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_status_change')}}">{{__('lang.admin_all_status_change')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_Delete" type="checkbox" value="Delete" data-permission="Delete" onclick="selectAllSameData('permission-all-checkbox_Delete','permission-checkbox_Delete');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_delete')}}">{{__('lang.admin_all_delete')}}</label>
                                    </div>
                                </div>                     
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_Translation" type="checkbox" value="Translation" data-permission="Translation" onclick="selectAllSameData('permission-all-checkbox_Translation','permission-checkbox_Translation');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_translation')}}">{{__('lang.admin_all_translation')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_Reply" type="checkbox" value="Reply" data-permission="Reply" onclick="selectAllSameData('permission-all-checkbox_Reply','permission-checkbox_Reply');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_reply')}}">{{__('lang.admin_all_reply')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_Assign_Package"type="checkbox" onclick="selectAllSameData('permission-all-checkbox_Assign_Package','permission-checkbox_Assign_Package');" />


                                        <label class="form-check-label" for="{{__('lang.admin_all_Assign Package')}}">{{__('lang.admin_all_assign_package')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input permission-all-checkbox_User_Package"type="checkbox" onclick="selectAllSameData('permission-all-checkbox_User_Package','permission-checkbox_User_Package');" />
                                        <label class="form-check-label" for="{{__('lang.admin_all_userPackage')}}">{{__('lang.admin_all_user_package')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Permission table -->
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{__('lang.admin_all_module')}}</th>
                                            <th>{{__('lang.admin_all_permissions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permission as $value)
                                            <tr>
                                                <td class="fw-semibold">{{$value->permission[0]->module}}</td>
                                                <td>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach($value->permission as $detail)

                                                        @php
                                                            $className = str_replace(' ', '_', $detail->permission_name);
                                                        @endphp

                                                        <div class="form-check me-3">
                                                            <input class="form-check-input permission-checkbox_{{ $className }}"
                                                                   type="checkbox"
                                                                   id="{{ $detail->name }}"
                                                                   name="permission[]"
                                                                   value="{{$detail->id}}"
                                                                   {{ $detail->is_default || $detail->permission_name == 'dashboard' ? 'checked' : '' }}

                                                                   data-permission="{{ $className }}"

                                                                   @if($detail->name == 'dashboard')
                                                                   onclick="return false;"
                                                                   @endif
                                                            />

                                                            <label class="form-check-label" for="{{ $detail->name }}">
                                                                {{ $detail->permission_name }}
                                                            </label>
                                                        </div>

                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Permission table -->

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">{{__('lang.save')}}</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                {{__('lang.cancel')}}
                            </button>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content wrapper -->

@endsection