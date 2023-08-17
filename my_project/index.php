<!DOCTYPE html>
<html>

<head>
    <title>Job Execution Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }

        #container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #status p {
            margin: 0.5rem 0;
        }

        #startButton,
        #stopButton {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            cursor: pointer;
        }

        #stopButton {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>Job Execution Status</h1>
    </div>
    <div id="container">
        <div id="status">
            <p>Completed Jobs: <span id="completed">0</span></p>
            <p>Remaining Jobs: <span id="remaining">0</span></p>
        </div>
        <button id="startButton">Start Execution</button>
        <button id="stopButton">Stop Execution</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var isRunning = false;
            var intervalId;

            function updateStatus() {
                $.ajax({
                    url: "update_status.php",
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#completed").text(data.completed);
                        $("#remaining").text(data.remaining);
                    },
                });
            }

            $("#startButton").click(function() {
                if (!isRunning) {
                    isRunning = true;
                    intervalId = setInterval(function() {
                        updateStatus();
                    }, 2000);
                    executeQueries();
                }
            });

            $("#stopButton").click(function() {
                isRunning = false;
                clearInterval(intervalId);
            });

            function executeQueries() {
                $.ajax({
                    url: "execute_queries.php",
                    method: "GET",
                    success: function() {
                        console.log("All queries executed.");
                    },
                    error: function() {
                        console.log("Error executing queries.");
                    },
                });
            }

            setInterval(function() {
                if (isRunning) {
                    updateStatus();
                }
            }, 2000);
        });
    </script>
</body>

</html>


<?php
$host = "localhost";
$username = "root";
$password = "password";
$database = "job_execution_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$csvFile = "/Users/spartacus/Desktop/Web Development/php/my_project/mastersheet.csv";

if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $header = fgetcsv($handle, 0, "\t"); // Read the header to skip it

    while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
        if (count($data) >= 16) { // Make sure there are enough columns in the data
            $updateSchoolQuery = $data[13];
            $classUpdateQuery = $data[14];
            $userDataUpdateQuery = $data[15];

            if (!empty($updateSchoolQuery)) {
                mysqli_query($conn, $updateSchoolQuery);
            }

            if (!empty($classUpdateQuery)) {
                mysqli_query($conn, $classUpdateQuery);
            }

            if (!empty($userDataUpdateQuery)) {
                mysqli_query($conn, $userDataUpdateQuery);
            }

            if (!$isRunning) {
                break;
            }
        }
    }
    fclose($handle);
} else {
    echo "Error opening CSV file";
}

$conn->close();
