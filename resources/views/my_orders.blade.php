<html lang="en">

<head>
    @include('layouts/head')
    <title>My Orders</title>
</head>

<body>
    @include('layouts/navbar')
    <h1>My Orders</h1>
    @if (count($orders) > 0)
    <table class="table">
        <tr>
            <th>Order ID</th>
            <th>Date placed</th>
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
            <td><a class="btn btn-warning" href="/order/{{$o->order_id}}">More info</a>
                @if ($o->status == 'delivered')
                <img src="/img/spoon.jpg" alt="spoon and fork" style="width:30px">
                <span><a href="/order/{{$o->order_id}}">Confirm delivery</a></span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <p>No ongoing orders. <a href="/store">View items</a></p>
    @endif
   
    <button onclick="window.location.href='/order/completed';">completed orders</button>
</body>

</html>