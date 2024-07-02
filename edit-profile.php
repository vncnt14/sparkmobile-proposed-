<?php
session_start();

// Include database connection file
include('config.php');  // You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
  header("Location index.php");
  exit;
}

// Fetch user information based on ID
$userID = $_SESSION['user_id']; // Assuming you have a user ID stored in the session

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT * FROM users WHERE user_id = '$userID'";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$userData = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <title>SPARK MOBILE</title>
  <link rel="icon" href="NEW SM LOGO.png" type="image/x-icon">
  <link rel="shortcut icon" href="NEW SM LOGO.png" type="image/x-icon">
</head>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap");

  body,
  button {
    font-family: "Poopins", sans-serif;
    margin-top: 20px;
    background-color: #fff;
    color: #fff;
  }

  :root {
    --offcanvas-width: 200px;
    --topNavbarHeight: 56px;
  }

  .sidebar-nav {
    width: var(--offcanvas-width);
    background-color: orangered;
  }

  .sidebar-link {
    display: flex;
    align-items: center;
  }

  .sidebar-link .right-icon {
    display: inline-flex;
  }

  .sidebar-link[aria-expanded="true"] .right-icon {
    transform: rotate(180deg);
  }

  @media (min-width: 992px) {
    body {
      overflow: auto !important;
    }

    main {
      margin-left: var(--offcanvas-width);
    }

    /* this is to remove the backdrop */
    .offcanvas-backdrop::before {
      display: none;
    }

    .sidebar-nav {
      -webkit-transform: none;
      transform: none;
      visibility: visible !important;
      height: calc(100% - var(--topNavbarHeight));
      top: var(--topNavbarHeight);
    }
  }


  .welcome {
    font-size: 15px;
    text-align: center;
    margin-top: 20px;
    margin-right: 15px;
  }

  .me-2 {
    color: #fff;
    font-weight: normal;
    font-size: 13px;

  }

  .me-2:hover {
    background: orangered;
  }

  span {
    color: #fff;
    font-weight: bold;
    font-size: 20px;
  }

  img {
    width: 30px;
    border-radius: 50px;
    display: block;
    margin: auto;
  }

  .img-account-profile {
    width: 80%;
    height: auto;
    border-radius: 50%;
    display: block;
    margin: auto;
  }

  li:hover {
    background: #072797;
  }

  .v-1 {
    background-color: #072797;
    color: #fff;
  }

  .main {
    margin-left: 200px;
  }

  .form-group {
    color: black;
  }

  .dropdown-item:hover {
    background-color: orangered;
    color: #fff;
  }

  .my-4:hover {
    background-color: #fff;
  }

  .navbar {
    background-color: #072797;
  }

  .btn:hover {
    background-color: orangered;
  }

  .nav-links ul li:hover a {
    color: white;
  }

  .img-account-profile {
    width: 200px;
    /* Adjust the size as needed */
    height: 200px;
    object-fit: cover;
    border-radius: 50%;
  }
