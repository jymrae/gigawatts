<html lang="en">

<head>
    @include("layouts/head")
    <title>Products</title>
</head>

<body>
    @include("layouts/navbar-admin")
    @include("layouts/errors")
    <h1>Products</h1>
    <a class="btn btn-success" href="/admin/products/create">Add new product</a>
    <table class="table">
        <tr>
            <th>Product ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Restock</th>
        </tr>
        @foreach ($products as $p)
        <tr>
            <td>{{$p->product_id}}</td>
            <td><img src="/img/food/{{$p->image}}" style="width: 40px" /></td>
            <td>{{$p->name}}</td>
            <td>PHP {{$p->price}}</td>
            <td>{{$p->stock}}</td>
            <td>
                <form action="/admin/products/restock/{{$p->product_id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="number" name="stock_change" value="0" style="width: 50px" />
                    <input type="submit" class="btn btn-warning" value="Restock" />
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>