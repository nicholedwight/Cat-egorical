<?php include("inc/header.php");
?>
<?php
$db = connectToDatabase();
if ($_POST) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO `users` (`name`, `username`, `email`, `password`, `created_at`)
              VALUES ('" . $name . "',
                      '" . $username . "',
                      '" . $email . "',
                      '" . $password . "',
                      '" . date('Y-m-d', time()) . "')";
  $statement = $db->prepare($query);
  $statement->execute(); ?>
  <div class="response">
  <?php  if ($statement->errorCode() == 0) {
    echo "Thanks! Your registration was successful!";
    } else {
    $errors = $statement->errorInfo();
    echo "Sorry! That email is already in use!";
  } ?>
  </div>
  <?php
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
        <input type="password" name="password" value="" id="regpassword" placeholder="Password" required>

        <button type="submit" class="small round button">Register</button>
    </form>
  </div>


<?php include("inc/footer.php")
?>
