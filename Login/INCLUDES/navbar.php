<?php
session_start();
require_once '../MODEL/user.php';
$user = new User();

$user_login = null;
if (isset($_SESSION['user_id'])) {
    $user_login = $user->getUserById($_SESSION['user_id']);
}
?>


<nav class="navbar">
  <link rel="stylesheet" href="../STYLE/navbar.css">
  <div class="navbar-wrapper">

    <a class="navbar-brand" href="#">
  <img src="../ASSETS/WraithLogo.jpg" alt="Logo" class="logo-img">
</a>

    <div class="navbar-center">
      <a class="nav-link" href="home.php">Home</a>
      <a class="nav-link" href="list_user.php">User Management</a>
    </div>

    <div class="navbar-right">
      <span class="navbar-text">
        <?php echo isset($user_login['username']) ? $user_login['username'] : "Guest"; ?>
      </span>
      <a class="logout-btn" href="logout.php">logout</a>
    </div>

  </div>
</nav>



