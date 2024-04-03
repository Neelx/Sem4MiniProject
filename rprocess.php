    <?php
    // Handle registration form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to your database
        $conn = new mysqli("localhost", "root", "", "User");
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare and bind parameters
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        // Set parameters and execute
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $stmt->execute();

        echo "Registration successful!";
        
        $stmt->close();
        $conn->close();
    }
    ?>
