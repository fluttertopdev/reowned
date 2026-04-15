<!DOCTYPE html>
<html>
<head>
    <title>{{ __('lang.user_packages') }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background: #f2f2f2;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>{{ __('lang.user_packages') }}</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('lang.user_name') }}</th>
            <th>{{ __('lang.user_email') }}</th>
            <th>{{ __('lang.package') }}</th>
            <th>{{ __('lang.start_date') }}</th>
            <th>{{ __('lang.end_date') }}</th>
            <th>{{ __('lang.total_limit') }}</th>
            <th>{{ __('lang.used_limit') }}</th>
            <th>{{ __('lang.status') }}</th>
            <th>{{ __('lang.created_at') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $index => $row)

            @php
                $packageName = $row->itemPackage->name 
                    ?? $row->adPackage->name 
                    ?? '--';

                $status = __('lang.expired');

                if (!$row->end_date || now()->lte($row->end_date)) {
                    if ($row->is_active == 1) {
                        $status = __('lang.active');
                    }
                }
            @endphp

            <tr>
                <td>{{ $index + 1 }}</td>

                <td>{{ $row->user->name ?? '--' }}</td>

                <td>{{ $row->user->email ?? '--' }}</td>

                <td>{{ $packageName }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') }}
                </td>

                <td>
                    {{ $row->end_date 
                        ? \Carbon\Carbon::parse($row->end_date)->format('d-m-Y') 
                        : __('lang.unlimited') 
                    }}
                </td>

                <td>{{ $row->total_limit ?? __('lang.unlimited') }}</td>

                <td>{{ $row->used_limit }}</td>

                <td>{{ $status }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>