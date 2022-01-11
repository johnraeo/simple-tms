<?php
  session_start();

  if (!isset($_SESSION["username"]) && !isset($_SESSION["id"])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Simple Tenant Management System</title>
  <link rel="icon" type="image/x-icon" href="../assets/tenant.png">
  
  <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet" >
  <link href="../css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img src="../assets/tenant.png" alt="" width="40" class="d-inline-block align-text-top">
      </a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <!-- <a class="navbar-brand" href="#">Any1234</a> -->
        <div class="me-auto"></div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <!-- <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">FAQs</a>
          </li> -->
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pages
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="pages/quotes.html">Quotes</a></li>
              <li><a class="dropdown-item" href="https:\\thinkandnoteb.herokuapp.com" target="_blank">Think and Note</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign up</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>

    <section class="section-1 d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-6">
            <div class="box-1">
              <h2>Login</h2>
              <form action="../includes/login.inc.php" method="post">
                <!-- <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div> -->
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" name="username">
                </div>
                <div class="mb-3">
                  <label for="password1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <!-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
              
                <?php
                  if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {

                      echo "<div class=\"alert alert-danger\" role=\"alert\">
                              Please fill up all fields.
                            </div>";

                    } else if ($_GET["error"] == "stmtfailed") {

                      echo "<div class=\"alert alert-danger\" role=\"alert\">
                              Something went wrong.
                            </div>";

                    } else if ($_GET["error"] == "wronglogin") {

                      echo "<div class=\"alert alert-danger\" role=\"alert\">
                              Username does not exists.
                            </div>";

                    } else if ($_GET["error"] == "wrongpass") {

                      echo "<div class=\"alert alert-danger\" role=\"alert\">
                              Wrong password.
                            </div>";

                    } else if ($_GET["error"] == "none") {

                      echo "<div class=\"alert alert-success\" role=\"alert\">
                              User created.
                            </div>";

                    }
                  }
                
                ?>

            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>

<?php 
  }
  else {
    header("location: ../index.php");
  }
?>