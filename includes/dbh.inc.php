<?php

  $dbServer = "localhost";
  $dbUser = "root";
  $dbPass = "";
  $dbName = "simple_tenantms";

  $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // $testHash = password_hash("$2y$10\$l.pEU2GFjmPCYxs1ebGFLOOCV3Yarm3IxyOPI1qX4HzU.kt.XiFQe", PASSWORD_DEFAULT);

  // echo $testHash;