<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $username = $_SESSION['username'];

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

    // Verify current password
    $stmt = $conn->prepare("SELECT password FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Check if the current password is correct
    if (!password_verify($current_password, $hashed_password)) {
        echo "Current password is incorrect.";
        exit();
    }

    // Check if the new password matches the confirmation
    if ($new_password !== $confirm_password) {
        echo "New password and confirmation do not match.";
        exit();
    }

    // Hash the new password
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $new_hashed_password, $username);

    if ($stmt->execute()) {
        echo "Password changed successfully!";
        header("Location: homepage.php");
        exit();
    } else {
        echo "Error updating password: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
<a href="homepage.php">Back to Homepage</a>
