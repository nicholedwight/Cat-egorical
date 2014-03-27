<?php
function connectToDatabase() {
  if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $db = new PDO('mysql:host=localhost;dbname=cat-egorical;charset=utf8', 'root', 'root');
  }
  else {
    $db = new PDO('msql:host=mysql5.cems.uwe.ac.uk;dbname=cat-egorical;charset=utf8', 'fet13000673', '8LYn8K');
  }
  if ($db->errorCode() != 0) {
    die('Unable to connect to database');
  }
  else return $db;
}


function isLoggedIn() {
  if ($_SESSION['email']) {
    return $_SESSION['email'];
  } else {
    return false;
  }
}

function getUsernameFromId($id) {
  $db = connectToDatabase();
  $username = "SELECT `username` FROM `users` WHERE `id` = $id";
  $statement = $db->prepare($username);
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  return $result['username'];
}

function getUserId($email) {
  $db = connectToDatabase();
  $query = "SELECT `id` FROM `users` WHERE `email` = '" . $email . "'";
  $statement = $db->prepare($query);
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  return $result['id'];
}

?>
