<?php
// Include your database connection file
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data from the POST request
    $servicename_id = $_POST['servicename_id'];
    $shop_id = $_POST['shop_id'];
    $user_id = $_POST['user_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price']. '';
    $category = $_POST['category'];
    $profile = $_POST['profile']; 

    // Prepare the SQL query to update data in the database
    $sql = "UPDATE service_details SET product_name = ?, category = ?, profile = ?, product_price = ? WHERE user_id = ?";

    // Check if the prepared statement is successful
    if ($stmt = mysqli_prepare($connection, $sql)) {
        // Bind the parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "ssssi", $product_name, $category, $profile, $product_price, $user_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo '<script>
            alert("Product added successfully!");
            window.location.href = "csservice_view.php?user_id=' . $user_id . '&servicename_id=' . $servicename_id . '&vehicle_id=' . $vehicle_id . '&shop_id=' . $shop_id . '";
          </script>';
            } else {
                echo "No records were updated.";
            }
        } else {
            // If execution fails, display the error
            echo "Error: " . mysqli_error($connection);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // If statement preparation fails, display the error
        echo "Error: Could not prepare the SQL statement.";
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
