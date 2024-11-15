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
                <a href="searchPage.php" style="float: right;"><img src="images/magnifying-glass.png" height="50px" alt="magnifying glass"></a>
            </div>
        </header>
        <div id="category_section">
            <p class="headers">Categories</p>
            <a href="#" class="categories">Category1</a>
            <a href="#" class="categories">Category2</a>
            <a href="#" class="categories">Category3</a>
        </div>
        <div>
            <p class="headers">All Restaurants</p>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
        </div>
        <footer>
            <?php echo "Welcome " . $_SESSION["Username"];?>
        </footer>
    </body>
</html>