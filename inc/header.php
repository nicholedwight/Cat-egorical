<?php session_start();
      ob_start();
      include('library.php');
      require('vendor/autoload.php');
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cat-egorical | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
<div class="fixed">
    <nav class="top-bar" data-topbar="">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">Cat-egorical</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#">Menu</a>
        </li>
      </ul>

    <body>
      <section class="top-bar-section">

        <!-- Right Nav Section -->
        <ul class="right show-for-large-up">
          <li class="active">
            <?php if (isset($_SESSION['email'])) { ?>
              <a href="logout.php">Logout</a>
            <?php } else { ?>
              <a href="login.php">Login</a>
            <?php }
            ?>
          </li>
          <li class="has-dropdown not-click">
            <a href="profile.php">Hello<?php if (isset($_SESSION['email'])) {
                                            echo ", " . $_SESSION['username'];
                                          }?>!</a></h1>
            <ul class="dropdown">
              <li class="title back js-generated">
                <h5><a href="javascript:void(0)">Back</a></h5>
              </li>
              <li><a href="profile.php?id=<?php echo getUserId($_SESSION['email']); ?>">My Profile</a></li>
              <li>
                  <a href="userdetails.php?id=<?php echo getUserId($_SESSION['email']); ?>">Edit Profile</a><li>
              <li><a href="userquestions.php?id=<?php echo getUserId($_SESSION['email']); ?>">My Questions</a></li>
            </ul>
          </li>
        </ul>

        <ul class="right hide-for-large-up">
          <li class="active"><a href="#">Right Button</a>
          </li>
          <li class="has-dropdown not-click">
            <a href="#">Right Dropdown</a>
            <ul class="dropdown">
              <li class="title back js-generated">
                <h5><a href="javascript:void(0)">Back</a></h5>
              </li>
              <li><a href="#">First link in dropdown</a>
              </li>
            </ul>
          </li>
        </ul>

        <!-- Left Nav Section -->
        <ul class="left show-for-large-up">
          <?php if (isset($_SESSION['email'])) {?>
          <li><a href="forum.php">Forum</a></li>
          <li><a href="submission.php">Ask</a></li>
          <?php } ?>
        </ul>
      </section>
    </nav>
</div>
