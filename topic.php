<?php include("inc/header.php");
$db = connectToDatabase();
if ($_GET) {
    $questionid = $_GET['id'];
    $query = "SELECT * FROM `questions` WHERE `id` = $questionid";
    $answerquery = "SELECT * FROM `answers` WHERE `questionid` = $questionid";

    $_SESSION['topicid'] = $questionid;

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>
    <body id="topic">
    <div class="profile-info">
      <h1>
      <?php echo $result['subject']; ?>
      </h1>
      <p>
      <?php echo $result['question']; ?>
      <h3>Asked by <a href="profile.php?id=<?php echo $result['userid']; ?>"><span class="underline"><?php echo getUsernameFromId($result['userid']); ?></span></a></h3>
      </p>
      <p>
        Asked on <?php echo $result['created_at']; ?>
      </p>
    <?php if (getUsernameFromId($result['userid']) == $_SESSION['username']) { ?>
        <a href="update.php?id=<?php echo $result['id']; ?>" class="small round button">Edit</a>
        <?php } ?>
        <a href="forum.php" class="small round button">Back</a>
        <h3>Answers:</h3>
<?php $answerquery = "SELECT * FROM `answers` WHERE `questionid` = $questionid";

      $answerstatement = $db->prepare($answerquery);
      $answerstatement->execute();
      $answerresult = $answerstatement->fetchAll(PDO::FETCH_ASSOC);
?>
        <div id="answers">
            <?php foreach( $answerresult as $row ): ?>
          <p>
              <?php echo $row['answer'] ; ?>
            Answered by:
            <a href="profile.php?id=<?php echo $row['userid']; ?>">   <?php echo getUsernameFromId($row['userid']); ?></a>
          <?php endforeach; ?>
          </p>
        </div>
        <h3>Answer this question:</h3>
        <form id="answers-form" method="POST" action="answers.php">
          <textarea name="answer" id="answer" rows=6 required></textarea>
          <button type="submit" class="small round button">Submit!</button>
          <input type="hidden" value="<?php echo $questionid; ?>" id="questionid" name="questionid">
        </form>
      </div>


 <?php }
include("inc/footer.php");
?>
