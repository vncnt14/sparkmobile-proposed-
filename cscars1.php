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
$userID = $_SESSION['user_id'];
$vehicleID = $_SESSION['vehicle_id'];

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT * FROM vehicles WHERE user_id = '$userID'";
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
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
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
  margin-top:20px;
  background-color:#fff;
  color:#fff;
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


.welcome{
    font-size: 15px;
    text-align: center;
    margin-top: 20px;
    margin-right: 15px;
}
.me-2{
  color: #fff;
  font-weight: normal;
  font-size: 13px;

}
.me-2:hover{
  background: orangered;
}
span{
  color: #fff;
  font-weight: bold;
  font-size: 20px;
}
img{
  width: 30px;
  border-radius: 50px;
  display: block;
  margin: auto;

}
.img-account-profile{
  width: 300px; /* Adjust the size as needed */
  height: 150px;
  object-fit: cover;
  border-radius: 10%;
}
li:hover{
  background: #072797;
}
.v-1{
  background-color: #072797;
  color: #fff;
}
.v-2{
  background-color: orangered;
}
.main {
  margin-left: 200px;
}
.form-group{
  color: black;
}
.dropdown-item:hover{
  background-color: orangered;
  color: #fff;
}
.my-4:hover{
  background-color: #fff;
}
.navbar{
  background-color: #072797;
}
.btn:hover{
  background-color: orangered;
}
.nav-links ul li:hover a {
  color: white;
}
  </style>

  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="smweb.html"
          ><img src="NEW SM LOGO.png" alt=""></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <li class="">
                <a href="csnotification.html" class="nav-link px-3">
                  <span class="me-2"><i class="fas fa-bell"></i></i></span>
                </a>
              </li>
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
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
    <li class="my-4"><hr class="dropdown-divider bg-primary" /></li>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav"
      tabindex="-1"
      id="sidebar"
      
    
      <div class="offcanvas-body p-0">
        <nav class="">
          <ul class="navbar-nav">
            
            
              <div class=" welcome fw-bold px-3 mb-3">
              <h5 class="text-center">Welcome back <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>!</h5>
              </div>
              <div class="ms-3"id="dateTime"></div>
            </li>
            <li>
                <li>
                    <a href="csdashboard.php" class="nav-link px-3">
                      <span class="me-2"><i class="fas fa-user"></i></i></span>
                      <span class="start">PROFILE</span>
                    </a>
                  </li>
                <li>
              
            <li class="v-1">
              <a href="cscars1.php" class="nav-link px-3">
                <span class="me-2"><i class="fas fa-car"></i></i></span>
                <span>MY CARS</span>
              </a>
            </li>
            <li>
            <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts">
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
                        <span class="me-2"
                          >Set Appointment</span>
                        </a>
                    </li>  
                    <li class="v-1">
                        <a href="checkingcar.php" class="nav-link px-3">
                        <span class="me-2"
                            >Checking car condition</span>
                        </a>
                    </li>
                    <li class="v-1">
                        <a href="csrequest_slot.php" class="nav-link px-3">
                        <span class="me-2"
                          >Request Slot</span>
                        </a>
                    </li>
                    <li class="v-1">
                      <a href="csprocess3.php" class="nav-link px-3">
                      <span class="me-2"
                        >Select Service</span>
                      </a>
                   </li>
                    <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Register your car</span>
                    </a>
                  </li>
                    <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Booking Summary</span>
                  </a>
                  </li>
                  <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Booking History</span>
                    </a>
                  </li>
                    </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts2">
                <span class="me-2"><i class="fas fa-money-bill"></i>
                </i></i></span>
                <span>PAYMENTS</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
            </li> 
              <div class="collapse" id="layouts2">
                <ul class="navbar-nav ps-3">
                  <li class="v-1">
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                      >Payment options</span>
                    </a>
                  </li>
                  <li class="v-1">
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                      >Car wash invoice</span>
                    </a>
                  </li>
                  <li class="v-1">
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                      >Payment History</span>
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
                      <h2 class="text-black">Vehicle Details</h2>
                      <!-- Account page navigation-->
                      <hr class="mt-0 mb-4">
                      <div class="row">
                         
                          <!-- Label Dropdown -->
                          <div class="col-md-12 mb-4 text-dark">
                              <table class=" table table-bordered border-gray">
                                  <thead class="v-2 text-light">
                                      <tr>
                                          <th scope="col">Label</th>
                                          <th scope="col">Profile</th>
                                          <th scope="col">Plate Number</th>
                                          <th scope="col">Chassis Number</th>
                                          <th scope="col">Engine Number</th>
                                          <th scope="col">Brand</th>
                                          <th scope="col">Model</th>
                                          <th scope="col">Color</th>
                                          
                                        <th scope="col-md-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <!-- Inside the <tbody> section -->
                                  <?php
                                    if ($result) {
                                        foreach ($result as $row) {
                                            echo '<tr>';
                                            echo '<td>' . (isset($row['label']) ? $row['label'] : 'label') . '</td>';
                                            echo '<td><img src="' . (isset($row['profile']) ? $row['profile'] : 'profile') . '" alt="Profile Image" style="width: 100px; height: auto;"></td>';
                                            echo '<td>' . (isset($row['platenumber']) ? $row['platenumber'] : 'N/A') . '</td>';
                                            echo '<td>' . (isset($row['chassisnumber']) ? $row['chassisnumber'] : 'N/A') . '</td>';
                                            echo '<td>' . (isset($row['enginenumber']) ? $row['enginenumber'] : 'N/A') . '</td>';
                                            echo '<td>' . (isset($row['brand']) ? $row['brand'] : 'brand') . '</td>';
                                            echo '<td>' . (isset($row['model']) ? $row['model'] : 'model') . '</td>';
                                            echo '<td>' . (isset($row['color']) ? $row['color'] : 'color') . '</td>';
                                            // Displaying status as a button
                                            echo '<td><a href="cscars2.php?vehicle_id=' . (isset($row['vehicle_id']) ? $row['vehicle_id'] : '') . '" class="btn btn-primary">Edit</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="9">Error: ' . mysqli_error($connection) . '</td></tr>';
                                    }
                                  ?>



                                </tbody>
                            </table>
                            <div class="offset-md-6">
                              <a href="cscar_register.php"><button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#editModal">Add Vehicles</button></a>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>

</main>
                      <script>
                        function submitForm() {
                        // Get the form element
                        const form = document.getElementById('editVehicleForm');

                        // Submit the form
                        form.submit();
                        }
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
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
