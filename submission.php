<?php include("inc/header.php") ?>
<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:

?>

<?php
$db = connectToDatabase();
if ($_POST) {
    $subject = $_POST['subject'];
    $question = $_POST['question'];
    $userid = $_SESSION['userid'];
    $query = "INSERT INTO `questions` (`subject`, `question`, `created_at`, `userid`)
              VALUES ('" . $subject . "',
                      '" . $question . "',
                      '" . date('Y-m-d', time()) . "',
                      '" . $userid . "')";
  $statement = $db->prepare($query);
  $statement->execute();

  $questionid = $db->lastInsertId();
  $catquery = "INSERT INTO `questions_have_categories` (`category_id`, `question_id`)
               VALUES";
  $i = 0;
  $length = count($catquery);
  foreach($_POST['category'] as $catid){
    if ($length == 0) {
                      $catquery .= "('" . $catid . "',
                                   '" . $questionid . "'),";
        } else if ($i == $length - 1) {
          $catquery .= "('" . $catid . "',
                       '" . $questionid . "')";
        } $i++;
    }
  $catstatement = $db->prepare($catquery);
  $catstatement->execute();

  if ($catstatement->errorCode() == 0) {
    echo "Yay!";
  } else {
    $errors = $catstatement->errorInfo();
    echo($errors[2]);
  }
}

  $getcatquery = "SELECT * FROM `categories`";

  $getcatstatement = $db->prepare($getcatquery);
  $getcatstatement->execute();
  $getcatresult = $getcatstatement->fetchAll(PDO::FETCH_ASSOC);
?>

<body id="subpage">

<div class="reg-form-container vertical-center">
  <form id="questions" method="POST">
    <label for="subject" required>Subject</label>
    <input type="text" name="subject" value="" id="subject" placeholder="Subject" required>

    <p>Category (Select all that apply)</p>
    <?php foreach ($getcatresult as $category): ?>
    <div class="catboxes">
      <label for="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></label>
      <input type="checkbox" name="category[]" value="<?php echo $category['id']; ?>">
    </div>
  <?php endforeach; ?>

    <label for="question" required>Question</label>
    <textarea name="question" id="question" rows="6" placeholder="Enter your Cat-y questions here!" required></textarea>

    <button type="submit" class="small round button">Submit!</button>
  </form>

  <p>Want to see what others are talking about? Head over to the <a href="forum.php">Forum</a> now!</p>
</div>

<?php
endif;
include("inc/footer.php") ?>
