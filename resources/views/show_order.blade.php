<html lang="en">

<head>
    @include('layouts/head')
    <title>Show Order</title>
</head>

<body>

    <div class="container-fluid">
        @include('layouts/navbar')
        <h1>Show Order</h1>
        <p>Order ID: {{$order_info->order_id}} ({{$order_info->time_placed}})</p>
        <p>Status: {{$order_info->status}}</p>
        @if ($order_info->status == 'delivered')
        <form action="/receive_order/{{$order_info->order_id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="submit" class="btn btn-primary" value="Receive order" />
        </form>
        @endif
        @if ($order_info->status == 'waiting')
        <form action="/cancel_order/{{$order_info->order_id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="submit" class="btn btn-danger" value="Cancel order" />
        </form>
        @endif
        <h1>Items Ordered</h1>
        <div class="row">
            <div class="col-lg-6">
                <table class="table">
                    <tr>
                        <th>Item</th>
                        <th>Info</th>
                    </tr>
                    @foreach ($ordered_products as $op)
                    <tr>
                        <td rowspan="4"><img src="/img/food/{{$op->image}}" width="100px" /></td>
                        <td><b>Brand: {{$op->brand}}</b></td>
                    </tr>
                    <tr>
                        <td>Description: {{$op->description}}</td>
                    </tr>
                    <tr>
                        <td>Price: PHP {{$op->price}}</td>
                    </tr>
                    <tr>
                        <td>Quantity: {{$op->quantity}}</td>
                    </tr>
                    <tr>
                        <td>Total price: PHP {{$op->price * $op->quantity}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        <h5>Total: PHP {{$total}}</h5>
    </div>
</body>

</html>