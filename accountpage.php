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
                <input type="text" placeholder="Search...">
                <a href="accountpage.php" style="float: right;"><img src="images/profileOutline.png" height="50px" alt="profile Outline"></a>
            </div>
            <h2>Account Information</h2>
            <p>UserName: <?php echo $_SESSION["Username"] ?> </p>
            <p></p>
            <div>
            </div>
            <footer>
                Don't have an account? Register <a href="registration.html">Here    </a>
                Already a member? Login <a href="login.html">Here   </a>
                <a href="Logout.html">Logout</a>
            </footer>
    </body>
</html>