<?php
$host = "localhost";
$username = "root";
$password = "password";
$database = "job_execution_db";

$isRunning = false; // Initialize the variable

// Initialize the connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch completed and remaining jobs
$query = "SELECT completed, remaining FROM jobs WHERE id = 1";

// Perform the query and handle errors
$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = array(
        'completed' => $row['completed'],
        'remaining' => $row['remaining']
    );
    echo json_encode($status);
} else {
    echo json_encode(array('error' => 'Unable to fetch status'));
}

// Close the connection
$conn->close();

// Disable error reporting and displaying errors
error_reporting(0);
ini_set('display_errors', 0);
