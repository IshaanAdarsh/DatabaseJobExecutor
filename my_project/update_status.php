<?php
$host = "localhost";
$username = "root";
$password = "*password*";
$database = "job_execution_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT completed, remaining FROM jobs WHERE id = 1";

$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $status = array(
        'completed' => $row['completed'],
        'remaining' => $row['remaining']
    );
    echo json_encode($status);
} else {
    echo json_encode(array('error' => 'Unable to fetch status'));
}

$conn->close();

error_reporting(E_ALL);
ini_set('display_errors', 1);
