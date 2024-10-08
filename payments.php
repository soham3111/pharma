<?php
// Database configuration
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "pharma"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from the payments table
$sql = "SELECT id, card_number, expiry_date, cvv, created_at FROM payments";
$result = $conn->query($sql);

// Check if there are results and display them
if ($result->num_rows > 0) {
    // Start the HTML table
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Card Number</th>
                <th>Expiry Date</th>
                <th>CVV</th>
                <th>Created At</th>
            </tr>";

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["card_number"]) . "</td>
                <td>" . htmlspecialchars($row["expiry_date"]) . "</td>
                <td>" . htmlspecialchars($row["cvv"]) . "</td>
                <td>" . htmlspecialchars($row["created_at"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No payment records found.";
}

// Close the database connection
$conn->close();
?>
