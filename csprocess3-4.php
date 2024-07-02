<?php
session_start();

// Include database connection file
include('config.php');  // You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Fetch user information based on ID
$userID = $_SESSION['user_id'];
$vehicle_id = $_GET['vehicle_id'];
$vehicleID = $_SESSION['vehicle_id'];
$servicename_ID = $_SESSION['servicename_id'];

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT * FROM vehicles WHERE vehicle_id = '$vehicle_id'";
// Execute the query and fetch the user text
$result = mysqli_query($connection, $query);
$vehicleData = mysqli_fetch_assoc($result);


$query1 = "SELECT *FROM service_names";
$result1 = mysqli_query($connection, $query1);




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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>DIRT TECH</title>
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
li :hover{
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
  background-color: #072797;
}
.nav-links ul li:hover a {
  color: white;
}
.section{
  margin-left: 200px;
}
.text-box {
  padding: 6px 6px 6px 230px;
  background: orangered;
  border-radius: 10px;
  width: 50%;
  height: auto;
  position: absolute;
  top: 20%;
  left: 30%;
}
.text-box .btn {
  background-color: #072797;
  text-decoration: none;
  width: 58%;

}
.container-vinfo{
  margin-left: 20px
}
.v-3{
  font-weight: bold;
  font-size: xx-large;
}
.my-5{
  margin-left: -20px;
}
.ex-1 {
      color: red;
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
                <a href="csnotification.php" class="nav-link px-3">
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
                <li class="">
                    <a href="csdashboard.php" class="nav-link px-3">
                      <span class="me-2"><i class="fas fa-user"></i></i></span>
                      <span class="start">PROFILE</span>
                    </a>
                </li>
                
            <li>
              <a href="cscars1.php" class="nav-link px-3">
                <span class="me-2"><i class="fas fa-car"></i></i></span>
                <span>MY CARS</span>
              </a>
            </li>
            <li class="v-1">
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
                </li>
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
                        <a href="#" class="nav-link px-3">
                        <span class="me-2"
                          >Request Slot</span>
                        </a>
                    </li>
                    <li class="v-1 v-2">
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
            <li>
                <a href="csreward.html" class="nav-link px-3">
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
      <div class="container-vinfo text-dark">
        <h2 class="mb-2 offset-md-4">Select Services</h2>
        <p class="col-md-4 offset-md-4">select carwash service for</p>
        <?php
          if ($result) {
              // Check if there are any vehicles for the user
              if (mysqli_num_rows($result) > 0) {
                  echo '<h2 class="mb-2"></h2>';
                  echo '<div class="form-group mt-4 col-md-4 offset-md-3">';
                  echo '<label for="platenumber" class="form-label">Plate Number</label>';
                  echo '<input type="text" class="form-control mb-3" id="platenumber" name="platenumber" value="' . $vehicleData['platenumber'] . '" disabled>';
                


                  // Store the fetched data in an array
                  $vehiclesData = array();
                  while ($row = mysqli_fetch_assoc($result)) {
                      $vehiclesData[] = $row;
                      echo '<option value="' . $row['platenumber'] . '">' . $row['platenumber'] . '</option>';
                  }

                  echo '</select>';
                  echo '</div>';
                  // Rest of your HTML code...
              } else {
                  echo '<p>No vehicles found, Register your cars first in MY CARS section.</p>';
              }
          } else {
              // Handle the case where the query fails
              echo '<p>Error: ' . mysqli_error($connection) . '</p>';
          }
        ?>



    <div class="my-5 container-vinfo text-dark">
    <form action="csprocess3_deleteslot.php" method="post">
      <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicleData['vehicle_id'];?>">
      <input type="hidden" name="user_id" id="user_id" value="<?php echo $vehicleData['user_id'];?>">
    </form>

    
    <script>
      function startCountdown(duration, display) {
          var timer = duration;
          setInterval(function () {
              var seconds = timer % 60;

              seconds = seconds < 10 ? "0" + seconds : seconds;

              display.textContent = "Your slot number will expire in 00:" + seconds;

              if (--timer < 0) {
                  timer = 0; // Ensure timer does not go below 0
                  display.style.display = "none"; // Hide countdown display
                  document.getElementById('expiredMessage').style.display = "block"; // Show expired message
              }
          }, 1000);

          // Call alertWithButton() when the timer reaches zero
          setTimeout(alertWithButton, duration * 1000);
      }

      window.onload = function () {
          var tenSeconds = 10; // 10 seconds
          var display = document.querySelector('#countdown');
          startCountdown(tenSeconds, display);
      };

      function alertWithButton() {
    // Create a custom dialog
    var confirmation = confirm("Your slot number has expired. Please request another slot number.");
    var user_id = document.getElementById("user_id").value;
    var vehicle_id = document.getElementById("vehicle_id").value;
    if (confirmation) {
        // Call function to delete slot number if the user confirms expiration
        deleteSlot();
        // Redirect the user to csrequest_slot.php
        window.location.href = 'csrequest_slot.php?user_id=' + user_id + '&vehicle_id=' + vehicle_id;
    } else {
        // Handle cancellation if needed
    }
}

      function deleteSlot() {
          var vehicle_id = document.getElementById("vehicle_id").value;
          var user_id = document.getElementById("user_id").value;

          // You can use AJAX to send a request to the PHP script to delete the slot number
          // Example AJAX code:
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "csprocess3_deleteslot.php", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                  // Check if deletion was successful
                  if (xhr.responseText.trim() == "Slot number deleted successfully") {
                      // Redirect the user after successful deletion
                  } else {
                      // Handle deletion failure if needed
                      console.log("Slot deletion failed");
                  }
              }
          };
          xhr.send("vehicle_id=" + vehicle_id + "&user_id=" + user_id);
      }

    </script>

    




