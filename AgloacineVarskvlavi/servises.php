<?php
session_start(); // Start session

// Check if user ID is set in session
if (!isset($_SESSION['user_id'])) {
    die("You are not logged in."); // Redirect or show an error message
}

$servername = "localhost";
$username = "your_username"; // Replace with your database username
$password = "your_password"; // Replace with your database password
$dbname = "user_registration"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT firstname, lastname FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

// Check if user data exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $name = htmlspecialchars($user['firstname']); // Sanitize output
    $surname = htmlspecialchars($user['lastname']); // Sanitize output
} else {
    $name = "Not found";
    $surname = "Not found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
</head>
<body>
    <h1>User Information</h1>
    <h2>Name: <?php echo $name; ?></h2>
    <h2>Surname: <?php echo $surname; ?></h2>
</body>
</html>
