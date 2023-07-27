<html lang="en">

<head>
    @include("layouts/head")
    <title>Profile</title>
</head>

<body>
    @include('layouts/navbar')
    @include("layouts/errors")
    <div class="background-color:coral">
    <div style="width: 500px; margin: 0 auto; "> <h1>Profile</h1>
    <p>Welcome, {{$u -> first_name}} {{$u -> last_name}}</p>
    <img src="/img/user_profiles/{{$u -> image}}" width="250px" /><br>
    <form action="/profile/{{$u -> user_id}}/upload_photo" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="file" name="image"></input><br>
        <input type="submit" class="btn btn-success" value="Upload photo" />
    </form>
    <a href="/logout">Logout</a>
    <h2>Basic Info</h2>
    <ul>
        <li>Address: {{$u -> address}}</li>
        <li>ContactNumber: {{$u -> mobile_number}}</li>
        <li>Company: {{$u -> company}}</li>
    </ul>
</div></div>
</body>

</html>