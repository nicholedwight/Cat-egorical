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

?>
