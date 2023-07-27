<html lang="en">

<head>
    @include('layouts/head')
    <title>Solar Accesories</title>
    <script>
        $(document).ready(function() {
            $(".deduct_button").click(function() {
                $pid = $(this).attr('id');
                $new_val = Number($("input.order_" + $pid).val()) - 1;
                if ($new_val >= 0) {
                    $("input.order_" + $pid).val($new_val);
                }
            });

            $(".add_button").click(function() {
                $pid = $(this).attr('id');
                $new_val = Number($("input.order_" + $pid).val()) + 1;
                if ($new_val < 99) {
                    $("input.order_" + $pid).val($new_val);
                }
            });
        });
    </script>
</head>

<body>
    @include('layouts/navbar-store')
    <div >
    <h1>Solar Accessories</h1>
    <div class="container">
        <form action="/store" method="POST">
            @csrf
            <div class="row">
                @foreach ($acce as $a)
                <div class="col-lg-3">
                    <div class="card">
                        <img src="img/food/{{$a->image}}" class="card-img-top" alt="{{$a->name}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$a->brand}} - PHP<span>{{$a->price}}</span></h5>
                            <h5 class="card-title"> {{$a->description}}</h5>
                            <a class="btn btn-danger deduct_button" id="{{$a->product_id}}">-</a>
                            <input type="number" style="width: 50px" min="0" max="99" class="order_{{$a->product_id}}" name="order_{{$a->product_id}}" value="0">
                            <a class="btn btn-primary add_button" id="{{$a->product_id}}">+</a>
                        </div>
                    </div>
                </div>
                @endforeach
                {{$acce -> links('pagination::bootstrap-5')}}
            </div>
            <input type="submit" class="btn btn-success mt-3">
        </form>
    </div>
  
    </div>
</body>
@include('layouts/footer')
</html>
