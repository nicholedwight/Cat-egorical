<?php include("inc/header.php");
$db = connectToDatabase();
if ($_GET) {
    $questionid = $_GET['id'];
    $query = "SELECT * FROM `questions` WHERE `id` = $questionid";
    $answerquery = "SELECT * FROM `answers` WHERE `questionid` = $questionid";

    $_SESSION['topicId'] = $questionid;

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>
    <body id="topic">
      <p class="breadcrumb"><a href="forum.php">Forum</a> &gt; <?php echo "Category"; ?></p>
    <div class="topic-wrapper">
    <div class="topic-category">
      <h3>Category:</h3>
      <?php
      $categoryquery = "SELECT DISTINCT name, category_id FROM (questions JOIN questions_have_categories ON questions.id = questions_have_categories.question_id) JOIN categories ON questions_have_categories.category_id = categories.id WHERE `question_id` = $questionid";
      $catstatement = $db->prepare($categoryquery);
      $catstatement->execute();
      $catresult = $catstatement->fetchAll(PDO::FETCH_ASSOC);

      if (empty($catresult)) {
        echo "No categories";
      } else foreach($catresult as $catname) {
          echo "<p>" . $catname['name'] . "</p>";
      }
      ?>
    </div>
    <div class="profile-info">
      <div id="button-wrapper">
          <h1>
          <?php echo $result['subject']; ?>
          </h1>
          <div id="topic-buttons">
            <?php if (getUsernameFromId($result['userid']) == $_SESSION['username']) { ?>
                <a href="update.php?id=<?php echo $result['id']; ?>" class="small round button">Edit</a>
                <?php } ?>
            </div>
      </div>
      <p>
      <?php echo $result['question']; ?>
      <h3>Asked by <a href="profile.php?id=<?php echo $result['userid']; ?>"><span class="underline"><?php echo getUsernameFromId($result['userid']); ?></span></a></h3>
        Asked on <?php echo $result['created_at']; ?>
      </p>

        <h3>Answers:</h3>
<?php $answerquery = "SELECT * FROM `answers` WHERE `questionid` = $questionid";

      $answerstatement = $db->prepare($answerquery);
      $answerstatement->execute();
      $answerresult = $answerstatement->fetchAll(PDO::FETCH_ASSOC);
?>
        <div id="answers">
            <?php if (empty($answerresult)) {
              echo "No one has answered this question yet!";
            } else foreach( $answerresult as $row ): ?>
          <p>
          </p>
          <p>Answered by:
            <a href="profile.php?id=<?php echo $row['userid']; ?>">   <?php echo getUsernameFromId($row['userid']); ?></a>
            on <?php echo $row['created_at'];
          endforeach; ?>
          </p>
        </div>
        <h3>Answer this question:</h3>
        <form id="answers-form" method="POST" action="answers.php">
          <textarea name="answer" id="answer" rows=6 required></textarea>
          <button type="submit" class="small round button">Submit!</button>
          <input type="hidden" value="<?php echo $questionid; ?>" id="questionid" name="questionid">
        </form>
      </div>
    </div>
  </div>


 <?php }
include("inc/footer.php");
?>
