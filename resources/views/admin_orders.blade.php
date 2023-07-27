<html lang="en">

<head>
    @include("layouts/head")
    <title>Ongoing Orders</title>
</head>

<body>
    @include("layouts/navbar-admin")
    @include("layouts/errors")
    <h1>Ongoing Orders</h1>
    <table class="table">
        <tr>
            <th>Status</th>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Time Placed</th>
            <th>Total Price</th>
            <th>View Products</th>
        </tr>
        @foreach ($orders as $o)
        <tr>
            <td>{{$o->status}}</td>
            <td>{{$o->order_id}}</td>
            <td>{{$o->user_id}} <a href="/admin/users/{{$o->user_id}}">(view user info)</a></td>
            <td>{{$o->date_placed}}</td>
            <td>PHP {{$o->total_price}}</td>
            <td><a href="/admin/orders/{{$o->order_id}}" class="btn btn-warning">View Products</a></td>
        </tr>
        @endforeach
    </table>
    <a href="/admin/orders/completed">Show completed orders</a>
</body>

</html>