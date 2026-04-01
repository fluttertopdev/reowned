<!DOCTYPE html>
<html>
<head>
    <title>User Packages</title>
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

<h2>User Packages</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Package</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total Limit</th>
            <th>Used Limit</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $index => $row)

            @php
                $packageName = $row->itemPackage->name 
                    ?? $row->adPackage->name 
                    ?? '--';

                $status = 'Expired';
                if (!$row->end_date || now()->lte($row->end_date)) {
                    if ($row->is_active == 1) {
                        $status = 'Active';
                    }
                }
            @endphp

            <tr>
                <td>{{ $index + 1 }}</td>

                <td>{{ $row->user->name ?? '--' }}</td>

                <td>{{ $row->user->email ?? '--' }}</td>

                <td>{{ $packageName }}</td>

                <td>{{ \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') }}</td>

                <td>
                    {{ $row->end_date 
                        ? \Carbon\Carbon::parse($row->end_date)->format('d-m-Y') 
                        : 'Unlimited' 
                    }}
                </td>

                <td>{{ $row->total_limit ?? 'Unlimited' }}</td>

                <td>{{ $row->used_limit }}</td>

                <td>{{ $status }}</td>

                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>