<?php

include_once('config.php');

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve vehicle_id and user_id from POST data
    $vehicle_id = $_POST['vehicle_id'];
    $user_id = $_POST['user_id'];
    
    // Validate input (optional)

    // Prepare and execute SQL statement to delete slot
    $sql = "DELETE FROM slots WHERE vehicle_id = ? AND user_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ii", $vehicle_id, $user_id); // Assuming both vehicle_id and user_id are integers
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
       
        
    } else {
     
    }

    // Close statement
    $stmt->close();
} else {
    // If the request method is not POST, handle the error accordingly
    echo "Error: Invalid request method";
}

// Close connection
$connection->close();
?>
