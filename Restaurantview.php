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
            <a href="mainpage.php">Home</a>
            <a href="restaurantView.php">Restaurant View</a>
            <form action="phpscripts/search.php" method="POST">
                <input id="searchField" name="searchField" type="text" placeholder="Search...">
            </form>
            <a href="accountPage.php"><img src="images/profileOutline.png" height="50" alt="profile outline"></a>
            <img src="images/FoodFlashLogo.png" height="50" alt="Food Flash Logo">
            <a href="searchPage.php" style="float: right;">
                <img src="images/magnifying-glass.png" height="50px" alt="Search Icon">
            </a>
        </div>
    </header>
    <main>
        <!-- Section for restaurant actions -->
        <div id="restaurant_actions" style="margin: 20px;">
            <p class="headers">Manage Menu</p>
            <form action="phpscripts/addMenuItem.php" method="POST">
                <button type="submit">Add to Menu</button>
            </form>
            <form action="phpscripts/updateMenuItem.php" method="POST">
                <button type="submit">Update Menu Item</button>
            </form>
            <form action="phpscripts/removeMenuItem.php" method="POST">
                <button type="submit">Remove Menu Item</button>
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

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $_SESSION['restaurantID'] = 123; // Replace 123 with a valid ID from your database

            $restaurantID = $_SESSION['restaurantID'] ?? null; // Assuming restaurantID is stored in session
            if ($restaurantID) {
                $sql = "SELECT itemName, itemDescription, itemPrice FROM menu WHERE restaurantID = $restaurantID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table style='width: 100%; border-collapse: collapse;'>";
                    echo "<tr>
                            <th style='border: 1px solid black; padding: 8px;'>Item Name</th>
                            <th style='border: 1px solid black; padding: 8px;'>Description</th>
                            <th style='border: 1px solid black; padding: 8px;'>Price ($)</th>
                          </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td style='border: 1px solid black; padding: 8px;'>{$row['itemName']}</td>
                                <td style='border: 1px solid black; padding: 8px;'>{$row['itemDescription']}</td>
                                <td style='border: 1px solid black; padding: 8px;'>{$row['itemPrice']}</td>
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