<!doctype html>
<html lang="en-US">

<head>
   <style>
             .loginbox {
            width: 350px;
            height: 420px;
            background: rgb(0, 50, 87);
            color: white;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            padding: 70px 30px
        }
        
        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 25%;
            position: absolute;
            top: -75px;
            left: 29%
        }
        
        h1 {
            margin: 0;
            padding: 0 0 20 px;
            text-align: center;
            font-size: 22px;
        }
        
        .loginbox p {
            margin: 0;
            padding: 0;
            font-weight: bold;
        }
        
        .loginbox input {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .loginbox input[type="text"],
        input[type="password"] {
            border: none;
            border-bottom: 1px solid white;
            background: transparent;
            outline: none;
            height: 40px;
            color: white;
            font-size: 18px;
        }
        
        .loginbox input[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            background: red;
            color: white;
            font-size: 18px;
            border-radius: 20px;
        }
        
        .loginbox input[type="submit"]:hover {
            cursor: pointer;
            background: #ffc107;
            color: #000;
        }
        
        .loginbox a {
            text-decoration: none;
            font-size: 12px;
            line-height: 20px;
            color: darkgrey;
        }
        
        .loginbox a:hover {
            color: #ffc107;
        }
    </style>
    <body>
        
    @include('layouts/navbar')
   <form action="/login" method="POST">
       
        <div class="loginbox">
            <img src="/img/loginavatar.png" class="avatar">
            @include("layouts/errors")
            <h1>Login Here</h1>
            @csrf
                <label>Email address: </label>
                 <input type="email" name="email"></input><br>
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password" required>
                <input type="submit" value="Login"><br>
                <a href="#">Forget your Password?</a><br>
                <a href="/register">Don't have account?</a>   
       
    </form>
                             
                                
                                
                                
                            </div>
                            <div class="post-tags">
                            </div>
                        </div>

                    </main>

                   

                   
                   
                   
                
</body>

</html>
