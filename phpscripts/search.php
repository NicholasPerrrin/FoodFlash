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

$searchValue = trim($_POST['searchField']);

$_SESSION["searchValue"] = $searchValue;

header("Location: ../searchPage.php"); // Redirect to the search page
?>