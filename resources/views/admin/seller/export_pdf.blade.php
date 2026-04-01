<!DOCTYPE html>
<html>
<head>
    <title>Sellers List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Sellers List</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sellers as $seller)
            <tr>
                <td>{{ $seller->name }}</td>
                <td>{{ $seller->email }}</td>
                <td>{{ $seller->phone }}</td>
                <td>{{ $seller->status }}</td>
                <td>{{ $seller->address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>