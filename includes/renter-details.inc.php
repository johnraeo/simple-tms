<?php

  require_once "dbh.inc.php";
  require_once "renter-details-functions.inc.php";

  $id = $_GET["id"];
  $totalAmt = 0;

  // Display tenant info
  $sql_renter = "SELECT * FROM renters WHERE id = $id;";
  $renter_result = mysqli_query($conn, $sql_renter);
  $renter = mysqli_fetch_assoc($renter_result);

  // Tenants payment pagination
  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }

  $no_of_records_per_age = 5;
  $offset = ($pageno - 1) * $no_of_records_per_age;

  $total_pages_sql = "SELECT COUNT(*) FROM renter_unit WHERE renter_id = $id;";
  $result = mysqli_query($conn, $total_pages_sql);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_age);

  $sql_renter_detail = "SELECT renter_unit.id, renter_unit.renter_id, renter_unit.unit_name, renter_unit.date_paid, renter_unit.amount, renter_unit.remarks FROM renter_unit LEFT JOIN renters ON renter_unit.id = renters.id WHERE renter_unit.renter_id = $id ORDER BY renter_unit.id DESC LIMIT $offset, $no_of_records_per_age;";
  $sqlresult = mysqli_query($conn, $sql_renter_detail);
  $resultCheck = mysqli_num_rows($sqlresult);


  if (isset($_POST['submit'])) {
    
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $remarks = $_POST['remarks'];

    if (emptyInput($amount, $date)) {
      header("location: ../pages/renter-details.php?id=$id&error=emptyinput");
      exit();
    }

    createPayment($conn, $id, $renter["unit"], $date, $amount, $remarks);
  }

  if (isset($_POST["cancel"])) {
    header("location: ../pages/renter-details.php?id=$id&pageno=1");
    exit();
  }

  if (isset($_POST["update-renter"])) {
    $name = $_POST["name"];
    $unit = $_POST["unit"];
    $mobile = $_POST["mobile"];
    $date = $_POST["date"];

    if (emptyRenterInput($name, $unit, $mobile, $date)) {
      header("location: ../pages/renter-details.php?id=$id&error=emptyinput");
      exit();
    }

    updateRenter($conn, $id, $name, $unit, $mobile, $date);
  }

  if (isset($_GET['deleterenterdetails'])) {
    $renterId = $_GET["renterid"];
    deleteDetail($conn, $id, $renterId);
  }

  if (isset($_GET['deleterenter'])) {
    $id = $_GET["id"];
    deleteRenter($conn, $id);
  }

  if (isset($_POST['vacate-renter'])) {
    $date = $_POST["date"];
    if (empty($date)) {
      header("location: ../pages/renter-details.php?id=$id&error=emptydate");
      exit();
    }
    vacateRenter($conn, $id, $date);
  }

  function fixDate($date) {

    $month = substr($date, 5, -12);
    switch($month) {
      case "01":
        return "January " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "02":
        return "February " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "03":
        return "March " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "04":
        return "April " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "05":
        return "May " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "06":
        return "June " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "07":
        return "July " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "08":
        return "August " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "09":
        return "September " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "10":
        return "October " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "11":
        return "November " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
      case "12":
        return "December " . substr($date, 8, 2) . " " . substr($date, 0, 4);
        break;
    }
    // return $month;
  }