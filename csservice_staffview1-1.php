<?php
// Include your database connection file
include('config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $selected_id = $_POST['selected_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $servicename_id = $_POST['servicename_id'];

    // Update the status column in the vehicles table
    $query = "UPDATE vehicles SET status = 'Currently Washing' WHERE vehicle_id = $vehicle_id";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        // Redirect the user to another page
        ?>
        <script>
            // Retrieve the selected_id from the form and append it to the URL
            var selected_id = "<?php echo $selected_id; ?>";
            var servicename_id = "<?php echo $servicename_id; ?>";
            window.location.href = 'csservice_staffview2.php?selected_id=' + selected_id + '&servicename_id=' + servicename_id;
        </script>
        <?php
    } else {
        echo "Error updating status: " . mysqli_error($connection);
    }

    // Close database connection
    mysqli_close($connection);
}
?>
