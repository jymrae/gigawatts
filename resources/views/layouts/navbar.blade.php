<style>
body {
    overflow-x: hidden;
    font-family: Sans-Serif;
    margin: 0;
}

.menu-container {
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    background: rgba(0, 50, 87);
    color: #cdcdcd;
    padding: 20px;
    z-index: 1;
    -webkit-user-select: none;
    user-select: none;
    box-sizing: border-box;
}

.menu-logo {
    line-height: 0;
    margin: 0 20px;
}

.menu-logo img {
    max-height: 40px;
    max-width: 100px;
    flex-shrink: 0;
}

.menu-container a {
    text-decoration: none;
    color: #232323;
    transition: color 0.3s ease;
}

.menu-container a:hover {
    color: #00C6A7;
}

.menu-container input {
    display: block;
    width: 35px;
    height: 25px;
    margin: 0;
    position: absolute;
    cursor: pointer;
    opacity: 0; /* hide this */
    z-index: 2; /* and place it over the hamburger */
    -webkit-touch-callout: none;
}

.menu-container a img {
    border-radius: 20px;
}

/* Burger menu */
.menu-container span {
    display: block;
    width: 33px;
    height: 4px;
    margin-bottom: 5px;
    position: relative;
    background: #cdcdcd;
    border-radius: 3px;
    z-index: 1;
    transform-origin: 4px 0px;
    transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1),
        background 0.5s cubic-bezier(0.77, 0.2, 0.05, 1), opacity 0.55s ease;
}

.menu-container span:first-child {
    transform-origin: 0% 0%;
}

.menu-container span:nth-child(3) {
    transform-origin: 0% 100%;
}

.menu-container input:checked ~ span {
    opacity: 1;
    transform: rotate(45deg) translate(3px, -1px);
    background: #232323;
}

.menu-container input:checked ~ span:nth-child(4) {
    opacity: 0;
    transform: rotate(0deg) scale(0.2, 0.2);
}

.menu-container input:checked ~ span:nth-child(3) {
    transform: rotate(-45deg) translate(-5px, 11px);
}

.menu ul {
    list-style: none;
}

.menu li {
    padding: 10px 0;
    font-size: 22px;
}

.menu ul a {
    font-size: 1em;
    font-weight: bold;
    font-family: sans-serif;
    text-decoration: none;
    background: rgba(0, 0, 0, 0) ;
    background: rgba(0, 0, 0, 0)
        linear-gradient(
            90deg,
            #90f3b3,
            #90e9f3,
            #909ff3,
            #cc90f3,
            #f390d1,
            #f39a90,
            #f3e590,
            #b8f390
        )
        repeat scroll 0% 0%/200% 200%;
    background-clip: border-box;
    color: transparent;
    -webkit-background-clip: text;
    background-clip: text;
}

.menu ul a:hover {
    -webkit-animation: GradientAnimation 2s ease infinite;
    animation: GradientAnimation 2s ease infinite;
}

@keyframes GradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* mobile styles */
@media only screen and (max-width: 767px) {
    .menu-container {
        flex-direction: column;
        align-items: flex-end;
    }

    .menu-logo {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .menu-logo img {
        max-height: 30px;
    }

    .menu {
        position: absolute;
        box-sizing: border-box;
        width: 300px;
        right: -300px;
        top: 0;
        margin: -20px;
        padding: 75px 50px 50px;
        background: #cdcdcd;
        -webkit-font-smoothing: antialiased;
        /* to stop flickering of text in safari */
        transform-origin: 0% 0%;
        transform: translateX(0%);
        transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1);
    }

    .menu-container input:checked ~ .menu {
        transform: translateX(-100%);
    }
}


    .menu-container a {
        color: #cdcdcd;
    }

    .menu-container input {
        display: none;
    }

 
    .menu {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .menu ul {
        display: flex;
        padding: 0;
    }

    .menu li {
        padding: 0 20px;
    }

</style>
<div class="navbar-div">
        <nav class="menu-container">
            <!-- burger menu -->
            <input type="checkbox" aria-label="Toggle menu" />
            <span></span>
            <span></span>
            <span></span>
            
            <!-- logo -->
            <a href="#" class="menu-logo">
                <img src="img/logo.png"
                    alt="My Awesome Website Logo" />
            </a>

          
            <div class="menu">
                <ul>
                    
                    <li>
                        <a href="/">
                            Home
                        </a>
                    </li>
                    
                  
                    <li>
                        <a href="/about">
                           About
                        </a>
                    </li>
                    
                    <li>
                        <a href="/product">
                            Products
                        </a>
                    </li>
                   
                    <li>
                        <a href="/quote">
                            Get Quote Now!
                        </a>
                    </li>
                    @if (Session::has('user_id'))
                    <li>
                        <a href="/profile">
                           Profile
                        </a>
                    </li>
                    </li>
                   
                    <li>
                        <a href="/order">
                            Orders
                        </a>
                    </li>
                   
                    @endif
                </ul>
                <ul> 
                    @if (Session::has('user_id'))
                    <li> <a href="/store">
                      STORE!</a>
                    </li>
                    @else
                    <li>
                    <a href="/register">
                            Register
                        </a>
                    </li>
                    @endif
                    @if (Session::has('user_id'))
                    <li>
                        <a href="/logout">
                            Logout
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="/login">
                            Login
                        </a>
                    </li>
                    @endif
                
                </ul>
            </div>
        </nav>
    </div>