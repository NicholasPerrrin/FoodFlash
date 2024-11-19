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
                <a href="Restaurantview.php">Restaurant View</a>
                <form action="phpscripts/search.php" method="POST"><input id="searchField" name="searchField" type="text" placeholder="Search..."></form>
                <a href="accountPage.php"><img src="images/profileOutline.png" height="50" alt="profile outline"></a>
                <a href="cart.php">Cart</a>
                <img src="images/FoodFlashLogo.png" height="50">
                <a href="searchPage.php" style="float: right;"><img src="images/magnifying-glass.png" height="50px" alt="magnifying glass"></a>
            </div>
        </header>
        <div id="category_section">
            <p class="headers">Categories</p>
            <form action="phpscripts/categories.php" method="POST">
                <input type="radio" value="American" id="American" name="categories">
                <label for="American">American</label>
                <input type="radio" value="Chinese" id="Chinese" name="categories">
                <label for="Chinese">Chinese</label>
                <input type="radio" value="Sushi" id="Sushi" name="categories">
                <label for="Sushi">Sushi</label>
                <input type="radio" value="Mexican" id="Mexican" name="categories">
                <label for="Mexican">Mexican</label>
                <br>
                <input type="submit" value="Load Recommendations">
            </form>
            <!--<a href="#" class="categories">Category1</a>
            <a href="#" class="categories">Category2</a>
            <a href="#" class="categories">Category3</a>-->
        </div>
        <div>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "foodflash";

            if (isset($_SESSION['categories'])) {
            $radioValue = $_SESSION['categories'];
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT restaurantName, restaurantLocation, estimatedPrice FROM restaurant where category like '%$radioValue%'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $restaurantName = $row['restaurantName'];
                echo '<form method="POST" action="phpscripts/searchChoice.php" id="form1" style="text-align: center;background-color: #e9e9e9;padding: 20px;border: solid black;">restaurant Name:  '. 
                "<input readonly type='text' name='restaurantName' id='restaurantName' value='$restaurantName'" . " - Location: " . $row["restaurantLocation"]. 
                " - estimated price: $" . $row["estimatedPrice"]. "<br><input type='submit' value='View menu'></form>";
              }
            } else {
              echo "0 results";
            }
            $conn->close();
        }
            ?>
            <!--<p class="headers">All Restaurants</p>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
        -->
            <?php

            ?>
        </div>
        <footer>
            <?php 
            if (isset($_SESSION["Username"])) {
                echo "Welcome " . $_SESSION["Username"];
            } else {
                echo "You are not logged in";
            }
            ?>
        </footer>
    </body>
</html>