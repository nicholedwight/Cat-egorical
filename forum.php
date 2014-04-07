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
      $catid = $_GET['cat_id'];
      $getquery = "SELECT questions.id AS question_id, questions.subject, questions.question, questions.created_at, questions.userid, categories.* FROM (questions JOIN questions_have_categories ON questions.id = questions_have_categories.question_id) JOIN categories ON questions_have_categories.category_id = categories.id WHERE category_id = $catid";
      $statement = $db->prepare($getquery);
      $statement->execute();
      $row_count = $statement->rowCount();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
             $query = "SELECT questions.id AS question_id, questions.subject, questions.question, questions.created_at, questions.userid FROM `questions`";
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
        <li><a href="forum.php?cat_id=<?php echo $catrow['id']; ?>"><?php echo $catrow['name']; ?></a></li>
      <?php endforeach; ?>
        <li><a href="forum.php">See all</a></li>
      </ul>
    </div>
    <div class="forum-wrapper">
          <?php
          if ($result){

          foreach( $result as $row ):?>
          <div class="question">
            <h2><a href="topic.php?id=<?php echo $row['question_id']; ?>">
                <?php echo $row['subject']; ?></a></h2>
              <p>
                <?php echo $row['question']; ?>
              </p>
              <p>Asked by:
                <?php if (isDeletedUser($row['userid'])) {
                  echo getUsernameFromId($row['userid']);
                } else { ?>
                <a href="profile.php?id=<?php echo $row['userid']; ?>">
                  <?php echo getUsernameFromId($row['userid']);
                }?>
              </a> on <?php echo $row['created_at']; ?>
              </p>
          </div>
        <?php endforeach;
      } else echo "<div class='response'>Sorry, no questions are in this category yet. :(</div>"; ?>
    </div>
</div>

<?php
endif;
include("inc/footer.php")?>
