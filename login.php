<?php
// Database credentials
$servername = "localhost"; // Change this to your MySQL server's hostname if it's not localhost
$username = "root"; // Change this to your MySQL username
$password = "root"; // Change this to your MySQL password
$database = "bike"; // Change this to your MySQL database name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Establish a connection to the database
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to retrieve user's credentials
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        // Bind parameters
        $stmt->bindParam(':email', $_POST['email']);
        // Execute the query
        $stmt->execute();
        // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validate user's credentials
        if ($user && password_verify($_POST['password'], $user['password'])) {
            // Authentication successful
            // Redirect to the homepage
            header("Location: bb.html");
            exit();
        } else {
            // Authentication failed
            // Redirect back to the login page with an error message
            header("Location: login.html?error=invalid_credentials");
            exit();
        }
    } catch(PDOException $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
