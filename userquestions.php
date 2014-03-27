<?php include("inc/header.php");
if ($_GET):
    $db = connectToDatabase();
    $userid = $_GET['id'];
    $query = "SELECT * FROM `questions` WHERE `userid` = $userid";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC); ?>

    <div class="forum">
      <table>
        <thead>
          <tr>
            <td>Topic</td>
            <td>Question</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach( $result as $row ):?>
            <tr>
              <td>
                <a href="topic.php?id=<?php echo $row['id']; ?>">
                <?php echo $row['subject']; ?>
                </a>
              </td>
              <td>
                <?php echo $row['question']; ?>
              </td>
            </tr>
        <?php endforeach;
        ?>
        </tbody>
      </table>
    </div>
<?php endif;



include("inc/footer.php");
?>
