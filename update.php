<?php include("inc/header.php");

$db = connectToDatabase();
if ($_POST) {
    $subject = $_POST['subject'];
    $question = $_POST['question'];
    $id = $_GET['id'];
    $query = "UPDATE `questions` SET `subject` = :subject, `question` = :question WHERE `id` = '" . $id . "'";

  $statement = $db->prepare($query);
  $statement->execute(array(":subject" => $subject, ":question" => $question));

  echo "<div class='response'>";
  if ($statement->errorCode() == 0) {
    echo "Thanks! Your questions was recieved successfully!";
  } else {
    $errors = $statement->errorInfo();
    echo($errors[2]);
  }
  echo "</div>";
}


if ($_GET) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `questions` WHERE `id` = $id";

    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>
<body id="updatepage">
  <div class="reg-form-container vertical-center">
    <h1>Update your question</h1>
    <form id="questions" method="POST">
      <label for="subject" required>Subject</label>
      <input type="text" name="subject" value="<?php echo $result['subject']; ?>" id="subject">

      <label for="question" required>Question</label>
      <textarea name="question" id="question" rows="6" ><?php echo $result['question']; ?></textarea>

      <button type="submit" class="small round button">Update!</button>
    </form>
  </div>
</body>
<?php
  if (getUsernameFromId($result['userid']) != $_SESSION['username']) {
    header('Location: forum.php');
  }
}
include("inc/footer.php");
?>
