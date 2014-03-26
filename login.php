<?php
include("inc/library.php");
include("inc/header.php");
?>
<?php
$db = connectToDatabase();

if ($_POST) {
    //die(var_dump($_POST));
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $password ."'";

    $statement = $db->prepare($query);
    $statement->execute();
    $row_count = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ( $row_count > 0) {
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['username'] = $result['username'];
      header('Location: test.html');
    }
    else {
      header('Location: index.html');
    }

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
<body id="homepage">
  <div class="login-form-container vertical-center">
    <form id="loginform" method="POST" action="login.php">
        <label for="email" required>Login</label>
        <input type="text" name="email" value="" id="email" placeholder="Enter your username or email">

        <label for="password" required>Password</label>
        <input type="text" name="password" value="" id="password" placeholder="Password">

        <button type="submit" class="small round button">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register one</a>!</p>
  </div>

</body>
</html>
