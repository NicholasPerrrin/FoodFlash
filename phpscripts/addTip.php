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

if (null !== trim($_POST['tipAmount'])) {
    $tip = trim($_POST['tipAmount']);
} else {
    $tip = 0;
}

$_SESSION['tip'] = $tip;

header("Location: ../cart.php"); // Redirect to the search page
?>