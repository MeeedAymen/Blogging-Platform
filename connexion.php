<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogging";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection successfully";

$sql = "CREATE DATABASE IF NOT EXISTS blogging";

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>
