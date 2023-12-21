<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Unset the user_id session variable
    unset($_SESSION['user_id']);

    // Your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_sample_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to clear the table
    $sql = "TRUNCATE TABLE cart";

    if ($conn->query($sql) === TRUE) {
        echo "Table cleared successfully";
    } else {
        echo "Error clearing table: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

// Redirect to the login page
header("Location: login.php");
die;
?>