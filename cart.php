<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <title>Food Flash</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <header>
            <div class="topnav">
                <a href="mainpage.php">Home</a>
                <a href="#">Restaurant View</a>
                <form action="phpscripts/search.php" method="POST"><input id="searchField" name="searchField" type="text" placeholder="Search..."></form>
                <a href="accountPage.php"><img src="images/profileOutline.png" height="50px" alt="profile outline"></a>
                <img src="images/FoodFlashLogo.png" height="50">
                <a href="searchPage.php" style="float: right;"><img src="images/magnifying-glass.png" height="50px" alt="magnifying glass"></a>
            </div>
        </header>
        <div>

        </div>
            <h2>Items in Cart</h2>
            <?php
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

            $username = $_SESSION["Username"];

            //get customerID of logged in user
            $customerID = $_SESSION['customerID'];
            //get cartID
            $cartID = $_SESSION['cartID'];

            // get ids of all items in the cart
            $sql = "SELECT itemID FROM cartitem where cartID='$cartID'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $itemID = $row['itemID'];
                    echo $itemID;
                    //get name of item
                    $sql = "SELECT itemName, price FROM menuItem where itemID='$itemID'";
                    $newResult = $conn->query($sql);
                    while($newRow = $newResult->fetch_assoc()) {
                        echo $newRow['itemName'] . " - " . $newRow['price'] . "<br>";
                    }
                }
            }
            ?>
        <div>
            <h2>Total</h2>
            <p>
                <?php
                echo $_SESSION['total'];
                ?>
            </p>
        </div>
        <footer>
            <?php echo " restaurant name: " .  $_SESSION["restaurantName"];?>
        </footer>
    </body>
</html>