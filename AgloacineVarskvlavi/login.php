<?php
$servername = "localhost";
$username = "your_username"; // Your database username
$password = "your_password"; // Your database password
$dbname = "user_registration"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // You can redirect to a welcome page or dashboard here
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>
