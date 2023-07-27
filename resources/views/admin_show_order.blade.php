<html lang="en">

<head>
    @include('layouts/head')
    <title>Show Order</title>
    <style>
        .red {
            background-color: red !important;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        @include('layouts/navbar-admin')
        @include('layouts/errors')
        <h1>Show Order</h1>
        <p>Order ID: {{$order_info->order_id}} ({{$order_info->time_placed}})</p>
        <h2>Items Ordered</h2>
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
                        <td class="{{($op->quantity >= $op->stock) ? 'red' : ''}}">Quantity: {{$op->quantity}} (in stock: {{$op->stock}})</td>
                    </tr>
                    <tr>
                        <td>Total price: PHP {{$op->price * $op->quantity}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        <h5>Total: PHP {{$total}}</h5>
        <h2>Update Status</h2>
        <p>Status: {{$order_info->status}}</p>
        @if ($order_info->status == 'waiting')
        <form action="/admin/accept_order/{{$order_info->order_id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="submit" class="btn btn-success" value="Accept order">
        </form>
        @endif
        @if ($order_info->status != 'cancelled' and $order_info->status != 'received')
        @if ($order_info->status != 'waiting')
        <form action="/admin/update_order/{{$order_info->order_id}}" method="POST">
            @csrf
            @method('PUT')
            <select name="new_status">
                <option value="preparing">Preparing</option>
                <option value="waiting for delivery">Waiting for Delivery</option>
                <option value="delivering">Delivering</option>
                <option value="delivered">Delivered</option>
            </select>
            <input type="submit" class="btn btn-primary" value="Update status" />
        </form>
        @endif
        <form action="/admin/cancel_order/{{$order_info->order_id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="submit" class="btn btn-danger" value="Cancel order">
        </form>
        @endif
    </div>
</body>

</html>