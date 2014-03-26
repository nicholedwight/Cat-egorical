<?php include("inc/library.php");
      include("inc/header.php");
?>
<?php
$db = connectToDatabase();
if ($_POST) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "INSERT INTO `users` (`name`, `username`, `email`, `password`, `created_at`)
              VALUES ('" . $name . "',
                      '" . $username . "',
                      '" . $email . "',
                      '" . $password . "',
                      '" . date('Y-m-d', time()) . "')";
  $statement = $db->prepare($query);
  $statement->execute();

  if ($statement->errorCode() == 0) {
    echo "Thanks! Your registration was successful!";
  } else {
    $errors = $statement->errorInfo();
    echo($errors[2]);
  }
}

?>


<body id="testpage">

  <div class="reg-form-container vertical-center">
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
        <a href="login.php" class="small round button">Login</a>
    </form>
  </div>

</body>
</html>
