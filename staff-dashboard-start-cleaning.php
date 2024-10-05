<?php
session_start();

// Include database connection file
include('config.php');// You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
  header("Location index.php");
  exit;
}

// Fetch user information based on ID
$userID = $_SESSION['user_id'];
$selected_id = $_GET['selected_id'];
$servicename_id = $_GET['servicename_id'];

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT * FROM users WHERE user_id = '$userID'";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$userData = mysqli_fetch_assoc($result);


$query = "SELECT ss.*, sn.service_name, u.firstname, u.lastname, ss.status
FROM service_details ss
INNER JOIN service_names sn ON ss.servicename_id = sn.servicename_id
INNER JOIN users u ON ss.user_id = u.user_id
WHERE ss.selected_id = '$selected_id' AND ss.servicename_id = '$servicename_id'";


// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$selectedData = mysqli_fetch_assoc($result);



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
  <link rel="icon" href="NEW SM LOGO.png" type="image/x-icon">
  <link rel="shortcut icon" href="NEW SM LOGO.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <title>SPARK MOBILE </title>
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
    --offcanvas-width: 220px;
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

  .v-2 {
    background-color: orangered;
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

  .game-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 15px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
  }

  .game-logo {
    width: 80px;
    height: 80px;
    border-radius: 16px;
  }

  .ratings .star {
    color: gold;
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
            <a href="csnotification.php" class="nav-link px-3">
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
          <h5 class="text-center">Welcome back <?php echo $userData['firstname']; ?>!</h5>
        </div>
        <div class="ms-3" id="dateTime"></div>
        </li>
        <li>
        <li class="v-1">
          <a href="staff-dashboard.php" class="nav-link px-3">
            <span class="me-2"><i class="fas fa-home"></i></i></span>
            <span class="start">DASHBOARD</span>
          </a>
        </li>
        <li class="">
          <a href="staff-profile.php" class="nav-link px-3">
            <span class="me-2"><i class="fas fa-user"></i></i></span>
            <span class="start">PROFILE</span>
          </a>
        </li>
        <li>

        <li class="">
          <a href="owner-shop-profile1.php" class="nav-link px-3">
            <span class="me-2"><i class="fas fa-calendar"></i></i></span>
            <span>HISTORY</span>
          </a>
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
    <div class="personal-details text-dark">
      <div class="container py-5">
        <div class="row">
          <div class="col-12">
            <h2 class="text-black"><?php echo $selectedData['service_name']; ?></h2>
            <hr class="mt-0 mb-4">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mx-auto">
            <!-- Form to display service details and accept -->
            <form action="staff-dashboard-start-cleaning-backend.php" method="POST">
              <!-- Hidden inputs -->
              <input type="hidden" name="selected_id" value="<?php echo $selectedData['selected_id']; ?>">
              <input type="hidden" name="vehicle_id" value="<?php echo $selectedData['vehicle_id']; ?>">
              <input type="hidden" name="servicename_id" value="<?php echo $selectedData['servicename_id']; ?>">
              <input type="hidden" name="user_id" value="<?php echo $selectedData['user_id']; ?>">
              <input type="hidden" name="is_deleted" id="is_deleted" value="0">
              <input type="hidden" name="status" id="status" value="<?php echo $selectedData['status'];?>">

              <!-- Service field -->

              <div class="mb-3">
              <strong><label for="services" class="form-label">Name</label></strong>
                <input type="text" class="form-control" id="services" name="services" value="<?php echo $selectedData['firstname']; ?> <?php echo $selectedData['lastname']; ?>" readonly>
              </div>

              <div class="mb-3">
                <strong><label for="services" class="form-label">Service</label></strong>
                <input type="text" class="form-control" id="services" name="services" value="<?php echo $selectedData['services']; ?>" readonly>
              </div>

              <!-- Price field -->
              <div class="mb-3">
                <strong><label for="prices" class="form-label">Price (₱)</label></strong>
                <input type="text" class="form-control" id="prices" name="price" value="<?php echo $selectedData['price']; ?>" readonly>
              </div>

              <!-- Total Price field -->
              <div class="mb-3">
                <strong><label for="total_price" class="form-label">Total Price (₱)</label></strong>
                <input type="text" class="form-control" id="total_price" name="total_price" value="<?php echo $selectedData['total_price']; ?>.00" readonly>
              </div>

              <div class="form-group mb-3 text-dark">
                                <label for="timer">Timer:</label>
                                <span id="timer" class="timer-display text-dark">00:00:00</span>
                                <input type="hidden" id="timer_input" name="timer" value="00:00:00">
                            </div>


                            <button id="startBtn" type="button" class="btn btn-primary btn-md mb-3">Start</button>
                            <button id="finishBtn" type="submit" class="btn btn-danger btn-md mb-3">Finish</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var timerInterval;
            var startTime;
            var elapsedTime = 0;
            var running = false;

            // Function to start the timer
            function startTimer() {
                startTime = Date.now() - elapsedTime;
                timerInterval = setInterval(updateTimer, 1000);
                running = true;
            }

            // Function to update the timer display
            function updateTimer() {
                var currentTime = Date.now();
                elapsedTime = currentTime - startTime;
                var formattedTime = new Date(elapsedTime).toISOString().substr(11, 8);
                $('#timer').text(formattedTime);
                $('#timer_input').val(formattedTime); // Update the hidden input field with the timer value
            }

            // Function to stop the timer
            function stopTimer() {
                clearInterval(timerInterval);
                running = false;
            }

            // Event listener for start button click
            $('#startBtn').click(function() {
                if (!running) {
                    startTimer();
                }
            });

            // Event listener for finish button click
            $('#finishBtn').click(function() {
                if (running) {
                    stopTimer();
                }
            });
        });
    </script>


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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>