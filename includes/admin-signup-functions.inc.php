<?php

  function emptyInputSignup($username, $password1, $password2) {
    $result;

    if (empty($username) || empty($password1) || empty($password2)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function invalidUid($username) {
    $result;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function pwdMatch($password1, $password2) {
    $result;

    if ($password1 !== $password2) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function uidExists($conn, $username) {
    $sql = "SELECT * FROM admin_users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../pages/admin-signup.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
      return $row;
    } else {
      $result = false;
      return $result;
    }

    mysqli_stmt_close($stmt);
  }

  function createUser($conn, $username, $password1) {
    $sql = "INSERT INTO admin_users (username, password, admin) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../pages/admin-signup.php?error=stmtfailed");
      exit();
    }

    $hashedPwd = password_hash($password1, PASSWORD_DEFAULT);

    $admin = 1;
    mysqli_stmt_bind_param($stmt, "ssi", $username, $hashedPwd, $admin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../pages/admin-signup.php?error=none");
    exit();
  }