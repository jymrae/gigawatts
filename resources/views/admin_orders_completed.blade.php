<html lang="en">

<head>
    @include("layouts/head")
    <title>Completed Orders</title>
</head>

<body>
    @include("layouts/navbar-admin")
    @include("layouts/errors")
    <h1>Completed Orders</h1>
    @if (count($orders) > 0)
    <table class="table">
        <tr>
            <th>Status</th>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Date Placed</th>
            <th>Total Price</th>
            <th>View Products</th>
        </tr>
        @foreach ($orders as $o)
        <tr>
            <td>{{$o->status}}</td>
            <td>{{$o->order_id}}</td>
            <td>{{$o->user_id}} <a href="/admin/users/{{$o->user_id}}">(view user info)</a></td>
            <td>{{$o->time_placed}}</td>
            <td>PHP {{$o->total_price}}</td>
            <td><a href="/admin/orders/{{$o->order_id}}" class="btn btn-warning">View Products</a></td>
        </tr>
        @endforeach
    </table>
    @else
    <p>No completed orders!</p>
    @endif
</body>

</html>