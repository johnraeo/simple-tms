<?php

  function emptyInputLogin($username, $password) {
    $result;

    if(empty($username) || empty($password)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }
  
  function loginAdminUser($conn, $username, $password) {

    $sql = "SELECT * FROM admin_users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../pages/login.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
      // return $row;
      $usernameExists = $row;
    } else {
      // $result = false;
      // echo "there is a problem";
      $usernameExists = false;
      // return $result;
    }
    
    mysqli_stmt_close($stmt);

    

    if ($usernameExists === false) {
      header("location: ../pages/login.php?error=wronglogin");
      exit();
    }

    $pwdHashed = $usernameExists["password"];
    $checkPwd = password_verify($password, $pwdHashed);

    if ($checkPwd === false) {
      header("location: ../pages/login.php?error=wrongpass");
      exit();
    } else if ($checkPwd === true) {
      session_start();
      $_SESSION["id"] = $usernameExists["id"];
      $_SESSION["username"] = $usernameExists["username"];
      $_SESSION["type"] = $usernameExists["type"];
      $_SESSION["tae"] = "test";
      header("location: ../index.php?pageno=1&login=success");
      exit();
    }
  }