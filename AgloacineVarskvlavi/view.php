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

// Registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Get the password

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if user already exists
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "User already exists!";
    } else {
        // Prepare SQL statement for insertion
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_password);

        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
            // Redirect to welcome page after successful registration
            header("Location: welcome.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

$conn->close();
?>
