<?php
session_start();
include('config.php');

// Check if form fields are set and not empty
$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$item_code = isset($_POST['item_code']) ? $_POST['item_code'] : '';
$stock_size = isset($_POST['stock_size']) ? $_POST['stock_size'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : 0.00;
$shop_id = isset($_POST['shop_id']) ? $_POST['shop_id'] : '';

// Check if a file has been uploaded
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
    // Read the uploaded file as binary data
    $photo = file_get_contents($_FILES['photo']['tmp_name']);
} else {
    $photo = null; // Set to null if no photo is uploaded
    echo "No photo uploaded. Error code: " . $_FILES['photo']['error'];
}

// Ensure all required fields are filled
if ($product_name && $description && $category && $item_code && $stock_size && $price && $photo) {
    // Prepare the SQL query using prepared statements to avoid SQL injection
    $product_query = "INSERT INTO inventory_records (shop_id, product_name, description, category, item_code, stock_size, price, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($connection, $product_query)) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 'isssiiib', $shop_id, $product_name, $description, $category, $item_code, $stock_size, $price, $photo);
        
        // Send the binary data as a parameter to the prepared statement
        mysqli_stmt_send_long_data($stmt, 7, $photo); // Send photo as BLOB

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Product successfully added!');</script>";
            echo "<script>window.location.href='owner-dashboard-inventory-cleaning-products.php?shop_id={$shop_id}';</script>";
        } else {
            echo "Error adding product: " . mysqli_stmt_error($stmt); // More specific error handling
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($connection);
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>Please fill in all required fields and upload a photo.</div>";
}

// Close the database connection
mysqli_close($connection);
?>
