<?php
use forxer\Gravatar\Gravatar;
include("inc/header.php"); ?>
<body id="profile">
<?php
if ($_GET):
    $db = connectToDatabase();
    $user = $_GET['id'];
    $query = "SELECT * FROM `users` WHERE `id` = $user";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); ?>

    <div class="profile-info">
      <h1>
        <?php echo $result['username']; ?>
      </h1>
      <?php if (getUsernameFromId($result['id']) == $_SESSION['username']) { ?>
      <img src="
      <?php echo Gravatar::image($_SESSION['email'], null, "retro"); ?>">
      <?php } else { ?>
        <img src="
        <?php echo Gravatar::image($result['email'], null, "retro"); ?>">
      <?php }
      if (getUsernameFromId($result['id']) == $_SESSION['username']) { ?>
        <a href="userdetails.php?id=<?php echo getUserId($_SESSION['email']); ?>" class="small round button edit">Edit Profile</a>
        <a href="delete.php?id=<?php echo getUserId($_SESSION['email']) ?>" class="delete">Delete Account</a>
      <?php } ?>
      <p><span class="profilespec">About <?php echo $result['username']; ?>:</span>
        <?php echo $result['bio']; ?>
      </p>
      <p><span class="profilespec">Lives in:</span>
        <?php echo $result['country']; ?>
      </p>
      <p>
        <span class="profilespec">Member since:</span>
        <?php echo $result['created_at']; ?>
      </p>
      <p>
        See all questions asked by <?php echo $result['username']; ?> <a href="userquestions.php?id=<?php echo $result['id']; ?>">here</a>!
      </p>
    </div>
<?php endif;



include("inc/footer.php");
?>
