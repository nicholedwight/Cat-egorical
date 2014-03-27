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
    <thead>
      <tr>
        <td>Topic</td>
        <td>Question</td>
        <td>Asker</td>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach( $result as $row ):?>
        <tr>
          <td>
            <?php echo $row['subject']; ?>
          </td>
          <td>
            <?php echo $row['question']; ?>
          </td>
          <td>
            <?php echo getUsernameFromId($row['userid']); ?>
          </td>
        </tr>
    <?php endforeach;
      ?>
    </tbody>
  </table>
</div>

<?php
endif;
include("inc/footer.php")?>
