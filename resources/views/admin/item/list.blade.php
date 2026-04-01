@extends('admin.layout.app')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.item.partial.item_table')
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->

@endsection