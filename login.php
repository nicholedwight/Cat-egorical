<?php include("dbconnect.php") ?>
<?php
$db = connectToDatabase();
if ($_POST) {
    //die(var_dump($_POST));
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $password ."'";

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    if ($result) {
      header("Location: test.html");
    } else {
      echo "Boo!";
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
