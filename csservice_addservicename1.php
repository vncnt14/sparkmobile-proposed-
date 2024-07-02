<?php
session_start();
include('config.php');

// Retrieve and sanitize form data
$service_name = $_POST['service_name'];


// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO service_names (service_name) VALUES ('$service_name')";

if(mysqli_query($connection, $sql)) {
    echo '<script language="javascript">';
    echo 'alert("Service successfully added!");';
    echo 'window.location="csservice_adminview.php";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Error inserting service!");';
    echo 'window.location="csservice_adminview.php";';
    echo '</script>';
}
?>
