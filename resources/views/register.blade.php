
<!doctype html>
<html lang="en-US">

<head>
   <style>
             .loginbox {
            width: 350px;
            height: 695px;
            background: rgb(0, 50, 87);
            color: white;
            top: 60%;
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
    
   <form action="/admin/register" method="POST">
       
        <div class="loginbox">
           
            @include("layouts/errors")
            <h1>Register Here</h1>
            @csrf
            <label>First name: </label>
        <input type="text" name="first_name"></input><br>
        <label>Last name: </label>
        <input type="text" name="last_name"></input><br>
        <label>Email: </label>
        <input type="email" name="email"></input><br>
        <label>Address: </label>
        <input type="text" name="address" value=""><br>
        <label>Mobile Number: </label>
        <input type="number" name="mobile_number" value=""><br>
        <label>Company: </label>
        <input type="text" name="company"></input><br>
        <label>Password : </label>
        <input type="password" name="password"></input><br>
        <label>Repeat Password: </label>
        <input type="password" name="password2"></input><br>
        <input type="submit">
       
    </form>
                             
                                
                                
                                
                            </div>
                            <div class="post-tags">
                            </div>
                        </div>

                    </main>

                   

                   
                   
                   
                
