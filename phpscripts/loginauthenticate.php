<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "foodflash";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Query the database to check if the username and password are correct
$sql = "SELECT customerID, Password FROM users WHERE Username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the password
    if ($password === $row['Password']) { // Replace with password_verify() if using hashed passwords
        $_SESSION["customerID"] = $row["customerID"];
        $_SESSION["cartID"] = $row["customerID"];
        $_SESSION["Username"] = $username;
        header("Location: ../mainpage.php"); // Redirect to the dashboard or home page
        exit();
    } else {
        header("Location: login.html?error=invalid"); // Invalid password
        exit();
    }
} else {
    // Login failed
    header("Location: login.html?error=invalid"); // Redirect back to the login page with an error message
    exit();
}

$conn->close();
?>
