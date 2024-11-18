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
            <h2><?php echo $_SESSION["restaurantName"];?></h2>
            <p>
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

            $restaurantName = $_SESSION["restaurantName"];
            
            $sql = "SELECT descript FROM restaurant where restaurantName = '$restaurantName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo $row['descript'];
                }
            }
            ?>
            </p>
        </div>
        <div>
            <h2>Menu</h2>
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

            $restaurantName = $_SESSION["restaurantName"];
            
            $sql = "SELECT itemName, price FROM menuitem join restaurant on restaurant.restaurantID=menuitem.restaurantID where restaurantName = '$restaurantName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $itemName = $row['itemName'];
                    $price = $row['price'];
                    echo "<form method='POST' action='phpscripts\addToCart.php'><input type='text' value='$itemName' name='itemName' readonly> - $ <input type='text' value='$price' readonly><input type='submit' value='Add to cart'></form><br><br>";
                }
            }
            ?>
        </div>
        <footer>
            <?php echo " restaurant name: " .  $_SESSION["restaurantName"];?>
        </footer>
    </body>
</html>