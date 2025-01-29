<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost"; // Replace with your database hostname
    $username = "root"; // Replace with your database username
    $password = "root"; // Replace with your database password
    $dbname = "bike"; // Replace with your database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO checkout_info (cardholder_name, card_number) VALUES (?, ?)");
    $stmt->bind_param("ss", $cardholder_name, $card_number);
    
    // Set parameters and execute
    $cardholder_name = $_POST['name'];
    $card_number = $_POST['card_number'];
    $stmt->execute();
    
    // Check for errors
    if ($stmt->error) {
        echo "Error: " . $stmt->error;
    } else {
        echo "Payment information stored successfully.";
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
