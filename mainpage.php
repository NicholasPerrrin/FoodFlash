<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <title>Food Flash</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/slider.css">
        <link rel="stylesheet" href="css/icon.css">
        
    </head>
    <body>
        <header>
            <div class="topnav">
                <!-- FoodFlash logo -->
                <img src="images/FoodFlashLogo.png" class="logo" alt="FoodFlash Logo">

                <!-- Search box -->
                <form action="phpscripts/search.php" method="POST">
                    <input id="searchField" name="searchField" type="text" placeholder="Search...">
                </form>
                
                <!-- Navigation links -->
                <div class="nav-links">
                    <a href="mainpage.php">Home</a>
                    <a href="Restaurantview.php">Business</a>
                    <a href="bookmarkedRestaurants.php">My Bookmarks</a>
                </div>

                <!-- Cart and Account links -->
                <div class="cartAccount-links">
                    <a href="accountPage.php"><img src="images/profileOutline.png" height="50" alt="profile outline"></a>
                    <a href="cart.php">Cart</a>  
                </div>
            </div>
        </header>

        <!-- Image Slider Section -->
        <div class="slider-container">
            <div class="slider">
                <div class="slide">
                    <img src="images/chineseRestaurant.jpg" alt="Chinese Restaurant">
                    <div class="slide-caption">
                        <h2>Authentic Chinese Cuisine</h2>
                        <p>Experience the best of traditional Chinese flavors</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/mexicanFood.jpg" alt="Mexican Food">
                    <div class="slide-caption">
                        <h2>Mexican Delights</h2>
                        <p>Savor the taste of Mexico</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/peopleEating2.webp" alt="Dining Experience">
                    <div class="slide-caption">
                        <h2>Share the Joy</h2>
                        <p>Create memories with great food</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/peopleEating1.jpg" alt="Social Dining">
                    <div class="slide-caption">
                        <h2>Social Dining</h2>
                        <p>Bring people together with food</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <button class="slider-arrow prev">&#10094;</button>
            <button class="slider-arrow next">&#10095;</button>
            
            <!-- Navigation Dots -->
            <div class="slider-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        <div id="category_section">


        <div id="category_section">
            <p class="headers">Your favorite meals categorized</p>
            <div class="category-container">
                <form action="phpscripts/categories.php" method="POST" class="category-grid">
                    <button type="submit" name="categories" value="American" class="category-item">
                        <img src="images/american-icon.png" alt="American Food">
                        <span>American</span>
                    </button>
            
                    <button type="submit" name="categories" value="Chinese" class="category-item">
                        <img src="images/chinese-icon.png" alt="Chinese Food">
                        <span>Chinese</span>
                    </button>
            
                    <button type="submit" name="categories" value="Sushi" class="category-item">
                        <img src="images/sushi-icon.png" alt="Sushi">
                        <span>Sushi</span>
                    </button>
            
                    <button type="submit" name="categories" value="Mexican" class="category-item">
                        <img src="images/mexican-icon.jpg" alt="Mexican Food">
                        <span>Mexican</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="recommendations">
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

// If a category is selected, show filtered results
if (isset($_SESSION['categories'])) {
    $radioValue = $_SESSION['categories'];
    $sql = "SELECT restaurantName, restaurantLocation, estimatedPrice, restaurantImage, descript FROM restaurant WHERE category LIKE '%$radioValue%'";
} else {
    // If no category is selected, show all restaurants
    $sql = "SELECT restaurantName, restaurantLocation, estimatedPrice, restaurantImage, descript FROM restaurant";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Add minimal CSS just for the image
    echo '<style>
        .restaurant-image {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .restaurant-description {
            margin-top: 10px;
        }
    </style>';

    echo '<div class="recommendations">';
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $restaurantName = $row['restaurantName'];
        $restaurantDescription = $row['descript'];
        $imageUrl = $row['restaurantImage'] ?? 'images/default-restaurant.jpg'; // Fallback to default image if none provided
        
        echo '<form method="POST" action="phpscripts/searchChoice.php" style="text-align: center;background-color: #e9e9e9;padding: 20px;border: solid black;margin: 10px;">
                <img src="'.$imageUrl.'" alt="'.$restaurantName.'" class="restaurant-image"><br>
                <input readonly type="text" name="restaurantName" value="'.$restaurantName.'"><br>
                <span>- Location: '.$row["restaurantLocation"].'</span><br>
                <span>- Estimated price: $'.$row["estimatedPrice"].'</span><br>
                <div class="restaurant-description">'.$restaurantDescription.'</div>
                <br>
                <input type="submit" value="View menu">
            </form>';
    }
    echo '</div>';
} else {
    echo "<p style='text-align: center;'>No restaurants found</p>";
}
$conn->close();
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

        <script src="js/slider.js"></script>

    </body>
</html>
