# JobExecutionApp

JobExecutionApp is a PHP-based web application that automates job execution through database operations. It includes a user interface for job tracking, execution control, and real-time status updates using AJAX. The project demonstrates effective database handling, front-end design, and asynchronous communication in a practical scenario.

## Table of Contents

- [Features](#features)
   - [Project Structure](#project-structure)
   - [Functionality](#functionality)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)

## Features
### Project Structure

- `index.php`: This is the main user interface of the application. It provides buttons to start and stop the execution of queries. The completion status is updated dynamically using AJAX.

- `update_status.php`: This script fetches the current job completion status (completed and remaining) from the database and returns the data in JSON format to be displayed on the frontend.

- `execute_queries.php`: This script reads data from a CSV file and executes SQL queries based on that data. It connects to the database, processes each row of the CSV, updates job counts, and handles errors.

- `mastersheet.csv`: This CSV file contains data used to generate SQL queries for execution. Each row corresponds to a set of queries that need to be executed.

### Functionality

#### index.php
- Displays a user-friendly interface with buttons to control query execution.
- Uses AJAX to fetch and display real-time job completion status.
- Provides options to start and stop the execution process.

#### update_status.php
- Retrieves the current job completion status (completed and remaining) from the database.
- Responds to AJAX requests by returning the status data in JSON format.

#### execute_queries.php
- Reads data from the `mastersheet.csv` file.
- Executes three SQL queries for each row of data: updating school data, class data, and user data.
- Updates the "completed" and "remaining" job counts in the database based on query success.
- Handles errors and stops execution if needed.

## Prerequisites

- PHP 7.0 or higher
- MySQL database server
- Web server (e.g., Apache, Nginx)
- Basic knowledge of PHP, MySQL, HTML, and CSS

## Installation

1. Clone this repository:
   ```
   git clone https://github.com/IshaanAdarsh/JobExecutionApp.git
   ```

2. Create a MySQL database and import the provided SQL script located in `database.sql`.

3. Modify the `config.php` file to match your database credentials.

## Usage

1. Access the application by navigating to its root directory using a web browser.

2. The interface will display the count of completed and remaining jobs.

3. Click the "Start Execution" button to begin executing the queries from the CSV file.

4. Click the "Stop Execution" button to halt the execution process.
