# JobExecutionApp

JobExecutionApp is a PHP-based web application that automates job execution through database operations. It includes a user interface for job tracking, execution control, and real-time status updates using AJAX. The project demonstrates effective database handling, front-end design, and asynchronous communication in a practical scenario.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)

## Features

- Automates execution of SQL queries from a CSV file
- Provides a user interface to start and stop the execution process
- Real-time updates on the status of completed and remaining jobs
- Demonstrates effective use of PHP, MySQL, HTML, CSS, and AJAX

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
