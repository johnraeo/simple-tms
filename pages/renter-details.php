<?php
  session_start();

  if (isset($_SESSION["username"]) && isset($_SESSION["id"])) {
  
  // require_once "../includes/dbh.inc.php";
  require_once "../includes/renter-details.inc.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Tenant Mangement System</title>
  <link rel="icon" type="image/x-icon" href="../assets/tenant.png">

  <link href="../assets/bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet" >
  <link href="../assets/css/renter-details.css" rel="stylesheet" type="text/css">
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../index.php?pageno=1">
        <!-- <img src="assets/png-branch.png" alt="" width="45" class="d-inline-block align-text-top"> -->
        <img src="../assets/tenant.png" alt="" width="40" class="d-inline-block align-text-top">
      </a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <!-- <a class="navbar-brand" href="../index.php">Any1234</a> -->
        <div class="me-auto"></div>
        <ul class="navbar-nav">
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/about.php">About</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">FAQs</a>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION["username"]; ?>
              <!-- Pages -->
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!-- <li><a class="dropdown-item" href="#">Site 1</a></li>
              <li><a class="dropdown-item" href="#">Site 2</a></li> -->
              <!-- <li><hr class="dropdown-divider"></li> -->
              <li><a class="dropdown-item" href="../includes/logout.inc.php">Logout</a></li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="pages/signup.php">Sign up</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="includes/logout.inc.php">Logout</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <main>

    <section class="section-1 d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-3">
            <div class="box-1">
              <!-- <h3>Home page</h3> -->
              <h4>Tenant's name:</h4> 
              <?php echo "<h5> - " . $renter["name"] . "</h5>"; ?>
              <h4>Unit: </h4>
              <?php echo "<h5> - " . $renter["unit"] . "</h5>"; ?>
              <h4>Mobile #: </h4>
              <?php echo "<h5> - " . $renter["mobile_num"] . "</h5>"; ?>
              <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Info
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#" id="editTenantBtn">Edit</a></li>
                  <li><a class="dropdown-item" href="#" id="deleteTenantBtn">Delete</a></li>
                  <li><a class="dropdown-item" href="#" id="abandonTenant">Vacate</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="box-2">

              <?php
                if (isset($_GET["error"])) {
                  if ($_GET["error"] == "emptyinput") {
                    
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                            Please fill up all fields.
                          </div>";

                  } else if ($_GET["error"] == "emptydate") {
                  
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                                Please fill up date of vacate.
                              </div>";
  
                  }
                } else if (isset($_GET["paymentadded"])) {

                    echo "<div class=\"alert alert-success\" role=\"alert\">
                              Payment added.
                            </div>";

                } else if (isset($_GET["update_user"])) {
                  
                  echo "<div class=\"alert alert-warning\" role=\"alert\">
                              Payment details updated.
                            </div>";

                }
              ?>
              <div class="box-2-header">
                <h3>Renters payment details:</h3>
                <button type="button" id="add-payment" class="btn btn-primary">Add payment</button>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Date paid</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">      </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    
                    if ($resultCheck > 0) {
                      while ($renterDetail = mysqli_fetch_assoc($sqlresult)) {
                        // echo '
                        //      <tr>
                        //        <th scope="row">'. $renterDetail["date_paid"] . '</th>
                        //        <td> Php ' . $renterDetail['amount'] . '</td>
                        //        <td>' . $renterDetail['remarks'] . '</td>
                        //        <td><a class="btn btn-warning" href="renter-details-update.php?id=' . $renterDetail["id"] . '&renterid=' . $renter['id'] . '">Edit</a> <a class="btn btn-danger" href="../includes/renter-details.inc.php?id=' . $renterDetail['id'] .'&renterid=' . $renter['id'] . '&deleterenterdetails=true">Delete</a></td>
                        //      </tr>
                        //       ';
                        echo '
                             <tr>
                               <th scope="row">'. fixDate($renterDetail["date_paid"]) . '</th>
                               <td> Php ' . $renterDetail['amount'] . '</td>
                               <td>' . $renterDetail['remarks'] . '</td>
                               <td><a class="btn btn-warning" href="renter-details-update.php?id=' . $renterDetail["id"] . '&renterid=' . $renter['id'] . '">Edit</a></td>
                             </tr>
                              ';
                        $totalAmt += $renterDetail['amount'];
                      }
                    }
                    echo "<h5>Total amount accumulated: Php <span>$totalAmt</span></h5>";
                  ?>
                  <!-- <tr>
                    <th scope="row">January 12, 2021</th>
                    <td>Php 6500.00</td>
                    <td>None</td>
                    <td><button>Update</button><button>Delete</button></td>
                  </tr>
                  <tr>
                  <th scope="row">January 12, 2021</th>
                    <td>Php 6500.00</td>
                    <td>None</td>
                    <td><button>Update</button><button>Delete</button></td>
                  </tr>
                  <tr>
                  <th scope="row">January 12, 2021</th>
                    <td>Php 6500.00</td>
                    <td>None</td>
                    <td><button>Update</button><button>Delete</button></td>
                  </tr> -->
                </tbody>
              </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "renter-details.php?id=" . $renter["id"] . "&pageno=".($pageno - 1); } ?>">Previous</a>
                  </li> 
                  <?php
                    for ($page = 1; $page <= $total_pages; $page++) {
                      echo '<li class="page-item ' . (isset($_GET["pageno"]) ? ($_GET["pageno"] == $page ? "active" : "") : "") . '"><a class="page-link" href="renter-details.php?id='. $renter["id"] . '&pageno=' . $page . '">' . $page . '</a></li>';
                      // echo $page;
                    }
                  ?>
                  <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                  <li class="page-item <?php if($pageno >= $total_pages) { echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "renter-details.php?id=" . $renter["id"] . "&pageno=".($pageno + 1); } ?>">Next</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal section add payment -->
    <div class="section-add-modal d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-lg-8">
            <div class="box-1">
              <form action="../includes/renter-details.inc.php?id=<?php echo $renter["id"]; ?>" method="post">
                <h3>Add renters</h3>
                <div class="mb-3">
                  <label for="date" class="form-label">Date</label>
                  <input type="date" class="form-control" id="date" aria-describedby="date" name="date">
                </div>
                <div class="mb-3">
                  <label for="amount" class="form-label">Amount</label>
                  <input type="text" class="form-control" id="amount" aria-describedby="amount" name="amount">
                </div>
                <div class="mb-3">
                  <label for="remarks" class="form-label">Remarks</label>
                  <input type="text" class="form-control" id="remarks" aria-describedby="remarksHelp" name="remarks">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit modal section -->
    <div class="section-edit-modal d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-lg-8">
            <div class="box-1">
              <form action="../includes/renter-details.inc.php?id=<?php echo $renter["id"] ?>" method="post">
                <h3>Update Renter</h3>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="<?php echo $renter["name"] ?>">
                </div>
                <div class="mb-3">
                  <label for="unit" class="form-label">Unit</label>
                  <input type="text" class="form-control" id="unit" aria-describedby="unitHelp" name="unit" value="<?php echo $renter["unit"] ?>">
                </div>
                <div class="mb-3">
                  <label for="mobile" class="form-label">Mobile</label>
                  <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo $renter["mobile_num"] ?>">
                </div>
                <div class="mb-3">
                  <label for="date" class="form-label">Date</label>
                  <input type="date" class="form-control" id="date" aria-describedby="date" name="date" value="<?php echo substr($renter["date_in"], 0, 10) ?>">
                </div>
                <button type="submit" name="update-renter" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Confirm delete tenant modal section -->
    <div class="section-delete-modal d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-lg-8">
            <div class="box-1">
              <p>Are you sure you want to permanently remove this tenant?</p>
              <button class="btn btn-primary cancel-delete">Cancel</button>
              <a class="btn btn-danger" href="../includes/renter-details.inc.php?id=<?php echo $renter["id"] ?>&deleterenter=true">Delete</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Confirm abandon tenant modal section -->
    <div class="section-abandon-modal d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-lg-8">
            <div class="box-1">
              <p>Confirmation about the Tenant's Vacate</p>
              <!-- <button class="btn btn-primary cancel-delete">Cancel</button> -->
              <!-- <a class="btn btn-danger" href="../includes/renter-details.inc.php?id=<?php //echo $renter["id"] ?>&vacaterenter=true">Vacate</a> -->
              <form action="../includes/renter-details.inc.php?id=<?php echo $renter["id"] ?>&vacaterenter=true" method="post">
                <h3>Vacate Tenant confirmation</h3>
                <div class="mb-3">
                  <label for="date" class="form-label">Date out</label>
                  <input type="date" class="form-control" id="date" aria-describedby="date" name="date" value="<?php echo $renter["date_in"] ?>">
                </div>
                <button name="cancel" class="btn btn-primary cancel-delete">Cancel</button>
                <button type="submit" name="vacate-renter" class="btn btn-warning">Submit</button>
              </form>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js" ></script>
  <script src="../js/renter-details.js"></script>
</body>
</html>

<?php
  }
  else {
    header("location: pages/login.php");
  }
?>