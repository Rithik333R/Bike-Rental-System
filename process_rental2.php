<?php
// Database connection
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bike_name = $_POST['bike_name'];
    $fromDate = $_POST['fromDate'];
    $startTime = $_POST['startTime'];
    $toDate = $_POST['toDate'];
    $endTime = $_POST['endTime'];

    // Insert data into database
    $sql = "INSERT INTO rental_info (bike_name, start_date, start_time, end_date, end_time)
            VALUES ('$bike_name', '$fromDate', '$startTime', '$toDate', '$endTime')";

    if ($conn->query($sql) === TRUE) {
        // Calculate rent price
        $timeDiff = strtotime($endTime) - strtotime($startTime);
        $hours = ceil($timeDiff / (60 * 60)); // Calculating hours
        $rentalPrice = $hours * 20; // Assuming rental price is $20 per hour

        // Redirect to payment.html with rent price as parameter
        header("Location: payment.html?rent=$rentalPrice");
        exit(); // Ensure that no other code is executed after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
