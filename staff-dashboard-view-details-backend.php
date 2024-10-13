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
    $slotNumber = $_POST['slotNumber'];
    $inventory_id = $_POST['inventory_id'];
    $quantity = (int)$_POST['quantity']; // Ensure quantity is treated as an integer

    // Update the status column in the vehicles table
    $query = "UPDATE vehicles SET status = 'Currently Washing' WHERE vehicle_id = $vehicle_id";
    $status_query = "UPDATE service_details SET status = 'Finish' WHERE vehicle_id = $vehicle_id";
    $queuing_query = "UPDATE queuing_slots SET is_serving = 1 WHERE slotNumber = $slotNumber";
    
    // Correct the inventory query to subtract quantity from stock_size
    $inventory_query = "UPDATE inventory_records SET stock_size = stock_size - $quantity WHERE inventory_id = '$inventory_id'";

    // Execute the queuing query
    if (mysqli_query($connection, $queuing_query)) {
        // Execute the first query for updating vehicle status
        if (mysqli_query($connection, $query)) {
            // Execute the second query for updating service details status
            if (mysqli_query($connection, $status_query)) {
                // Execute the inventory query to update stock size
                if (mysqli_query($connection, $inventory_query)) {
                    // If all queries are successful, redirect the user
                    ?>
                    <script>
                        var selected_id = "<?php echo $selected_id; ?>";
                        var servicename_id = "<?php echo $servicename_id; ?>";
                        var user_id = "<?php echo $user_id; ?>";
                        window.location.href = 'staff-dashboard-start-cleaning.php?selected_id=' + selected_id + '&servicename_id=' + servicename_id + '&user_id=' + user_id;
                    </script>
                    <?php
                } else {
                    // Error in updating the inventory stock size
                    echo "Error updating inventory stock size: " . mysqli_error($connection);
                }
            } else {
                // Error in updating the service details status
                echo "Error updating service status: " . mysqli_error($connection);
            }
        } else {
            // Error in updating the vehicle status
            echo "Error updating vehicle status: " . mysqli_error($connection);
        }
    } else {
        echo "Error updating queuing slot number: " . mysqli_error($connection);
    }   

    // Close database connection
    mysqli_close($connection);
}
?>
