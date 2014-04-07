<?php include('inc/header.php');

?>
<body id="homepage">

<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>
<div id="home-wrapper">
  <div class="subheader">
    <h4>Blah</h4>
    <div class="tabs">
      <a href="index.php" class="current">Newest</a>
      <a href="tab.php">My Questions</a>
    </div>
  </div>
    <a href="submission.php" class="small round button ask">Ask A Question!</a>
</div>


<?php
endif;
?>
<?php include("inc/footer.php")
?>
