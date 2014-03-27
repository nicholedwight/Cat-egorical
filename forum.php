<?php include("inc/header.php") ?>
<?php
$db = connectToDatabase();

    $query = "SELECT * FROM `questions`";

    $statement = $db->prepare($query);
    $statement->execute();
    $row_count = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    foreach( $statement as $row ) {
      var_dump($row);
      echo "<table><thead><tr><th width='400'>" . $row['subject'] . "</th></tr></thead>";
      echo "<tbody><tr><td>" . $row['question'] . "</td></tr></tbody></table>";
    }

?>






<?php include("inc/footer.php")?>
