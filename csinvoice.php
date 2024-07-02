<?php
session_start();
include ('config.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$userID = $_SESSION['user_id'];

// Use a JOIN query to fetch data from multiple tables
$query = $query = "SELECT 
co.*, 
pd.*, 
sd.*
FROM 
payment_details pd
LEFT JOIN 
carowners co ON co.user_id = pd.user_id
LEFT JOIN 
servicedone sd ON co.user_id = sd.user_id WHERE sd.user_id = '$userID'";

$result = mysqli_query($connection, $query);

// Check if the query was successful
if (!$result) {
    die("Error: " . mysqli_error($connection));
}

// Fetch the data
$invoiceData = mysqli_fetch_assoc($result);

$query2 ="SELECT *FROM payment_details WHERE user_id = 'user_id'";
$result2 = mysqli_query($connection, $query2);
$paymentData = mysqli_fetch_assoc($result2);

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
    li:hover{
    background: #072797;
    }
    .v-1{
    background-color: #d9d9d9;
    color: #fff;
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
    .section{
    margin-left: 200px;
    }
    .v-2{
    color: orangered;
    }
    .icon-v1{
    width: 50%;
    }
    .click-request{
      text-decoration: none;
      color: orangered;
    }
    @media (max-width: 320px) {
    .icon-v1 {
        max-width: 50%; /* Adjust the max-width for smaller image */
        margin-right: 2%; /* Adjust the margin as needed */
        margin-top: -10%; /* Adjust the margin as needed */
        float: left; /* Ensure the image stays on the left */
    }
  }
  .a-1{
    color: orangered;
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
                <a href="notifiation.html" class="nav-link px-3">
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
                  <a class="dropdown-item" href="index.php">Log out</a>
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
            </li>
            <li>
                <li class="">
                    <a href="csdashboard.php" class="nav-link px-3">
                      <span class="me-2"><i class="fas fa-user"></i></i></span>
                      <span class="start">PROFILE</span>
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
                        <a href="#" class="nav-link px-3">
                        <span class="me-2"
                          >Request Slot</span>
                        </a>
                    </li>
                    <li class="v-1">
                      <a href="#" class="nav-link px-3">
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
            <li class="">
              <a href="cars.php" class="nav-link px-3">
                <span class="me-2"><i class="fas fa-car"></i></i></span>
                <span>MY CARS</span>
              </a>
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
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                      >Payment options</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                      >Car wash invoice</span>
                    </a>
                  </li>
                  <li>
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
    <?php
    // Initialize an array to store all the invoice data
    $invoiceDataArray = array();

    // Fetch data from the database and store it in the array
    mysqli_data_seek($result, 0);
    while ($invoiceData = mysqli_fetch_assoc($result)) {
        $invoiceDataArray[] = $invoiceData;
    }

    // Calculate subtotal
    $subtotal = 0;
    foreach ($invoiceDataArray as $invoiceData) {
        $subtotal += $invoiceData['price'];
    }

    // Initialize amount paid (you can get this from form submission)
    $amountPaid = $invoiceData['amount'];

    // Calculate change only if amount paid is greater than or equal to subtotal
    if ($amountPaid >= $subtotal) {
        $change = $amountPaid - $subtotal;
    } else {
        $change = 0; // Set change to zero if amount paid is less than subtotal
    }
    ?>
    <div class="container mt-3">
        <div class="row">
            <h2 class="mb-4 text-center a-1">INVOICE</h2>
            <div class="col-md-6 text-dark mb-5">
                <h5>Invoice to:</h5>
                <p><?php echo isset($invoiceDataArray[0]['firstname']) ? $invoiceDataArray[0]['firstname'] : ''; ?> <?php echo isset($invoiceDataArray[0]['lastname']) ? $invoiceDataArray[0]['lastname'] : ''; ?></p>
                <p><?php echo isset($invoiceDataArray[0]['completeadd']) ? $invoiceDataArray[0]['completeadd'] : ''; ?></p>
                <p><?php echo isset($invoiceDataArray[0]['email']) ? $invoiceDataArray[0]['email'] : ''; ?></p>
            </div>
            <div class="col-md-6 text-dark mb-5">
                <h5>Invoice No: # <?php echo isset($invoiceDataArray[0]['total_price_id']) ? $invoiceDataArray[0]['total_price_id']: ''; ?></h5>
                <h5>Date: <?php echo isset($invoiceDataArray[0]['date']) ? $invoiceDataArray[0]['date'] : ''; ?></h5>
                <h5>Mode of Payment: <?php echo isset($invoiceDataArray[0]['payment_method']) ? $invoiceDataArray[0]['payment_method'] : ''; ?></h5>
            </div>
        </div>
    </div>

    <table class="table table-striped ms-2">
        <thead>
            <tr>
                <th>Services</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($invoiceDataArray as $invoiceData) {
            ?>
                <tr>
                    <td><?php echo $invoiceData['services']; ?></td>
                    <td>1</td> <!-- Set quantity to always be '1' -->
                    <td>₱<?php echo $invoiceData['price']; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2"></td>
                <td>
                    <div class="col-md-4 text-dark">
                        <p>SUBTOTAL: ₱<?php echo $subtotal; ?>.00</p>
                    </div>
                    <div class="col-md-4 text-dark">
                        <p>AMOUNT PAID: ₱<?php echo $invoiceData['amount']?>.00</p>
                    </div>
                    <div class="col-md-4 text-dark">
                        <p>CHANGE: ₱<?php echo $change; ?>.00</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</main>



          <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
