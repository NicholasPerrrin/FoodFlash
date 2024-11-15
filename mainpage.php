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
                <a href="#">Placeholder</a>
                <a href="#">Placeholder</a>
                <a href="#">Placeholder</a>
                <input type="text" placeholder="Search...">
                <a href="accountpage.php" style="float: right;"><img src="images/profileOutline.png" height="50px" alt="profile Outline"></a>
            </div>
        </header>
        <div id="category_section">
            <p class="headers">Categories</p>
            <a href="#" class="categories">Category1</a>
            <a href="#" class="categories">Category2</a>
            <a href="#" class="categories">Category3</a>
        </div>
        <div>
            <p class="headers">Recommended</p>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
            <a href="#" class="recommended"><img src="images/chineseRestaurant.jpg"><p class="recommended_description">Restaurant</p><br></a>
        </div>
        <footer>
            <?php echo "Welcome " . $_SESSION["Username"]; ?>
        </footer>
    </body>
</html>