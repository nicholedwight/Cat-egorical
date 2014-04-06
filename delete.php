<?php
use forxer\Gravatar\Gravatar;
include("inc/header.php");
if (getUsernameFromId($result['userid']) != $_SESSION['username']):
  die(header("Location: forum.php"));
else:

?>
<body id="profile">
<?php
if ($_GET):
    $db = connectToDatabase();
    $user = $_GET['id'];
    $query = "DELETE FROM `users` WHERE `id` = $user";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    ?>

<div class="response">
<?php  if ($statement->errorCode() == 0) {
  session_destroy();
  header("Location: login.php");
  } else {
  $errors = $statement->errorInfo();
  echo "Sorry, something messed up! Try again!";
} ?>
</div>



<?php
endif;
endif;
include("inc/footer.php") ?>
