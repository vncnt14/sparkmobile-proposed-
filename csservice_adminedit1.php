<?php
session_start();
include('config.php');

// Retrieve and sanitize form data
$id = $_POST['id'];
$service_name = $_POST['service_name'];
$services = $_POST['services'];
$price = $_POST['price'];

// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO services (servicename_id, service_name, services, price) VALUES ('$id', '$service_name', '$services', '$price')";

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
