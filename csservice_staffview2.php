<?php
session_start();

// Include database connection file
include('config.php'); // You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location index.php");
    exit;
}

// Fetch user information based on ID

$selected_id = $_GET['selected_id'];
$servicename_id = $_GET['servicename_id'];

$query = "SELECT ss.*, sn.service_name
          FROM select_service ss
          INNER JOIN service_names sn ON ss.servicename_id = sn.servicename_id WHERE is_deleted = '0'";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$selectedData = mysqli_fetch_assoc($result);



// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPARK MOBILE</title>
    <link rel="icon" href="NEW SM LOGO.png" type="image/x-icon">
    <link rel="shortcut icon" href="NEW SM LOGO.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>
<style>
    .timer-display {
        font-size: 24px;
        /* Adjust the font size as needed */
        font-weight: bold;
        /* Optionally, make the font bold */
        color: #333;
        /* Optionally, change the font color */
    }
</style>

<body>

    <!-- Header -->
    <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
        <div class="container bootstrap snippets bootdey">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-toggle"></span>
                </button>
                <a class="navbar-brand" href="#">SPARK MOBILE</a>
            </div>
        </div><!-- /container -->
    </div>
    <!-- /Header -->

    <!-- Main -->
    <div class="container bootstrap snippets bootdey">
        <!-- upper section -->
        <div class="row">
            <div class="col-md-3">
                <!-- left -->
                <a href="csdashboard_admin.php"><strong><i class="glyphicon glyphicon-briefcase"></i> Home</strong></a>
                <hr>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="csservice_staffview.php"><i class="glyphicon glyphicon-plus"></i>Check Services</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-link"></i> Links</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Reports</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-book"></i> Books</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Tools</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-time"></i> Real-time</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Advanced..</a></li>
                    <li><a href="logout.php"><i class="glyphicon glyphicon-lock"></i> LogOut</a></li>
                </ul>

                <hr>
            </div><!-- /span-3 -->
            <!-- main content -->
            <main class="col-md-4">
                <div class="container">
                    <h1><?php echo $selectedData['service_name']; ?></h1>
                    <form id="timerForm" action="csservice_staffview3.php" method="POST">
                        <input type="hidden" name="is_deleted" id="is_deleted" value="0">
                        <input type="hidden" name="selected_id" id="selected_id" value="<?php echo $selectedData['selected_id']; ?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $selectedData['user_id']; ?>">
                        <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $selectedData['vehicle_id']; ?>">
                        <input type="hidden" name="servicename_id" id="servicename_id" value="<?php echo $selectedData['servicename_id']; ?>">
                        <div class=" col-md-4 mb-4">
                            <div class="form-group mb-3 text-dark">
                                <label for="services">Service:</label>
                                <input type="text" class="form-control" id="services" name="services" value="<?php echo $selectedData['services']; ?>" readonly>
                            </div>

                            <!-- Plate Number and Chassis Number -->

                            <div class="form-group mb-3 text-dark">
                                <label for="price">Price ₱: </label>
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $selectedData['price']; ?>" readonly>
                            </div>
                            <div class="form-group mb-3 text-dark">
                                <label for="total_price">Total Price ₱:</label>
                                <input type="text" class="form-control" id="total_price" name="total_price" value="<?php echo $selectedData['total_price']; ?>.00" readonly>
                            </div>

                            <div class="form-group mb-3 text-dark">
                                <label for="timer">Timer:</label>
                                <span id="timer" class="timer-display">00:00:00</span>
                                <input type="hidden" id="timer_input" name="timer" value="00:00:00">
                            </div>


                            <button id="startBtn" type="button" class="btn btn-primary btn-md mb-3">Start</button>
                            <button id="finishBtn" type="submit" class="btn btn-danger btn-md mb-3">Finish</button>
                        </div>
                        <!-- Engine Number and Vehicle Type -->
                    </form>
                </div>
            </main>

        </div>
    </div>

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
</body>

</html>