<h2 class="mb-2 ms-5">Choose Services</h2>
<div class="container mx-auto mt-5">
    <form action="" method="">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $userID; ?>">
        <input type="hidden" id="vehicle_id" name="vehicle_id" value="<?php echo $vehicleData['vehicle_id'];?>">
        
        <!-- Collapsible container -->
        <div class="accordion" id="serviceAccordion">
        <?php
          if ($result1) {
              echo '<div class="table-responsive">';
              echo '<table class="table">';
              echo '<thead>';
              echo '<tr>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody>';

              foreach ($result1 as $row) {
                  echo '<tr>';
                  echo '<td>' . (isset($row['service_name']) ? $row['service_name'] : 'Service Name') . '</td>';
                  echo '<td class="text-center"><a href="csprocess3.3.php?vehicle_id=' . (isset($vehicleData['vehicle_id']) ? $vehicleData['vehicle_id'] : '') . '&servicename_id=' . (isset($row['servicename_id']) ? $row['servicename_id'] : '') . '&user_id=' . (isset($vehicleData['user_id']) ? $vehicleData['user_id'] : '') . '" class="btn btn-primary btn-md">View Services</a></td>'; // Aligning the button to center
                  echo '</tr>';
              }

              echo '</tbody>';
              echo '</table>';
              echo '</div>';
          } else {
              echo '<p class="text-danger">Error: ' . mysqli_error($connection) . '</p>';
          }
        ?>



        </div>
        <!-- End of collapsible container -->

    </form>
</div>



    </div>
            

            
                    <script>
                      // Convert the PHP array to a JavaScript array
                      var vehiclesData = <?php echo json_encode($vehiclesData); ?>;

                      // Function to update the displayed information based on the selected option
                      function updateDisplay() {
                          // Get the selected value from the dropdown
                          var selectedPlateNumber = document.getElementById("platenumber").value;

                          // Find the matching vehicle in the JavaScript array
                          var selectedVehicle = vehiclesData.find(function (vehicle) {
                              return vehicle.platenumber === selectedPlateNumber;
                          });

                          // Update the displayed information
                          document.getElementById("label").value = selectedVehicle.label;
                          document.getElementById("model").value = selectedVehicle.model;
                          document.getElementById("chassisnumber").value = selectedVehicle.chassisnumber;
                          document.getElementById("enginenumber").value = selectedVehicle.enginenumber;
                          document.getElementById("color").value = selectedVehicle.color;
                          // Update other fields similarly
                      }
                    </script>
          
            

          <script>
              document.getElementById('date').addEventListener('change', function () {
                  var selectedDate = new Date(this.value);
                  var slotNumber = selectedDate.getHours(); // Use any logic to determine the slot number
                  document.getElementById('slotnumber').value = slotNumber;
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
            
      
      
    </main>
    </script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
