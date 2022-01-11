<?php

  function emptyRenterInput($name, $unit, $mobile) {
    $result;

    if (empty($name) || empty($unit) || empty($mobile)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

  function updateRenter($conn, $id, $name, $unit, $mobile) {

    $sql = "UPDATE renters SET name = '$name', unit = '$unit', mobile_num = '$mobile' WHERE id = $id;";

    if ($conn->query($sql) === TRUE) {
      header("location: ../index.php?update_renter=success");
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }