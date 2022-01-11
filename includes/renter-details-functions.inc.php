<?php

  function emptyInput($amount, $date) {
    $result;

    if (empty($amount) || empty($date)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function createPayment($conn, $id, $unit, $date, $amount, $remarks) {
    if ($remarks == '') {
      $remarks = "None";
    }

    $sql = "INSERT INTO renter_unit (renter_id, unit_name, date_paid, amount, remarks) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../pages/renter-details.php?id=$id&error=stmtfailed");
      exit();
    }

    // $date = date("Y-m-d H:i:s");
    $fixedDate = date("$date H:i:s");
    mysqli_stmt_bind_param($stmt, "issis", $id, $unit, $fixedDate, $amount, $remarks);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../pages/renter-details.php?id=$id&paymentadded=ok");
    exit();
  }
  
  function deleteDetail($conn, $id, $renterId) {
    $sql = "DELETE FROM renter_unit WHERE id=$id;";

    if ($conn->query($sql) === TRUE) {
      header("location: ../pages/renter-details.php?id=$renterId&delete_user=success");
    } else {
      echo "Error deleteing record: " . $conn->error;
    }

    $conn->close();
  }

  function updateDetail($conn, $id, $renterId, $date, $amount, $remarks) {
    if ($remarks == "") {
      $remarks = "None";
    }

    $fixedDate = date("$date H:i:s");
    $sql = "UPDATE renter_unit SET date_paid = '$fixedDate', amount = $amount, remarks = '$remarks' WHERE id = $id;";

    if ($conn->query($sql) === TRUE) {
      header("location: ../pages/renter-details.php?id=$renterId&update_user=success");
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }

  function deleteRenter($conn, $id) {
    $sql = "DELETE FROM renter_unit WHERE renter_id = $id; DELETE FROM renters WHERE id = $id;";

    if ($conn->multi_query($sql) === TRUE) {
      header("location: ../index.php?renterdelete=success&id=$id");
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  }

  function emptyRenterInput($name, $unit, $mobile) {
    $result;

    if (empty($name) || empty($unit) || empty($mobile)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function updateRenter($conn, $id, $name, $unit, $mobile, $date) {

    $sql = "UPDATE renters SET name = '$name', unit = '$unit', mobile_num = '$mobile', date_in = '$date' WHERE id = $id;";

    if ($conn->query($sql) === TRUE) {
      header("location: ../pages/renter-details.php?id=$id&update_renter=success");
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }

  function vacateRenter($conn, $id, $date) { 
    $fixedDate = date("$date H:i:s");
    $sql = "UPDATE renters SET date_out = '$fixedDate' WHERE id = $id;";

    if ($conn->query($sql) === TRUE) {
      header("location: ../index.php?pageno=1");
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }