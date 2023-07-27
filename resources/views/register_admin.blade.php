<html lang="en">

<head>
    @include("layouts/head")
    <title>Admin Register</title>
</head>

<body>
    @include("layouts/navbar-admin")
    @include("layouts/errors")
    <h1>Admin Register</h1>
    <form action="/admin/register/newadmin" method="POST">
        @csrf
        <label>First name: </label>
        <input type="text" name="first_name"></input><br>
        <label>Last name: </label>
        <input type="text" name="last_name"></input><br>
        <label>Email address: </label>
        <input type="email" name="email"></input><br>
      
        <label>Password: </label>
        <input type="password" name="password"></input><br>
        <input type="submit">
    </form>
</body>

</html>