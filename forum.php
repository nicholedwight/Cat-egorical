<?php include("inc/header.php") ?>
<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>
<body id="forumpage">
<?php
$db = connectToDatabase();
    $catquery = "SELECT * FROM  `categories`";
    $catstatement = $db->prepare($catquery);
    $catstatement->execute();
    $catresult = $catstatement->fetchAll(PDO::FETCH_ASSOC);

    if ($_GET) {
      $catid = $_GET['id'];
      $getquery = "SELECT * FROM (questions JOIN questions_have_categories ON questions.id = questions_have_categories.question_id) JOIN categories ON questions_have_categories.category_id = categories.id WHERE category_id = $catid";
      $statement = $db->prepare($getquery);
      $statement->execute();
      $row_count = $statement->rowCount();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
             $query = "SELECT * FROM `questions`";
             $statement = $db->prepare($query);
             $statement->execute();
             $row_count = $statement->rowCount();
             $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<div class="forum-container">
    <div class="categories">
      <p class="category-list">Categories</p>
        <?php foreach($catresult as $catrow): ?>
      <ul class="category-list">
        <li><a href="forum.php?id=<?php echo $catrow['id']; ?>"><?php echo $catrow['name']; ?></a></li>
      <?php endforeach; ?>
        <li><a href="forum.php">See all</a></li>
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
              <td width = 300px>
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
