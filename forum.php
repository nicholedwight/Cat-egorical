<?php include("inc/header.php") ?>
<?php
$db = connectToDatabase();

    $query = "SELECT * FROM `questions`";

    $statement = $db->prepare($query);
    $statement->execute();
    $row_count = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    if ( $row_count > 0) {
      $topic = $result['subject'];
      echo $topic;
      $qbody = $result['question'];
      echo $qbody;
    } else {
      echo "You suck.";
    }

?>






<?php include("inc/footer.php")?>
