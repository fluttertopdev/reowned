<!DOCTYPE html>
<html>
<head>
    <title>Item Packages List</title>
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

<h2>Item Packages</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Final Price</th>
            <th>Days Type</th>
            <th>No Of Days</th>
            <th>Item Type</th>
            <th>No Of Item</th>
            <th>Status</th>
            <th>Created At</th>
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
            <td>{{ $row->status == 1 ? 'Active' : 'Deactive' }}</td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>