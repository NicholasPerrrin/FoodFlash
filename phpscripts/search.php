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

//ssession.start();
/*d
$searchValue = trim($_POST['searchField']);

// Query the database to check if the username and password are correct
$sql = "SELECT * FROM restaurant WHERE restaurantName='$searchValue'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login successful
    /*session_start();*/
/*d    $_SESSION["Username"] = $username;
    header("Location: ../searchPage.php"); // Redirect to the dashboard or home page
    exit();
} else {
    // Login failed
    header("Location: login.html?error=invalid"); // Redirect back to the login page with an error message
    exit();
}

$conn->close();
d*/
$searchValue = trim($_POST['searchField']);

$_SESSION["searchValue"] = $searchValue;

header("Location: ../searchPage.php"); // Redirect to the search page
?>