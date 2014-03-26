<?php include('inc/header.php');
      include('inc/library.php');
?>
<body id="homepage">

<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:
?>

<h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
<a href="logout.php" class="small round button">Logout</a>




<?php
endif;
?>
</body>
</html>
