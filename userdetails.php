<?php include("inc/header.php");
$db = connectToDatabase();
if ($_POST) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['bio'])) {
      $bio = $_POST['bio'];
    }
    if (isset($_POST['country'])) {
      $country = $_POST['country'];
    }
    $id = $_GET['id'];
    $query = "UPDATE `users`
    SET  `name` = :name" .
    ", `username` = '"   . $_POST['username'] .
    "', `email` = '"      . $_POST['email'] . "'";
    if (isset($bio)) {
      $query .= ", `bio` =  :bio";
    }
    if (isset($country)) {
      $query .= ", `country` = '" . $country ."'";
    }
    if ($password) {
      $query .= ", `password` = '" . $_POST['name'] . "'";
    }
      $query .= " WHERE `id` = '"    . $id . "'";

  $statement = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $statement->execute(array(':name' => $_POST['name'], ':bio' => $_POST['bio'])); ?>
  <div class="user-response">
    <?php if ($statement->errorCode() == 0) {
      echo "Details have been saved!";
    } else {
      $errors = $statement->errorInfo();
      echo($errors[2]);
    } ?>
  </div>
<?php }


if ($_GET):
    $user = $_GET['id'];
    $query = "SELECT * FROM `users` WHERE `id` = $user";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>


<body id="userpage">
  <div class="user-form-container vertical-center">
    <h1>Update your information</h1>
    <form id="userinfo" method="POST">
      <label for="regname">Name</label>
      <input type="text" name="name" value="<?php echo $result['name']; ?>" id="regname" placeholder="Your Name" required>

      <label for="regusername">Username</label>
      <input type="text" name="username" value="<?php echo $result['username']; ?>" id="reusername" placeholder="Username" required>

      <label for="regemail">Email</label>
      <input type="text" name="email" value="<?php echo $result['email']; ?>" id="regemail" placeholder="Your Email" required>

      <label for="bio">About You</label>
      <textarea name="bio" id="bio" rows="6" wrap="hard" placeholder="Tell us a bit about yourself!"><?php if ($result['bio']) {
                      echo $result['bio']; } ?></textarea>

      <label for="country">Country</label>
      <input type="text" name="country" id="country" placeholder="Where do you live?" value="<?php if ($result['country']) {
                      echo $result['country']; } ?>">

      <label for="regpassword">Password</label>
      <input type="password" name="password" value="" id="regpassword" placeholder="Enter a new password">

      <button type="submit" class="small round button">Update!</button>
    </form>
  </div>
</body>


<?php endif; include("inc/footer.php");
?>
