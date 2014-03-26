<?php include('inc/header.php') ?>
<body id="homepage">



<form id="loginform" method="POST" action="login.php">
    <label for="userlog" required>Login</label>
    <input type="text" name="login-info" value="" id="userlog" placeholder="Enter your username or email">

    <label for="password" required>Password</label>
    <input type="text" name="password" value="" id="password" placeholder="Password">

    <button type="submit" class="small round button">Login</button>
</form>


<form id="registration" method="POST" action="register.php">
    <label for="regname" required>Name*</label>
    <input type="text" name="name" value="" id="regname" placeholder="Your Name">

    <label for="regusername">Username</label>
    <input type="text" name="username" value="" id="reusername" placeholder="Username">

    <label for="regemail" required>Email*</label>
    <input type="text" name="email" value="" id="regemail" placeholder="Your Email">

    <label for="regpassword" required>Password*</label>
    <input type="text" name="password" value="" id="regpassword" placeholder="Password">

    <button type="submit" class="small round button">Register</button>

</form>




</body>
</html>
