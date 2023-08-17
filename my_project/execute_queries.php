<?php
$host = "localhost";
$username = "root";
$password = "password";
$database = "job_execution_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$csvFile = "/Users/spartacus/JobExecutionApp/my_project/mastersheet.csv"; // Update with your file path

if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $header = fgetcsv($handle, 0, "\t");

    while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
        $updateSchoolQuery = $data[13];

        $success = true;

        if (mysqli_query($conn, $updateSchoolQuery)) {
            // Increment completed jobs and decrement remaining jobs
            mysqli_query($conn, "UPDATE jobs SET completed = completed + 1, remaining = remaining - 1 WHERE id = 1");
        } else {
            $success = false;
            // Handle error
        }

        if (!$isRunning || !$success) {
            break; // Stop execution if not running or if an error occurred
        }
    }
    fclose($handle);
} else {
    echo "Error opening CSV file";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn->close();
