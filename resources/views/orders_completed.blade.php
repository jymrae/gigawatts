<html lang="en">

<head>
    @include("layouts/head")
    <title>My Finished Orders</title>
</head>

<body>
    @include("layouts/navbar")
    @include("layouts/errors")
    <h1>My Finished Orders</h1>
    <table class="table">
        <tr>
            <th>Order ID</th>
            <th>Time Placed</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>More Info</th>
        </tr>
        @foreach ($orders as $o)
        <tr>
            <td>{{$o->order_id}}</td>
            <td>{{$o->time_placed}}</td>
            <td>{{$o->status}}</td>
            <td>PHP {{$o->total_price}}</td>
            <td><a href="/order/{{$o->order_id}}" class="btn btn-warning">More Info</a></td>
        </tr>
        @endforeach
    </table>
</body>

</html>