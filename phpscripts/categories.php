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

$radioValue = trim($_POST['categories']);

$_SESSION['categories'] = $radioValue;

header("Location: ../mainpage.php"); // Redirect to the search page
?>