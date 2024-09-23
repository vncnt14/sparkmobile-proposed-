<?php
session_start();
include('config.php');

// Get form data
$user_id = $_POST['user_id'];
$shop_id = $_POST['shop_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$position = $_POST['position'];
$interviewdate = $_POST['interviewdate'];


// Prepare the SQL statement
$stmt = $connection->prepare("INSERT INTO application (user_id,shop_id, firstname, lastname, email, contact, position, interviewdate) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Error preparing statement: " . $connection->error);
}

// Bind parameters (use 'b' for BLOB data)
$stmt->bind_param(
    "iissssss", 
    $user_id,
    $shop_id, 
    $firstname, 
    $lastname, 
    $email, 
    $contact, 
    $position, 
    $interviewdate, 
    
);

// Execute the statement
if ($stmt->execute()) {
    echo '<script language ="javascript">';
    echo 'window.location="user-apply-staff-files.php?user_id=' . $user_id . '";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Application Error!");';
    echo 'window.location="user-apply-staff.php?user_id=' . $user_id . '";';
    echo '</script>';
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>
