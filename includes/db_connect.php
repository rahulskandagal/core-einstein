<?php
/**
 * Database Connection File
 * Tourism Destination Management System
 */

// Reads from environment (Docker) and falls back to XAMPP defaults.
$host     = getenv("DB_HOST") ?: "localhost";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASS") ?: "";
$dbname   = getenv("DB_NAME") ?: "tourism_db";

$db_error = false;
try {
    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);
    // Set character set to utf8mb4
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    $db_error = true;
    error_log("Connection failed: " . $e->getMessage());
    $conn = null; 
}

// Function to clean input data to prevent SQL injection (basic layer)
function clean_input($data, $conn) {
    if ($data === null) return "";
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}
?>