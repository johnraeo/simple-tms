<?php
  require_once 'dbh.inc.php';
  require_once 'admin-signup-functions.inc.php';

  $type = 1;

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (emptyInputSignup($username, $password1, $password2) !== false) {
      header("location: ../pages/admin-signup.php?error=emptyinput");
      exit();
    }
    if (invalidUid($username) !== false) {
      header("location: ../pages/admin-signup.php?error=invaliduid");
      exit();
    }
    if (pwdMatch($password1, $password2) !== false) {
      header("location: ../pages/admin-signup.php?error=passwordsdontmatch");
      exit();
    }
    if (uidExists($conn, $username) !== false) {
      header("location: ../pages/admin-signup.php?error=usernametaken");
      exit();
    }

    createUser($conn, $username, $password1);

    // echo $_POST['username'] . ' ' . $_POST['password1'] . ' ' . $_POST['password2'] . ' ' . $type;
    // header("Location: ../index.php?signup=success");
  } else {
    echo 'no post';
    header("location: ../pages/admin-signup.php");
  }