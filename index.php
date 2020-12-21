<!DOCTYPE html>
<html>

<head>
  <meta charset="utf8">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<?php
ob_start();
session_start();
$pageTitle = 'Login';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['login'])) {

    $user = $_POST['username'];

    $_SESSION['username'] = $user;

    header('Location: chat.php');
  }
}



?>

<div class="container login-page">


  <!-- Start Login Form -->
  <form class="login container" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

    <h1 class="text-center">
      <span class="selected" data-class="login">Login</span>
    </h1>
    <div class="input-container">
      <input class="form-control" type="text" name="username" autocomplete="off" placeholder="Type your username" required />
    </div>
    <input class="btn btn-primary btn-block" name="login" type="submit" value="Login" />
  </form>


  <?php
  ob_end_flush();
  ?>