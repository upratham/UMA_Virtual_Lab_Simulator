<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'director') {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_username = $_POST['student_username'];
    $student_password = $_POST['student_password'];

    // Database connection settings
    $sname = "localhost";
    $uname = "root";
    $db_password = "Captain@56";
    $db_name = "virtual_lab_sim";

    // Create a connection using the provided settings
    $conn = mysqli_connect($sname, $uname, $db_password, $db_name, 3307);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Hash the password before storing it
    $hashed_password = password_hash($student_password, PASSWORD_DEFAULT);

    // Insert the new student into the users table
    $stmt = $conn->prepare("INSERT INTO users (user_name, password, role) VALUES (?, ?, 'student')");
    $stmt->bind_param("ss", $student_username, $hashed_password);

    if ($stmt->execute()) {
        echo "New student added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
<a href="homepage.php">Back to Homepage</a>
