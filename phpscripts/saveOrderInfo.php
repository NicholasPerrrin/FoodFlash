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

date_default_timezone_set("America/New_York");
//variables
$address = trim($_POST['address']);
$customerID = $_SESSION['customerID'];
$eta = date("h:i:a");
$restaurantID = $_SESSION['restaurantID'];
$timePlaced = date("h:i:sa");


// create new order

$sql = "INSERT INTO orders (addr, customerID, restaurantID, timePlaced, ETA) VALUES ('$address', '$customerID', '$restaurantID', '$timePlaced', '$eta')";
$result = $conn->query($sql);

header("Location: ../orderComplete.php"); // Redirect to the search page
?>