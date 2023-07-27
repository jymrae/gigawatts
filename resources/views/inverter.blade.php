<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Inverters</title>
</head>

<body>
    @include("layouts/navbar-admin")
    @include("layouts/errors")
    <h1>Solar Inverters</h1>
    <a class="btn btn-success" href="/admin/inverter/create">Add new product</a>
    <table class="table">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($inverter as $s)
            <tr>
                <td>{{$s -> brand}}</td>
                <td>{{$s -> description}}</td>
                <td>{{$s -> price}}</td>
                <td>{{$s -> stock}}</td>
                <td>
                <form action="/admin/inverter/restock/{{$s->product_id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="number" name="stock_change" value="0" style="width: 50px" />
                    <input type="submit" class="btn btn-danger" value="Add Stock" />
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>