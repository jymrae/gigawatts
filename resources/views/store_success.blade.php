<html lang="en">

<head>
    @include('layouts/head')
    <title>Order Success</title>
</head>

<body>
    @include('layouts/navbar')
    <h1>Order Success!</h1>
    <p>Order ID: 0000000 {{$order->order_id}}</p>
  
    <button onclick="window.location.href='/order';">My Orders</button>
</body>
</html>