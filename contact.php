<?php
// Database connection parameters
$host = "your_database_host";
$username = "your_database_username";
$password = "your_database_password";
$database = "your_database_name";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data));
}

// Initialize variables to store error messages
$errors = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = sanitizeInput($_POST["full_name"]);
    $email = sanitizeInput($_POST["email"]);
    $date = sanitizeInput($_POST["date"]);
    $message = sanitizeInput($_POST["message"]);

    // Validate data
    if (empty($fullName)) {
        $errors["full_name"] = "Full Name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Valid email is required.";
    }

    // Add additional validation for other fields if needed

    // If there are no errors, insert data into the database
    if (empty($errors)) {
        $sql = "INSERT INTO your_table_name (full_name, email, date, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fullName, $email, $date, $message);

        if ($stmt->execute()) {
            $response = array("status" => "success", "message" => "Data successfully stored.");
            echo json_encode($response);
        } else {
            $response = array("status" => "error", "message" => "Error storing data in the database.");
            echo json_encode($response);
        }

        $stmt->close();
    } else {
        // If there are errors, return the error messages
        $response = array("status" => "error", "errors" => $errors);
        echo json_encode($response);
    }
}

// Close the database connection
$conn->close();

?>
