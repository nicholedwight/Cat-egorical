<?php include('inc/header.php');

?>
<body id="homepage">

<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>

<div class="tabs">
  <a href="index.php">Newest</a>
  <a href="tab.php" class="current">My Questions</a>
</div>
<a href="submission.php" class="small round button ask">Ask A Question!</a>


<?php
endif;
?>
<?php include("inc/footer.php")
?>
