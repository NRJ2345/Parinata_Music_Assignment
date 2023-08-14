<?php
session_start();


$mysqli = new mysqli("localhost", "username", "password", "database_name");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];


$query = "SELECT * FROM users WHERE email='$email'";
$result = $mysqli->query($query);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
   
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php"); 
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}

$mysqli->close();
?>
