<?php include('inc/header.php');
      include('inc/library.php');
?>
<body id="homepage">

<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>

<a href="logout.php" class="small round button">Logout</a>




<?php
endif;
?>
</body>
</html>
