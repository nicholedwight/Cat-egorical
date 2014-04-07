<?php
include("inc/header.php");
?>
<?php
$db = connectToDatabase();

if ($_POST) {
    //die(var_dump($_POST));
    $email = $_POST['email'];
    $query = "SELECT * FROM `users` WHERE `email` = '" . $email . "'";

    $statement = $db->prepare($query);
    $statement->execute();
    $row_count = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);


    if ( $row_count > 0) {
      if (password_verify($_POST['password'], $result['password'])) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['userid'] = $result['id'];
        header('Location: index.php');
      } else {
        $error = "Your login details are incorrect.";
    }
  }
}

  if (isset($_SESSION['email'])) {
    header('Location: index.php');
  }

/*if($user == '') {
	$errmsg_arr[] = 'You must enter your Username';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'You must enter your Password';
	$errflag = true;
}
*/
?>
<body id="loginpage">
  <div class="login-form-container vertical-center">
    <form id="loginform" method="POST" action="login.php">
        <?php
        if (isset($error)) {
          echo $error;
        }
        ?>
        <label for="email" required>Login</label>
        <input type="text" name="email" value="" id="email" placeholder="Enter your email">

        <label for="password" required>Password</label>
        <input type="password" name="password" value="" id="password" placeholder="Password">

        <button type="submit" class="small round button">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register one</a>!</p>
  </div>


<?php include("inc/footer.php")
?>
