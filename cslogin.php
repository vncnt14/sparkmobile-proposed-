<?php
include("config.php");

session_start();



if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password === $row["password"]) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['service_id'] = $row['service_id'];
            $_SESSION['selected_id'] = $row['selected_id'];
            $_SESSION['vehicle_id'] = $row['vehicle_id'];
            $_SESSION['slot_id'] = $row['slot_id'];
            $_SESSION['shopowner_id'] = $row['shopowner_id'];
            $_SESSION['servicename_id'] = $row['servicename_id'];
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'User') {
                header("Location: user-dashboard.php");
                exit();
            } elseif ($row['role'] === 'Admin') {
                header("Location: csdashboard_admin.php");
                exit();
            } elseif ($row['role'] === 'Staff') {
                header("Location: staff-dashboard.php");
                exit();    
            } elseif ($row['role'] === 'Manager') {
                header("Location: csdashboard_manager.php");
                exit();

            }elseif ($row['role'] === 'Owner') {
                header("Location: owner-dashboard.php");
                exit();

            }
            
        } else {
            echo '<script>';
            echo 'alert("Invalid Username or Password");';
            echo 'setTimeout(function() { window.location.href = "index.php"; },);';
            echo '</script>';
            exit();
        }
    } else {
        echo '<script>';
        echo 'alert("Invalid Username or Password");';
        echo 'setTimeout(function() { window.location.href = "index.php"; },);';
        echo '</script>';
        exit();
    }

    $stmt->close();
}

$connection->close();
?>