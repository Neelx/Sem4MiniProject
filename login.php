<?php
// Database configuration
$servername = "localhost"; // Change this to your database server hostname
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database_name = "loggedin"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize form data
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if user exists with provided credentials
    $sql = "SELECT * FROM Users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // Check if result contains any row
    if ($result->num_rows > 0) {
        // User found, redirect to dashboard or any other page
        echo "Login successful. Redirect to dashboard...";
        // You can redirect using header function
        // header("Location: dashboard.php");
    } else {
        // User not found or incorrect credentials
        echo "Invalid email or password.";
    }
}

// Close connection
$conn->close();
?>
