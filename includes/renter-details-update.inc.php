<?php
  require_once "dbh.inc.php";
  require_once "renter-details-functions.inc.php";

  $id = $_GET["id"];
  $renterId = $_GET["renterid"];

  $sql_renter = "SELECT * FROM renter_unit WHERE id = $id;";
  $renter_result = mysqli_query($conn, $sql_renter);
  $renter = mysqli_fetch_assoc($renter_result);


  if (isset($_POST['submit'])) {

    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $remarks = $_POST['remarks'];

    if (emptyInput($date, $amount)) {
      header("location: ../pages/renter-details.php?id=$id&error=emptyinput");
      exit();
    }

    updateDetail($conn, $id, $renterId, $date, $amount, $remarks);
  }

  if (isset($_POST["cancel"])) {
    header("location: ../pages/renter-details.php?id=$renterId&pageno=1");
    exit();
  }