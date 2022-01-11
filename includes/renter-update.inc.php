<?php

  require_once "dbh.inc.php";
  require_once "renter-update-functions.inc.php";

  $id = $_GET["id"];

  $sql_renter = "SELECT * FROM renters WHERE id = $id;";
  $renter_result = mysqli_query($conn, $sql_renter);
  $renter = mysqli_fetch_assoc($renter_result);

  if (isset($_POST["update-renter"])) {
    $name = $_POST["name"];
    $unit = $_POST["unit"];
    $mobile = $_POST["mobile"];

    if (emptyInput($name, $unit, $mobile)) {
      header("location: ../pages/renter-update.php?id=$id&error=emptyinput");
      exit();
    }

    updateRenter($conn, $id, $name, $unit, $mobile);
  }