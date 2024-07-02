<?php
include('config.php');

// Assuming you have a database connection established already

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted
    if(isset($_POST['selected_services']) && !empty($_POST['selected_services'])) {
        // Get user and vehicle IDs from the form
        $user_id = $_POST['user_id'];
        $vehicle_id = $_POST['vehicle_id'];
        $servicename_id = $_POST['servicename_id'];
        $status = $_POST['status'];
        $is_deleted = $_POST['is_deleted'];

        // Initialize total price
        $totalPrice = 0;

        // Loop through the selected services array
        // Loop through the selected services array
foreach($_POST['selected_services'] as $service_id) {
    // Get the index of the selected service
    $index = array_search($service_id, $_POST['selected_services']);

    // Get the corresponding service and price from the arrays
    $service = isset($_POST['services'][$index]) ? $_POST['services'][$index] : 'Service Name';
    $price = isset($_POST['prices'][$index]) ? $_POST['prices'][$index] : 0;

    // Increase total price
    $totalPrice += $price;

    // Insert each selected service into the database
    $query = "INSERT INTO select_service (user_id, vehicle_id, servicename_id, services, price, total_price, status, is_deleted) VALUES ('$user_id', '$vehicle_id', '$servicename_id', '$service', '$price', '$totalPrice', '$status', $is_deleted)";
    $result = mysqli_query($connection, $query);

    // Check if the insertion was successful
    if(!$result) {
        // Handle insertion error
        echo '<p class="text-danger">Error: ' . mysqli_error($connection) . '</p>';
    }
}

        
        if($result) {
            // Redirect to the view page
            header("Location: csservice_view.php?user_id=$user_id&vehicle_id=$vehicle_id");
            exit; // Make sure to exit after redirection
        } else {
            // Handle insertion error
            echo '<p class="text-danger">Error: Failed to insert service data.</p>';
        }
    } else {
        // No services selected error message
        echo '<p class="text-danger">Please select at least one service.</p>';
    }
}
?>
