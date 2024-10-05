<?php
// Include your database connection file
include('config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $selected_id = $_POST['selected_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $servicename_id = $_POST['servicename_id'];
    $user_id = $_POST['user_id'];

    // Update the status column in the vehicles table
    $query = "UPDATE vehicles SET status = 'Currently Washing' WHERE vehicle_id = $vehicle_id";
    $status_query = "UPDATE service_details SET status = 'Finish' WHERE selected_id = $selected_id";

    // Execute the first query for updating vehicle status
    if (mysqli_query($connection, $query)) {
        // Execute the second query for updating service details status
        if (mysqli_query($connection, $status_query)) {
            // If both queries are successful, redirect the user
            ?>
            <script>
                var selected_id = "<?php echo $selected_id; ?>";
                var servicename_id = "<?php echo $servicename_id; ?>";
                var user_id = "<?php echo $user_id; ?>";
                window.location.href = 'staff-dashboard-start-cleaning.php?selected_id=' + selected_id + '&servicename_id=' + servicename_id + '&user_id=' + user_id;
            </script>
            <?php
        } else {
            // Error in updating the service details status
            echo "Error updating service status: " . mysqli_error($connection);
        }
    } else {
        // Error in updating the vehicle status
        echo "Error updating vehicle status: " . mysqli_error($connection);
    }

    // Close database connection
    mysqli_close($connection);
}
?>
