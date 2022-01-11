<?php
  require_once 'dbh.inc.php';
  require_once 'login-functions.inc.php';

  if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (emptyInputLogin($username, $password) !== false) {
      header("location: ../pages/login.php?error=emptyinput");
      exit();
    }

    loginAdminUser($conn, $username, $password); 

  } else {
    header("location: ../pages/login.php?error=isthereanherror");
  }