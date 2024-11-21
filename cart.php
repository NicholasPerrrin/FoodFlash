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

                <!-- FoodFlash logo -->
                <img src="images/FoodFlashLogo.png" class="logo" alt="FoodFlash Logo">

                

                <!-- Navigation links -->
                <div class="nav-links">
                    <a href="mainpage.php">Home</a>
                    <a href="Restaurantview.php">Restaurant View</a>
                    <a href="accountPage.php"><img src="images/profileOutline.png" height="50" alt="profile outline"></a>
                    <a href="cart.php">Cart</a>
                    <a href="bookmarkedRestaurants.php">My Bookmarks</a>
                </div>

                 <!-- Search box -->
                 <form action="phpscripts/search.php" method="POST">
                    <input id="searchField" name="searchField" type="text" placeholder="Search...">
                </form>
                <a href="searchPage.php" style="float: right;">
                    <img src="images/magnifying-glass.png" height="50px" alt="Search Icon">
                </a>

            </div>
        </header>
        <div>
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
            //set initial price to 0
            $price = 0;

            // get ids of all items in the cart
            $sql = "SELECT itemID FROM cartitem where cartID='$cartID'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $itemID = $row['itemID'];
                    //get name of item
                    $sql = "SELECT itemName, price FROM menuItem where itemID='$itemID'";
                    $newResult = $conn->query($sql);
                    while($newRow = $newResult->fetch_assoc()) {
                        echo $newRow['itemName'] . " - " . $newRow['price'] . "<br>";
                        $price = $price + $newRow['price'];
                        $_SESSION['total'] = $price;
                    }
                }
            }
            ?>
        </div>
        <div>
            <?php
            echo "<form method='POST' action='phpscripts/addTip.php'><input type='number' min='0' name='tipAmount'><input type='submit' value='Add Tip'></form>";
            ?>
        </div>
        <div>
            <h2>Total</h2>
            <p>
                <?php
                if (isset($_SESSION['tip'])) {
                    $tip = $_SESSION['tip'];
                } else {
                    $tip = 0;
                }
                echo "Total: $ " . $_SESSION['total'] + $_SESSION['tip'];
                ?>
            </p>
        </div>
        <div>
            <h2>Address</h2>
            <?php
            echo "<form method='POST' action='phpscripts/saveOrderInfo.php'><input name='address' placeholder='address' type='text'><input type='submit' value='Complete Order'></form>";
            ?>
        </div>
        <footer>
            <?php echo " restaurant name: " .  $_SESSION["restaurantName"];?>
        </footer>
    </body>
</html>
