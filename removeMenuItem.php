<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Restaurant View - Food Flash</title>
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
    <!-- form for connecting to a restaurant -->
    <main>
        <!-- Section for restaurant actions -->
        <div id="restaurant_actions" style="margin: 20px;">
            <p class="headers">New Values for Item</p>
            <form method="POST">
                <input type='number' placeholder='Item ID' name='itemID'>
                <input type='text' placeholder='Item Name' name='itemName'>
                <input type='submit' value='Update Menu'>
            </form>
        </div>

        <!-- Section to display current menu -->
        <div id="menu_section" style="margin: 20px;">
            <p class="headers">Current Menu</p>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "foodflash";

            //ignore warnings
            error_reporting(0);

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

                //variables
                $restaurantID = $_SESSION['restaurantID'];
                $itemID = trim($_POST['itemID']);
                $itemName = trim($_POST['itemName']);
                //update selected item
                $sql = "DELETE FROM menuitem WHERE itemID='$itemID' AND itemName='$itemName' AND restaurantID='$restaurantID'";
                $result = $conn->query($sql);
                //display table
                if ($restaurantID) {
                    $sql = "SELECT itemID, itemName, price FROM menuitem WHERE restaurantID = $restaurantID";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table style='width: 100%; border-collapse: collapse;'>";
                        echo "<tr>
                            <th style='border: 1px solid black; padding: 8px;'>Item ID</th>
                                <th style='border: 1px solid black; padding: 8px;'>Item Name</th>
                                <th style='border: 1px solid black; padding: 8px;'>Price ($)</th>
                            </tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td style='border: 1px solid black; padding: 8px;'>{$row['itemID']}</td>
                                    <td style='border: 1px solid black; padding: 8px;'>{$row['itemName']}</td>
                                    <td style='border: 1px solid black; padding: 8px;'>{$row['price']}</td>
                                </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No menu items found.</p>";
                    }
                } else {
                    echo "<p>Restaurant not selected. Please log in or contact support.</p>";
                }

            $conn->close();
            ?>
        </div>
    </main>
    <footer style="text-align: center; padding: 10px; background-color: #f1f1f1; margin-top: 20px;">
        <?php 
        if (isset($_SESSION["Username"])) {
            echo "Welcome " . htmlspecialchars($_SESSION["Username"]);
        } else {
            echo "You are not logged in.";
        }
        ?>
    </footer>
</body>
</html>
