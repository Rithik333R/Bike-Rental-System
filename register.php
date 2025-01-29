<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bike";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Prepare SQL statement to insert data
    $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName' '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully.";
        echo "Go back to the home page and buy your favourite property.";
        echo "Login to see your property deatils.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
