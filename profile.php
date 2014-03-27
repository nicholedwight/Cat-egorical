<?php include("inc/header.php"); ?>
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
      <p>
        <?php echo $result['bio']; ?>
      </p>
      <p>
        <?php echo $result['country'] ?>
      </p>
    </div>

<?php endif;



include("inc/footer.php");
?>
