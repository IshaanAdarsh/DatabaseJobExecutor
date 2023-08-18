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
        if (count($data) >= 14) { // Make sure there are at least 14 columns in the data
            $updateSchoolQuery = $data[13];

            $success = true;

            if (!empty($updateSchoolQuery)) {
                if (!mysqli_query($conn, $updateSchoolQuery)) {
                    $success = false;
                }
            }

            if (!$isRunning || !$success) {
                break;
            }
        } else {
            echo "Data does not have enough columns.";
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
