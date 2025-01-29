<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost"; // Change this to your database servername
    $username = "root"; // Change this to your database username
    $password = "root"; // Change this to your database password
    $dbname = "bike"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO rents (bike_name, start_date, end_date, start_time, end_time, total_price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param( $bike_name, $start_date, $end_date, $start_time, $end_time, $total_price);

    // Set parameters and execute
    $bike_name = $_POST['bike_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $total_price = $_POST['total_price'];

    $stmt->execute();

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
