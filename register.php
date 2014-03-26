<?php include("dbconnect.php") ?>
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
