<?php
  session_start();

  if (isset($_SESSION["username"]) && isset($_SESSION["id"])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Tenant Mangement System</title>
  <link rel="icon" type="image/x-icon" href="assets/tenant.png">

  <link href="bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet" >
  <link href="css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php?pageno=1">
        <!-- <img src="assets/png-branch.png" alt="" width="45" class="d-inline-block align-text-top"> -->
        <img src="assets/tenant.png" alt="" width="40" class="d-inline-block align-text-top">
      </a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <!-- <a class="navbar-brand" href="index.php">Any1234</a> -->
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
              <li><a class="dropdown-item" href="includes/logout.inc.php">Logout</a></li>
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
          <!-- <div class="col-md-4">
            <div class="box-1">
              <h3>Home page</h3>
            </div>
          </div> -->
          <div class="col-md-10">
            <div class="box-2">
              <?php
                if (isset($_GET["error"])) {
                  if ($_GET["error"] == "emptyinput") {

                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                            Please fill up all forms.
                          </div>";

                  } else if ($_GET["error"] == "invalidnum") {
                    
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                            Invalid mobile number.
                          </div>";

                  }
                }
              ?>
              <div class="box-2-header">
                <h3>Tenants list</h3>
                <button type="button" id="add-button" class="btn btn-primary">Add tenant</button>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Mobile #</th>
                    <th scope="col">Date in</th>
                    <th scope="col">Date out</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php include "includes/index-display-users.inc.php"; ?>
                  <?php
                    if ($resultCheck > 0) {
                      while ($row = mysqli_fetch_assoc($sqlresult)) {
                        echo '
                            <tr>
                              <th scope="row">'. $row["id"] . '</th>
                              <td>' . $row['name'] . '</td>
                              <td>' . $row['unit'] . '</td>
                              <td>' . $row['mobile_num'].'</td>
                              <td>' . fixDate($row['date_in']) . '</td>
                              <td>' . ($row['date_out'] == null ? "Active" : fixDate($row['date_out'])) . '</td>
                              <td><a class="btn btn-info" href="pages/renter-details.php?id='. $row["id"] . '&pageno=1">View Details</a></td> 
                            </tr>
                              ';
                      }
                    } else {
                      echo "Test";
                    }
                  ?>
                  <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry the Bird</td>
                    <td>Tree</td>
                    <td>@twitter</td>
                  </tr> -->
                </tbody>
              </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "index.php?pageno=".($pageno - 1); } ?>">Previous</a>
                  </li> 
                  <?php
                    for ($page = 1; $page <= $total_pages; $page++) {
                      echo '<li class="page-item ' . (isset($_GET["pageno"]) ? ($_GET["pageno"] == $page ? "active" : "") : "") . '"><a class="page-link" href="index.php?pageno=' . $page . '">' . $page . '</a></li>';
                      // echo $page;
                    }
                  ?>
                  <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                  <li class="page-item <?php if($pageno >= $total_pages) { echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "index.php?pageno=".($pageno + 1); } ?>">Next</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <!-- <ul class="pagination">
            <li><a href="index.php?pageno=1">First</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "index.php?pageno=".($pageno - 1); } ?>">Prev</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "index.php?pageno=".($pageno + 1); } ?>">Next</a>
            </li>
            <li><a href="index.php?pageno=<?php echo $total_pages; ?>">Last</a></li>
          </ul> -->
        </div>
      </div>
    </section>

    <!-- Modal section -->
    <div class="section-add-modal d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-lg-8">
            <div class="box-1">
              <form action="includes/add-rent.inc.php" method="post">
                <h3>Add renters</h3>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" aria-describedby="name" name="name">
                </div>
                <div class="mb-3">
                  <label for="unit" class="form-label">Unit</label>
                  <input type="text" class="form-control" id="unit" aria-describedby="unitHelp" name="unit">
                </div>
                <div class="mb-3">
                  <label for="mobile" class="form-label">Mobile</label>
                  <input type="tel" class="form-control" id="mobile" name="mobile">
                </div>
                <div class="mb-3">
                  <label for="date" class="form-label">Date In</label>
                  <input type="date" class="form-control" id="date" aria-describedby="date" name="date">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js" ></script>
  <script src="js/index.js"></script>
</body>
</html>

<?php
  }
  else {
    header("location: pages/login.php");
  }
?>