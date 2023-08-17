<?php
$host = "localhost";
$username = "root";
$password = "password";
$database = "job_execution_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$csvFile = "/Users/spartacus/Desktop/Web Development/php/my_project/mastersheet.csv"; // Update with your file path

if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $header = fgetcsv($handle, 0, "\t");

    while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
        $updateSchoolQuery = $data[13];
        $classUpdateQuery = $data[14];
        $userDataUpdateQuery = $data[15];

        if (mysqli_query($conn, $updateSchoolQuery)) {
            // Handle success
        } else {
            // Handle error
        }

        if (mysqli_query($conn, $classUpdateQuery)) {
            // Handle success
        } else {
            // Handle error
        }

        if (mysqli_query($conn, $userDataUpdateQuery)) {
            // Handle success
        } else {
            // Handle error
        }

        if (!$isRunning) {
            break; // Stop execution if not running
        }
    }
    fclose($handle);
} else {
    echo "Error opening CSV file";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn->close();
