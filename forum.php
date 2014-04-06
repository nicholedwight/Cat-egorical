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
<div class="forum-container">
    <div class="categories">
      <p class="category-list">Categories</p>
      <ul class="category-list">
        <li></li>
      </ul>
    </div>
    <div class="forum">
      <table>
        <thead>
          <tr>
            <td>Topic</td>
            <td>Question</td>
            <td>Asked By</td>
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
              <td width = 400px>
                <?php echo $row['question']; ?>
              </td>
              <td>
                <?php if (isDeletedUser($row['userid'])) {
                  echo getUsernameFromId($row['userid']);
                } else { ?>
                <a href="profile.php?id=<?php echo $row['userid']; ?>">
                  <?php echo getUsernameFromId($row['userid']);
                }?>
                </a>
              </td>
            </tr>
        <?php endforeach;
          ?>
        </tbody>
      </table>
    </div>
</div>

<?php
endif;
include("inc/footer.php")?>
