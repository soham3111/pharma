<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "pharma"; // Your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Debugging statement
    echo "Connected successfully"; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve payment details from the form
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Simulate payment processing
    if (!empty($card_number) && !empty($expiry_date) && !empty($cvv)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO payments (card_number, expiry_date, cvv) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error)); // Output the error
        }

        // Bind parameters
        $stmt->bind_param("sss", $card_number, $expiry_date, $cvv);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to thank you page after successful payment
            header("Location: thankyou.php?order=done");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Payment failed. Please try again.";
    }
} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
