<?php
session_start();
include('config.php');

// Retrieve and sanitize form data
$user_id = $_POST['user_id'];
$shop_id = $_POST['shop_id'];
$shop_name = $_POST['shop_name'];
$shop_email = $_POST['shop_email'];
$shop_contact = $_POST['shop_contact'];
$website_link = $_POST['website_link'];
$operating_hours = $_POST['operating_hours'];
$description = $_POST['description'];
$street_address = $_POST['street_address'];
$optional_address = $_POST['optional_address'];
$barangay = $_POST['barangay'];
$city = $_POST['city'];
$province = $_POST['province'];
$postal = $_POST['postal'];

// Use prepared statements to prevent SQL injection
$stmt = $connection->prepare("UPDATE shops SET shop_name = ?, shop_email = ?, shop_contact = ?, website_link = ?, operating_hours = ?, description = ?, street_address = ?, optional_address = ?, barangay = ?, city = ?, province = ?, postal = ? WHERE shop_id = ?");
$stmt->bind_param("ssssssssssssi", $shop_name, $shop_email, $shop_contact, $website_link, $operating_hours, $description, $street_address, $optional_address, $barangay, $city, $province, $postal, $shop_id);

if ($stmt->execute()) {
    echo '<script language="javascript">';
    echo 'alert("Shop Profile successfully updated!");';
    echo 'window.location="owner-shop-profile1.php?user_id=' . $user_id . '";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Error updating profile!");';
    echo 'window.location="owner-shop-profile-edit.php";';
    echo '</script>';
}

// Close the statement
$stmt->close();

// Close the connection
$connection->close();
?>
