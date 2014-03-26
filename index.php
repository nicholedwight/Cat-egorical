<?php include('inc/header.php');
      
?>
<body id="homepage">

<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>








<?php
endif;
?>
<?php include("inc/footer.php")
?>
