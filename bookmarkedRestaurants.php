<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Check if user is logged in
if (!isset($_SESSION['customerID'])) {
    header("Location: login.html");
    exit();
}

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

// Fetch bookmarked restaurants
$customerID = $_SESSION['customerID'];
$bookmarkedRestaurantsSQL = "
    SELECT r.restaurantID, r.restaurantName, r.descript, r.category
    FROM restaurant r
    JOIN bookmarks b ON r.restaurantID = b.restaurantID
    WHERE b.customerID = $customerID
";
$bookmarkedRestaurantsResult = $conn->query($bookmarkedRestaurantsSQL);

// Debug: check for query errors
if (!$bookmarkedRestaurantsResult) {
    die("Query error: " . $conn->error);
}

// Debug: check number of bookmarks and customer ID
$bookmarkCount = $bookmarkedRestaurantsResult->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bookmarked Restaurants - Food Flash</title>
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

    <main>
        <h1>My Bookmarked Restaurants</h1>

        <!-- Temporary information -->
        <div style="background-color: #f0f0f0; padding: 10px; margin-bottom: 20px;">
            <p>Temporary Information:</p>
            <p>Customer ID: <?php echo $customerID; ?></p>
            <p>Number of Bookmarked Restaurants: <?php echo $bookmarkCount; ?></p>
        </div>

        <?php if ($bookmarkCount > 0): ?>
            <div class="bookmarked-restaurants-container">
                <?php while($restaurant = $bookmarkedRestaurantsResult->fetch_assoc()): ?>
                    <div class="bookmarked-restaurant-card">
                        <h2><?php echo htmlspecialchars($restaurant['restaurantName']); ?></h2>
                        
                        <?php if (!empty($restaurant['category'])): ?>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($restaurant['category']); ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($restaurant['descript'])): ?>
                            <p><?php echo htmlspecialchars($restaurant['descript']); ?></p>
                        <?php endif; ?>
                        
                        <a href="restaurantPage.php?restaurantName=<?php 
                            echo urlencode($restaurant['restaurantName']); 
                        ?>" class="view-restaurant-btn">View Restaurant</a>
                        
                        <form method="POST" action="phpscripts/removeBookmark.php" style="display:inline;">
                            <input type="hidden" name="restaurantID" value="<?php echo $restaurant['restaurantID']; ?>">
                            <button type="submit" class="remove-bookmark-btn">Remove Bookmark</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>You haven't bookmarked any restaurants yet. 
               <a href="searchPage.php">Browse Restaurants</a></p>
        <?php endif; ?>
    </main>

    <?php $conn->close(); ?>
</body>
</html>