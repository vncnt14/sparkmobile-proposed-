<?php
// Include your database connection file
include('config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $servicename_id = $_POST['servicename_id'];
    $selected_id = $_POST['selected_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $user_id = $_POST['user_id'];
    $services = $_POST['services'];
    $price = $_POST['price'];
    $total_price = $_POST['total_price'];
    $timer = $_POST['timer'];
    $is_deleted = $_POST['is_deleted'];
    $slotNumber = $_POST['slotNumber'];


    // Soft delete data from the select_service table by updating a flag column
    $slotNumber_delete = "DELETE FROM queuing_slots WHERE slotNumber= '$slotNumber'";
    $soft_delete_query = "UPDATE service_details SET is_deleted = 1 WHERE vehicle_id = '$vehicle_id'";
    
    if(mysqli_query($connection, $slotNumber_delete)){
        echo "Slot Deleted succesfully";

    }else{
        echo "Error deleting record: " . mysqli_error($connection);
    }

    
    if (mysqli_query($connection, $soft_delete_query)) {
        // Update successful, now perform SQL query to insert data into the servicedone table
        $insert_query = "INSERT INTO finish_jobs (selected_id, vehicle_id, user_id, servicename_id, services, price, total_price, timer, is_deleted) 
                         VALUES ('$selected_id', '$vehicle_id', '$user_id', '$servicename_id', '$services', '$price', '$total_price', '$timer', '$is_deleted')";

        if (mysqli_query($connection, $insert_query)) {
            // Data inserted successfully
            echo '<script>alert("Service Finish.");</script>';
            // Redirect to a new page
            echo '<script>window.location.href = "staff-dashboard.php";</script>';
        } else {
            // Error occurred while inserting data into servicedone table
            echo '<script>alert("Error inserting data: ' . mysqli_error($connection) . '");</script>';
            // Redirect to a different page or stay on the same page
        }
    } else {
        // Error occurred while soft deleting data from select_service table
        echo '<script>alert("Error soft deleting data: ' . mysqli_error($connection) . '");</script>';
        // Redirect to a different page or stay on the same page
    }

    // Close database connection
    mysqli_close($connection);
}
?>
