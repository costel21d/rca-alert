<?php
// Include database configuration details from config.php file
include('config.php');

// Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert new client
$stmt = $conn->prepare("INSERT INTO clients (last_name, first_name, company_name, email, second_email, mobile_phone, second_phone, other_comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $last_name, $first_name, $company_name, $email, $second_email, $mobile_phone, $second_phone, $other_comments);

// Set parameter values from form submission
$last_name = $_POST["last_name"];
$first_name = $_POST["first_name"];
$company_name = $_POST["company_name"];
$email = $_POST["email"];
$second_email = $_POST["second_email"];
$mobile_phone = $_POST["mobile_phone"];
$second_phone = $_POST["second_phone"];
$other_comments = $_POST["other_comments"];

// Execute SQL statement to insert new client
if ($stmt->execute() === TRUE) {
    echo "New client added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close MySQL connection
$stmt->close();
$conn->close();
?>