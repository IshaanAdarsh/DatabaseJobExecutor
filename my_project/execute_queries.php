<?php
$host = "localhost";
$username = "root";
$password = "password";
$database = "job_execution_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$csvFile = "/Users/spartacus/JobExecutionApp/my_project/mastersheet.csv";

if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $header = fgetcsv($handle, 0, "\t");

    while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
        $updateSchoolQuery = $data[13];

        $success = true;

        if (mysqli_query($conn, $updateSchoolQuery)) {
            mysqli_query($conn, "UPDATE jobs SET completed = completed + 1, remaining = remaining - 1 WHERE id = 1");
        } else {
            $success = false;
        }

        if (!$isRunning || !$success) {
            break;
        }
    }
    fclose($handle);
} else {
    echo "Error opening CSV file";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn->close();
