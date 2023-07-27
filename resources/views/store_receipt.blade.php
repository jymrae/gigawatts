<html lang="en">

<head>
    @include('layouts/head')
    <title>Check Order</title>
</head>

<body>
    @include('layouts/navbar')
    <h1>Check Order</h1>
    <form action="/store/checkout" method="POST">
        @csrf
        <ul>
            @for ($i = 0; $i < count($p); $i++) @if ($sp[$i]> 0)
                <img src="img/food/{{$p[$i]->image}}" width="50px">
                <li>{{$p[$i]->name}}: {{$sp[$i]}} (PHP{{$p[$i]->price * $sp[$i]}})</li>
                @endif
                <input type="text" name="order_{{$p[$i]->product_id}}" value="{{$sp[$i]}}" hidden />
                @endfor
        </ul>
        <h5>Total order is PHP{{$total}}</h5>
        <input type="submit" class="btn btn-success" value="Place Order">
    </form>
</body>

</html>