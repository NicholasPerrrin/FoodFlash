<?php
session_start();

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

// Get restaurant ID
$restaurantQuery = "SELECT restaurantID FROM restaurant WHERE restaurantName = '$restaurantName'";
$restaurantResult = $conn->query($restaurantQuery);
$restaurantData = $restaurantResult->fetch_assoc();
$restaurantID = $restaurantData['restaurantID'];

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['customerID'])) {
    $customerID = $_SESSION['customerID'];
    $rating = (int)$_POST['rating'];
    $reviewText = mysqli_real_escape_string($conn, $_POST['review_text']);
    
    $sql = "INSERT INTO review (customerID, restaurantID, rating, text) 
            VALUES ($customerID, $restaurantID, $rating, '$reviewText')";
    
    if ($conn->query($sql)) {
        echo "<p>Review submitted successfully!</p>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
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
            <form action="phpscripts/search.php" method="POST">
                <input id="searchField" name="searchField" type="text" placeholder="Search...">
            </form>
            <a href="accountPage.php"><img src="images/profileOutline.png" height="50px" alt="profile outline"></a>
            <a href="cart.php">Cart</a>
            <img src="images/FoodFlashLogo.png" height="50">
            <a href="searchPage.php" style="float: right;">
                <img src="images/magnifying-glass.png" height="50px" alt="magnifying glass">
            </a>
        </div>
    </header>

    <!-- Restaurant Info Section -->
    <div>
        <h2><?php echo $restaurantName; ?></h2>
        <p>
        <?php
        $sql = "SELECT descript, restaurantID FROM restaurant where restaurantName = '$restaurantName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['descript'];
            //set reataurant session variable
            $_SESSION['restaurantID'] = $row['restaurantID'];
        }
        ?>
        </p>
    </div>

    <!-- Menu Section -->
    <div>
        <h2>Menu</h2>
        <?php
        $sql = "SELECT itemName, price FROM menuitem 
                JOIN restaurant ON restaurant.restaurantID = menuitem.restaurantID 
                WHERE restaurantName = '$restaurantName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $itemName = $row['itemName'];
                $price = $row['price'];
                echo "<form method='POST' action='phpscripts/addToCart.php'>
                        <input type='text' value='$itemName' name='itemName' readonly> - 
                        $ <input type='text' value='$price' readonly>
                        <input type='submit' value='Add to cart'>
                    </form><br><br>";
            }
        }
        ?>
    </div>

    <!-- Review Section -->
    <div>
        <h2>Customer Reviews</h2>
        
        <?php if (isset($_SESSION['customerID'])): ?>
            <!-- Review Form -->
            <div>
                <h3>Write a Review</h3>
                <form method="POST" action="">
                    <div>
                        <label for="rating">Rating (1-5):</label><br>
                        <select id="rating" name="rating" required>
                            <option value="1">1 - Poor</option>
                            <option value="2">2 - Fair</option>
                            <option value="3">3 - Good</option>
                            <option value="4">4 - Very Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="review_text">Your Review:</label><br>
                        <textarea id="review_text" name="review_text" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit">Submit Review</button>
                </form>
            </div>
        <?php else: ?>
            <p>Please <a href="login.html">login</a> to write a review.</p>
        <?php endif; ?>

        <!-- Display Reviews -->
        <?php
        $reviewsSQL = "SELECT r.rating, r.text, u.username, r.reviewID 
                       FROM review r 
                       JOIN users u ON r.customerID = u.customerID 
                       WHERE r.restaurantID = $restaurantID 
                       ORDER BY r.reviewID DESC";
        $reviewsResult = $conn->query($reviewsSQL);

        if ($reviewsResult->num_rows > 0) {
            while($review = $reviewsResult->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<h4>Rating: " . $review['rating'] . "/5</h4>";
                echo "<p><strong>By " . htmlspecialchars($review['username']) . "</strong></p>";
                echo "<p>" . nl2br(htmlspecialchars($review['text'])) . "</p>";
                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "<p>No reviews yet. Be the first to review!</p>";
        }
        ?>
    </div>

    <footer>
        <?php echo " restaurant name: " .  $_SESSION["restaurantName"]; ?>
    </footer>

    <?php $conn->close(); ?>
</body>
</html>
