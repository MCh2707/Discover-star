<?php
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

// Registration section
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
    $class = $_POST['class'];
    $teacher = $_POST['teacher'];

    // Validation
    if ($class <= 6) {
        echo "You must be in at least 7th grade.";
        exit();
    }

    // SQL query to insert user data
    $sql = "INSERT INTO users (firstname, lastname, email, password, class, teacher) VALUES ('$firstname', '$lastname', '$email', '$password', '$class', '$teacher')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: welcome.html"); // Redirect to welcome page after successful registration
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}


if ($conn->query($sql) === TRUE) {
    $_SESSION['user_id'] = $conn->insert_id; // Save user ID in session
    header("Location: welcome.html"); // Redirect to welcome page after successful registration
    exit();
}

$conn->close();
?>

<?php
session_start(); // Start session at the beginning

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

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password

    // SQL query to insert new user
    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['user_id'] = $conn->insert_id; // Save user ID in session
        header("Location: welcome.html"); // Redirect to welcome page after successful registration
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<form action="register.php" method="post">
    <div class="input-box">
        <input type="text" name="firstname" class="input-field" placeholder="Firstname" required>
    </div>
    <div class="input-box">
        <input type="text" name="lastname" class="input-field" placeholder="Lastname" required>
    </div>
    <div class="input-box">
        <input type="email" name="email" class="input-field" placeholder="Email" required>
    </div>
    <div class="input-box">
        <input type="password" name="password" class="input-field" placeholder="Password" required>
    </div>
    <div class="input-box">
        <input type="text" name="class" class="input-field" placeholder="Class" required>
    </div>
    <div class="input-box">
        <input type="text" name="teacher" class="input-field" placeholder="Teacher's Name" required>
    </div>
    <div class="input-box">
        <button type="submit" class="submit">Register</button>
    </div>
</form>
