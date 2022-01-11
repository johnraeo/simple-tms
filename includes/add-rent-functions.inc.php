<?php

  function emptyInput($name, $unit, $mobile, $date) {
    $result;

    if (empty($name) || empty($unit) || empty($mobile) || empty($date)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function invalidNum($mobile) {
    $result;
    if (strlen($mobile) > 20) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function addRenter($conn, $name, $unit, $mobile, $date) {
    $sql = "INSERT INTO renters (name, unit, mobile_num, date_in) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../index.php?error=stmtfailed");
      exit();
    }

    $fixedDate = date("$date H:i:s");
    mysqli_stmt_bind_param($stmt, "ssss", $name, $unit, $mobile, $fixedDate);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?pageno=1&add=success");
    exit();
  }