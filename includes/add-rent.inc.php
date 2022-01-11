<?php

  require_once 'dbh.inc.php';
  require_once 'add-rent-functions.inc.php';

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $mobile = $_POST['mobile'];
    $date = $_POST['date'];

    if (emptyInput($name, $unit, $mobile, $date)) {
      header("location: ../index.php?error=emptyinput");
      exit();
    }

    if (invalidNum($mobile)) {
      header("location: ../index.php?error=invalidnum");
      exit();
    }

    addRenter($conn, $name, $unit, $mobile, $date);
  }