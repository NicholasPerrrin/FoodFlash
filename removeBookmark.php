<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['customerID'])) {
    header("Location: ../login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodflash";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if restaurantID is provided
if (!isset($_POST['restaurantID'])) {
    header("Location: ../bookmarkedRestaurants.php");
    exit();
}

$customerID = $_SESSION['customerID'];
$restaurantID = (int)$_POST['restaurantID'];

// Remove bookmark
$removeBookmarkSQL = "DELETE FROM bookmarks 
                      WHERE customerID = $customerID 
                      AND restaurantID = $restaurantID";

if ($conn->query($removeBookmarkSQL)) {
    // Redirect back to bookmarked restaurants page with success message
    $_SESSION['bookmark_message'] = "Bookmark removed successfully!";
    header("Location: ../bookmarkedRestaurants.php");
} else {
    // Redirect back with error message
    $_SESSION['bookmark_message'] = "Error removing bookmark: " . $conn->error;
    header("Location: ../bookmarkedRestaurants.php");
}

$conn->close();
?>