<?php
// Database configuration
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

//session.start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Validation
    $errors = [];
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    
    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT customerid FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "Username or email already exists.";
    }
    $stmt->close();
    
    // If no errors, insert the user into the database
    if (empty($errors)) {
        //I had to change this line for testing
        $hashed_password = $password;//_hash($password, PASSWORD_DEFAULT);
        ////////////////////////
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $sql = "SELECT customerID FROM users where username='$username'";
            $result = $conn->query($sql);
            
            while($row = $result->fetch_assoc()) {
                $customerID = $row['customerID'];
            }

            $sql = "INSERT INTO cart (cartID, customerID) VALUES ('$customerID', '$customerID');";
            if ($conn->query($sql) === TRUE) {
                    echo "Account created successfully. <a href='../login.html'>Click here</a> to login in.";
            } else {
                echo "Error: " . $stmt->error;
            }
            // set session variables
            //$_SESSION['username'] = $username;
            
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}

$conn->close();
?>
