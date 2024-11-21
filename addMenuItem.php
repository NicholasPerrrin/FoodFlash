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
        <div>
            <form method='POST'>
                <input type='text' name='itemName' placeholder='Enter Item Name'>
                <input type='number' name='price' placeholder='Enter Item price'>
                <input type='submit' value='submit'>
            </form>
        </div>
        <div>
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

                $restaurantID = $_SESSION['restaurantID'];

                $itemName = trim($_POST['itemName']);
                $price = trim($_POST['price']);

                $sql = "INSERT INTO menuitem (restaurantID, itemName, price) VALUES ('$restaurantID', '$itemName', '$price')";
                $result = $conn->query($sql);

            ?>
        </div>
        <footer>
        </footer>
    </body>
</html>