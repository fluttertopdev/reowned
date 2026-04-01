<table class="table">
    <thead class="table-light">
        <tr class="text-nowrap">
            <th>#</th>
            <th>{{__('lang.name')}}</th>
            <th>{{__('lang.email')}}</th>
            <th>{{__('lang.packagename')}}</th>
            <th>{{__('lang.startdate')}}</th>
            <th>{{__('lang.enddate')}}</th>
            <th>{{__('lang.totallimit')}}</th>
            <th>{{__('lang.usedlimit')}}</th>
            <th>{{__('lang.status')}}</th>
            <th>{{__('lang.purchase_date')}}</th>
        </tr>
    <tbody>
        @if($result->count() > 0)
        @foreach($result as $index => $row)
            <tr>
                <td>{{ $result->firstItem() + $index }}</td>

                <td>{{ $row->user->name ?? '--' }}</td>

                <td>{{ $row->user->email ?? '--' }}</td>

                <td>
                    {{ $row->itemPackage->name ?? $row->adPackage->name ?? '--' }}
                    <br>
                    <span class="badge bg-warning mt-1">{{ $row->item_package_id!=null ? 'Item Listing' : 'Advertisement' }}</span>
                </td>

                <td>{{ \Helpers::commonDateFormate($row->start_date) }}</td>

                <td>
                    {{ $row->end_date ? \Helpers::commonDateFormate($row->end_date) : 'Unlimited' }}
                </td>

                <td>{{ $row->total_limit ?? 'Unlimited' }}</td>

                <td>{{ $row->used_limit }}</td>

                <td>
                    @php
                        $isExpired = false;

                        if ($row->end_date && \Carbon\Carbon::parse($row->end_date)->lt(now())) {
                            $isExpired = true;
                        }
                    @endphp

                    <span class="badge 
                        {{ (!$isExpired && $row->is_active == 1) ? 'bg-success' : 'bg-danger' }}">
                        
                        {{ (!$isExpired && $row->is_active == 1) ? __('lang.active') : __('lang.expired') }}
                    
                    </span>
                </td>

                <td>{{ \Helpers::commonDateFormate($row->created_at) }}</td>
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