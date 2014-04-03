<?php
use forxer\Gravatar\Gravatar;
include("inc/header.php"); ?>
<body id="profile">
<?php
if ($_GET):
    $db = connectToDatabase();
    $user = $_GET['id'];
    $query = "DELETE FROM `users` WHERE `id` = $user";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>

<div class="response">
<?php  if ($statement->errorCode() == 0) {
  echo "Your account has successfully been deleted!";
  } else {
  $errors = $statement->errorInfo();
  echo "Sorry, something messed up! Try again!";
} ?>
</div>



<?php
endif;
include("inc/footer.php") ?>
