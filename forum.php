<?php include("inc/header.php") ?>
<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>
<body id="forumpage">
<?php
$db = connectToDatabase();

    $query = "SELECT * FROM `questions`";

    $statement = $db->prepare($query);
    $statement->execute();
    $row_count = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="forum">
  <table>
<?php
    foreach( $result as $row ) {
      echo "<thead><tr><th width='400'>" . $row['subject'] . "</th></tr></thead>";
      echo "<tbody><tr><td>" . $row['question'] . "</td></tr>";
      echo "<tr><td>" . $row['answer'] . "</td></tr></tbody>";
    }

?>
  </table>
</div>





<?php
endif;
include("inc/footer.php")?>