</style>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="smweb.html"><img src="NEW SM LOGO.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <form class="d-flex ms-auto my-3 my-lg-0">
        </form>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
          <li class="">
            <a href="notification.html" class="nav-link px-3">
              <span class="me-2"><i class="fas fa-bell"></i></i></span>
            </a>
          </li>
          <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Visual</a></li>
            <li>
              <a class="dropdown-item" href="logout.php">Log out</a>
            </li>
          </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <li class="my-4">
    <hr class="dropdown-divider bg-primary" />
  </li>
  <!-- top navigation bar -->
  <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar" <div class="offcanvas-body p-0">
    <nav class="">
      <ul class="navbar-nav">


        <div class=" welcome fw-bold px-3 mb-3">
          <h5 class="text-center">Welcome back <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>!</h5>
        </div>
        <div class="ms-3" id="dateTime"></div>
        </li>
        <li>
        <li class="v-1">
          <a href="csdashboard.php" class="nav-link px-3">
            <span class="me-2"><i class="fas fa-user"></i></i></span>
            <span class="start">PROFILE</span>
          </a>
        </li>
        <li>

        <li class="">
          <a href="cscars1.php" class="nav-link px-3">
            <span class="me-2"><i class="fas fa-car"></i></i></span>
            <span>MY CARS</span>
          </a>
        </li>
        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#layouts">
          <span class="me-2"><i class="fas fa-calendar"></i></i></span>
          <span>BOOKINGS</span>
          <span class="ms-auto">
            <span class="right-icon">
              <i class="bi bi-chevron-down"></i>
            </span>
          </span>
        </a>
        <div class="collapse" id="layouts">
          <ul class="navbar-nav ps-3">
            <li class="v-1">
              <a href="setappoinment.php" class="nav-link px-3">
                <span class="me-2">Set Appointment</span>
              </a>
            </li>
            <li class="v-1">
              <a href="checkingcar.php" class="nav-link px-3">
                <span class="me-2">Checking car condition</span>
              </a>
            </li>
            <li class="v-1">
              <a href="#" class="nav-link px-3">
                <span class="me-2">Request Slot</span>
              </a>
            </li>
            <li class="v-1">
              <a href="#" class="nav-link px-3">
                <span class="me-2">Select Service</span>
              </a>
            </li>
            <li class="v-1">
              <a href="#" class="nav-link px-3">
                <span class="me-2">Register your car</span>
              </a>
            </li>
            <li class="v-1">
              <a href="#" class="nav-link px-3">
                <span class="me-2">Booking Summary</span>
              </a>
            </li>
            <li class="v-1">
              <a href="#" class="nav-link px-3">
                <span class="me-2">Booking History</span>
              </a>
            </li>
          </ul>
        </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#layouts2">
            <span class="me-2"><i class="fas fa-money-bill"></i>
              </i></i></span>
            <span>PAYMENTS</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="layouts2">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="#" class="nav-link px-3">
                  <span class="me-2">Payment options</span>
                </a>
              </li>
              <li>
                <a href="#" class="nav-link px-3">
                  <span class="me-2">Car wash invoice</span>
                </a>
              </li>
              <li>
                <a href="#" class="nav-link px-3">
                  <span class="me-2">Payment History</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <a href="#" class="nav-link px-3">
            <span class="me-2"><i class="fas fa-medal"></i>
              </i></span>
            <span>REWARDS</span>
          </a>
        </li>
        <li>
          <a href="logout.php" class="nav-link px-3">
            <span class="me-2"><i class="fas fa-sign-out-alt"></i>
              </i></span>
            <span>LOG OUT</span>
          </a>
        </li>

      </ul>
    </nav>
  </div>
  </div>
  <!-- main content -->
  <main>
    <div class="personal-details">
      <div class="container-fluid py-3">
        <div class="row">
          <h2 class="text-black">Car Owner Details</h2>
          <!-- Account page navigation-->
          <hr class="mt-0 mb-4">
          <div class="row">
            <!-- Profile picture card -->
            <div class="col-xl-4 mb-4 mb-xl-4">
              <div class="card">
                <form action="upload-profile-backend.php" method="POST" enctype="multipart/form-data">
                  <center>
                    <div class=" v-1 card-header text-light"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>'s profile</div>
                  </center>
                  <div class="card-body text-center">
                    <img class="img-account-profile mb-3" src="<?php echo $userData['profile']; ?>" alt="">
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <label for="profile"></label>
                    <div class="input-group">
                      <input type="file" class="form-control" id="profile" name="profile" accept="image/*">

                    </div>
                    <button type="submit" class="btn btn-primary">Submit Profile</button>
                </form>
              </div>
            </div>
            <form action="update-profile-backend.php" method="POST">
          </div>
          <div class="col-md-4 mb-4">
            <div class="form-group mb-3">
              <label for="firstname">First Name:</label>
              <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $userData['firstname']; ?>" placeholder="Edit your First Name" required>
              <input type="hidden" class="form-control" id="role" name="role">
            </div>
            <div class="form-group mb-3">
              <label for="lastname">Last Name:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $userData['lastname']; ?>" placeholder="Edit your Last Name" required>
            </div>
            <div class="form-group mb-3">
              <label for="contact">Phone Number:</label>
              <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $userData['contact']; ?>" placeholder="Edit your Contact" required>
            </div>
            <div class="form-group mb-3 text-dark">
              <label for="role">User Type:</label>
              <select class="form-select" id="role" name="role">>
                <option value="customer"></option>
                <option value="user" <?php if ($userData['role'] == 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if ($userData['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="staff" <?php if ($userData['role'] == 'staff') echo 'selected'; ?>>Staff</option>
              </select>
            </div>

          </div>
          <div class="col-md-4 mb-4">
            <div class="form-group mb-3">
              <label for="address">Complete Address:</label>
              <input type="text" class="form-control" id="address" name="address" value="<?php echo $userData['address']; ?>" placeholder="Edit your Address" required>
            </div>
            <div class="form-group mb-3">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $userData['email']; ?>" placeholder="Edit your Email" required>
            </div>
            <div class="form-group mb-3">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" value="<?php echo $userData['username']; ?>" required>
            </div>
            <div class="form-group mb-3">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" value="<?php echo $userData['password']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>

        </div>
      </div>
    </div>
    </div>

    <script>
      function updateDateTime() {
        // Get the current date and time
        var currentDateTime = new Date();

        // Format the date and time
        var date = currentDateTime.toDateString();
        var time = currentDateTime.toLocaleTimeString();

        // Display the formatted date and time
        document.getElementById('dateTime').innerHTML = '<p>Date: ' + date + '</p><p>Time: ' + time + '</p>';
      }

      // Update the date and time every second
      setInterval(updateDateTime, 1000);

      // Initial call to display date and time immediately
      updateDateTime();
    </script>






    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>