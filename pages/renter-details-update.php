<?php
  session_start();

  if (isset($_SESSION["username"]) && isset($_SESSION["id"])) {
  
  // require_once "../includes/dbh.inc.php";
  require_once "../includes/renter-details-update.inc.php";

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
  <link href="../assets/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../index.php">
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

    <div class="section-1 d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-lg-8">
            <div class="box-1">
              <form action="../includes/renter-details-update.inc.php?id=<?php echo $_GET["id"] ?>&renterid=<?php echo $_GET["renterid"] ?>&edit=true" method="post">
                <h3>Update detail</h3>
                <div class="mb-3">
                  <label for="date" class="form-label">Date</label>
                  <input type="date" class="form-control" id="date" aria-describedby="date" name="date" value="<?php echo substr($renter["date_paid"], 0, 10) ?>">
                </div>
                <div class="mb-3">
                  <label for="amount" class="form-label">Amount</label>
                  <input type="text" class="form-control" id="amount" aria-describedby="amount" name="amount" value="<?php echo $renter["amount"] ?>">
                </div>
                <div class="mb-3">
                  <label for="remarks" class="form-label">Remarks</label>
                  <input type="text" class="form-control" id="remarks" aria-describedby="remarksHelp" name="remarks" value="<?php echo $renter["remarks"] ?>">
                </div>
                <button name="cancel" class="btn btn-danger">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js" ></script>
  <!-- <script src="../js/renter-details.js"></script> -->
</body>
</html>

<?php
  }
  else {
    header("location: pages/login.php");
  }
?>