<!DOCTYPE html>
<html>
<head>
    <title>{{ __('lang.ads_packages_list') }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>{{ __('lang.ads_packages') }}</h2>

<table>
    <thead>
        <tr>
            <th>{{ __('lang.name') }}</th>
            <th>{{ __('lang.price') }}</th>
            <th>{{ __('lang.discount') }}</th>
            <th>{{ __('lang.final_price') }}</th>
            <th>{{ __('lang.days_type') }}</th>
            <th>{{ __('lang.no_of_days') }}</th>
            <th>{{ __('lang.item_type') }}</th>
            <th>{{ __('lang.no_of_item') }}</th>
            <th>{{ __('lang.status') }}</th>
            <th>{{ __('lang.created_at') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($packages as $row)
        <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->price }}</td>
            <td>{{ $row->discount }}</td>
            <td>{{ $row->final_price }}</td>
            <td>{{ ucfirst($row->days) }}</td>
            <td>{{ $row->no_of_days }}</td>
            <td>{{ ucfirst($row->item) }}</td>
            <td>{{ $row->no_of_item }}</td>
            <td>
                {{ $row->status == 1 ? __('lang.active') : __('lang.deactive') }}
            </td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>