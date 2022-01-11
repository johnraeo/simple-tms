<?php
  require_once 'dbh.inc.php';
  require_once 'signup-functions.inc.php';

  $type = 1;

  if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (emptyInputSignup($fullName, $email, $username, $password1, $password2) !== false) {
      header("location: ../pages/signup.php?error=emptyinput");
      exit();
    }
    if (invalidUid($username) !== false) {
      header("location: ../pages/signup.php?error=invaliduid");
      exit();
    }
    if (invalidEmail($email) !== false) {
      header("location: ../pages/signup.php?error=invalidemail");
      exit();
    }
    if (pwdMatch($password1, $password2) !== false) {
      header("location: ../pages/signup.php?error=passwordsdontmatch");
      exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
      header("location: ../pages/signup.php?error=usernametaken");
      exit();
    }

    createUser($conn, $fullName, $email, $username, $password1);

    // echo $_POST['username'] . ' ' . $_POST['password1'] . ' ' . $_POST['password2'] . ' ' . $type;
    // header("location: ../index.php?signup=success");
  } else {
    echo 'no post';
    header("location: ../pages/signup.php");
  }