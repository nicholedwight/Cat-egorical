<?php include("inc/header.php");

$db = connectToDatabase();
if ($_POST) {
  $answer = $_POST['answer'];
  $userid = $_SESSION['userid'];
  $questionid = $_POST['questionid'];
  $query = "INSERT INTO `answers` (`answer`, `userid`, `created_at`, `questionid`)
                        VALUES (     :answer,
                                '" . $userid . "',
                                '" . date('Y-m-d', time()) . "',
                                '" . $questionid . "')";
      $statement = $db->prepare($query);
      $statement->execute(array(":answer" => $answer));

      if ($statement->errorCode() == 0) {
        header("Location: topic.php?id=" . $_SESSION['topicId']);
      } else {
        $errors = $statement->errorInfo();
        echo($errors[2]);
      }
}



include("inc/footer.php");
?>
