<?php
// Database connection
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store form data
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $amount = isset($_POST['modalAmount']) ? $_POST['modalAmount'] : '';
    $totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : '';

    // Convert amount and total price to float
    $amount = floatval($amount);
    $totalPrice = floatval($totalPrice);

    // Calculate change
    $change = $amount - $totalPrice;

    // Prepare and execute the SQL statement
    $insert_query = "INSERT INTO payment_details (user_id, amount, change_amount, payment_method, date) VALUES (?, ?, ?, ?, ?)";
    $update_query = "UPDATE servicedone SET is_deleted = '1' WHERE user_id = ?";
    
    $stmt_insert = mysqli_prepare($connection, $insert_query);
    $stmt_update = mysqli_prepare($connection, $update_query);

    if ($stmt_insert && $stmt_update) {
        // Bind parameters for insertion
        mysqli_stmt_bind_param($stmt_insert, 'issss', $user_id, $amount, $change, $payment_method, $date);

        // Bind parameter for update
        mysqli_stmt_bind_param($stmt_update, 'i', $user_id);

        // Execute insertion
        if (mysqli_stmt_execute($stmt_insert)) {
            // Execute update
            mysqli_stmt_execute($stmt_update);

            $query = $query = "SELECT 
                co.*, 
                pd.*, 
                sd.*
                FROM 
                payment_details pd
                LEFT JOIN 
                carowners co ON co.user_id = pd.user_id
                LEFT JOIN 
                servicedone sd ON co.user_id = sd.user_id WHERE sd.user_id = '$user_id'";

                $result = mysqli_query($connection, $query);

                // Check if the query was successful
                if (!$result) {
                    die("Error: " . mysqli_error($connection));
                }

                // Fetch the data
                $invoiceData = mysqli_fetch_assoc($result);

                $query2 ="SELECT *FROM payment_details WHERE user_id = '$user_id'";
                $result2 = mysqli_query($connection, $query2);
                $paymentData = mysqli_fetch_assoc($result2);

                // Close the database connection
                mysqli_close($connection);
            
            echo '<script>alert("Payment successfull.");</script>';
            echo '<script>window.location.href = "cspayment_managerview2.php?user_id=' . $user_id . '";</script>';
        } else {
            echo "Error: Unable to execute insertion.<br>" . mysqli_error($connection);
        }

        // Close statements
        mysqli_stmt_close($stmt_insert);
        mysqli_stmt_close($stmt_update);
    } else {
        echo "Error: Unable to prepare statements.<br>" . mysqli_error($connection);
    }

    // Close connection
    mysqli_close($connection);
} else {
    echo "Form submission failed";
}
?>
