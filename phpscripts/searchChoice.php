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

$restaurantName = trim($_POST['restaurantName']);

$_SESSION['restaurantname'] = $restaurantName;

header("Location: ../restaurantPage.php"); // Redirect to the search page
?>