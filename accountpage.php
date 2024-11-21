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

                <!-- Search box -->
                <form action="phpscripts/search.php" method="POST">
                    <input id="searchField" name="searchField" type="text" placeholder="Search...">
                </form>
                <a href="searchPage.php" style="float: right;">
                <img src="images/magnifying-glass.png" height="50px" alt="Search Icon">
            </a>
            </div>
            <h2>Account Information</h2>
            <p>UserName: <?php if (isset($_SESSION["Username"])) {echo $_SESSION["Username"];} else {echo "You are not logged in";} ?> </p>
            <p></p>
            <div>
            </div>
            <footer>
                Don't have an account? Register <a href="registration.html">Here</a>
                |  Already a member? Login <a href="login.html">Here</a>
                |  <a href="Logout.html">Logout</a>
            </footer>
    </body>
</html>
