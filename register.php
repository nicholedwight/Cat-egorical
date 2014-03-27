<?php include("inc/header.php");
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

if($name == '') {
  $errmsg_arr[] = 'You must enter your Name';
  $errflag = true;
}
if($username == '') {
  $errmsg_arr[] = 'You must enter your Username';
  $errflag = true;
}
if($password == '') {
  $errmsg_arr[] = 'You must enter your Password';
  $errflag = true;
}
if($email == '') {
  $errmsg_arr[] = 'You must enter your Email';
  $errflag = true;
}
}

?>


<body id="testpage">

  <div class="reg-form-container vertical-center">
    <form id="registration" method="POST" action="register.php">
        <label for="regname">Name</label>
        <input type="text" name="name" value="" id="regname" placeholder="Your Name" required>

        <label for="regusername">Username</label>
        <input type="text" name="username" value="" id="reusername" placeholder="Username" required>

        <label for="regemail">Email</label>
        <input type="text" name="email" value="" id="regemail" placeholder="Your Email" required>

        <label for="regpassword">Password</label>
        <input type="text" name="password" value="" id="regpassword" placeholder="Password" required>

        <button type="submit" class="small round button">Register</button>
    </form>
  </div>


<?php include("inc/footer.php")
?>
