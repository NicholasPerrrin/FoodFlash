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

// get item to add id
$itemToAdd = trim($_POST['itemName']);
$sql = "SELECT * FROM menuitem where itemName='$itemToAdd'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $itemID = $row['itemID'];
    $price = $row['price'];
}

// get cart id
$sql = "SELECT cartID FROM cart join users on cart.customerID=users.customerID";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $cartID = $row['cartID'];
}

$sql = "INSERT INTO cartitem (cartID, itemID) VALUES ('$cartID', '$itemID')";
$result = $conn->query($sql);

//increase the total in the cost
//$_SESSION['total'] = $_SESSION['total'] + $price;

header("Location: ../restaurantPage.php"); // Redirect to the search page
?>