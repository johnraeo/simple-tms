<?php

  require_once "dbh.inc.php";

  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }

  $no_of_records_per_age = 5;
  $offset = ($pageno - 1) * $no_of_records_per_age;

  $total_pages_sql = "SELECT COUNT(*) FROM renters";
  $result = mysqli_query($conn, $total_pages_sql);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_age);

  $sql = "SELECT * FROM renters ORDER BY id DESC LIMIT $offset, $no_of_records_per_age;";
  $sqlresult = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($sqlresult);

  // if ($resultCheck > 0) {
  //   while ($row = mysqli_fetch_assoc($result)) {
  //     echo '
  //         <tr>
  //           <th scope="row">'. $row["id"] . '</th>
  //           <td><a href="pages/renter-details.php?id='. $row["id"] . '">' . $row['name'] . '</a></td>
  //           <td><a href="pages/renter-details.php?id='. $row["id"] . '">' . $row['unit'] . '</a></td>
  //           <td><a href="pages/renter-details.php?id='. $row["id"] . '">' . $row['mobile_num'].'</a></td>
  //         </tr>
  //           ';
  //   }
  // }


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