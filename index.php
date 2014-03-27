<?php include('inc/header.php');

?>
<body id="homepage">

<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>


<a href="submission.php" class="small round button">Ask A Question!</a>





<?php
endif;
?>
<?php include("inc/footer.php")
?>
