<?php
// Database credentials
$servername = "localhost";
$username = "root"; // default username for XAMPP MySQL
$password = ""; // default password for XAMPP MySQL is empty
$dbname = "cultivio"; // replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Example query: Select data from a table
$sql = "SELECT * FROM forums"; // replace with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>"; // adjust fields
    }
} else {
    echo "0 results";
}

$conn->close();
