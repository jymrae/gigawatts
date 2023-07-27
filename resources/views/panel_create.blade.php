<html lang="en">

<head>
    @include("layouts/head")
    <title>New Panel</title>
</head>

<body>
    @include("layouts/navbar-admin")
    @include("layouts/errors")
    <div style="width: 500px; margin: 0 auto; "><form action="/admin/panel" method="POST" enctype="multipart/form-data">
    <h1 style="margin-right: 100px;">New Panel</h1>
    
        @csrf
        <label>Brand: </label>
        <input  style="width: auto; margin-top: 10px" type="text" name="brand"></input><br>
        <label>Description: </label>
        <input style="width: auto;margin-top: 10px" type="text" name="description"></input><br>
        <label>price: </label>
        <input style="width: auto;margin-top: 10px" type="number" name="price"></input><br>
        <label>Stock: </label>
        <input style="width: auto;margin-top: 30px" type="number" name="stock"></input><br>
        <label style="width: auto;margin-top: 30px">Upload photo: </label>
        <input style="width: auto;margin-top: 20px" type="file" name="image"></input><br>
        <input style="width: auto;margin-top: 20px" type="submit" class="btn btn-success">
    </form></div>
</body>

</html>P