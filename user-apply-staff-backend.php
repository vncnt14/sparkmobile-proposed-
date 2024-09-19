<?php
session_start();
include('config.php');


$user_id = $_POST['user_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$position = $_POST['position'];
$interviewdate = $_POST['interviewdate'];


$coverletter = file_get_contents($_FILES['coverletter']['tmp_name']);
$resume = file_get_contents($_FILES['resume']['tmp_name']);
$otherdocuments = file_get_contents($_FILES['otherdocuments']['tmp_name']);

$stmt = $connection->prepare("INSERT INTO application (user_id, firstname, lastname, email, contact, position, interviewdate, coverletter, resume, otherdocuments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if($stmt === false){
    die("Error preparing statement: ". $connection->error);
}

$stmt->bind_param("issssssbbb", $user_id, $firstname, $lastname, $email, $contact, $position, $interviewdate, $coverletter, $resume, $otherdocuments);

if ($stmt->execute()) {
    echo '<script language="javascript">';
    echo 'alert("Application Submitted!");';
    echo 'window.location="user-apply-staff.php?user_id=' . $user_id . '";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Application Error!");';
    echo 'window.location="user-apply-staff.php?user_id=' . $user_id . '";';
    echo '</script>';
}

$stmt->close();

$connection->close();
?>