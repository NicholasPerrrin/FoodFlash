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

//variables
$address = trim($_POST['address']);
$customerID = $_SESSION['customerID'];
$eta = date("h:i:a");
$restaurantID = $_SESSION['restaurantID'];
$timePlaced = date("h:i:a");


// create new order

$sql = "INSERT INTO orders (addr, customerID, restaurantID, timePlaced, ETA) VALUES ('$address', '$customerID', '$restaurantID', '$timePlaced', '$eta')";
$result = $conn->query($sql);

echo "<a href='../mainpage.php'>home</a>";

echo "<h1 style='text-align: center;'>Order placed</h1>"

//header("Location: ../restaurantPage.php"); // Redirect to the search page
?>