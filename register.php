<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Database connection settings
    $sname = "localhost";
    $uname = "root";
    $db_password = "Captain@56";
    $db_name = "virtual_lab_sim";

    // Create a connection
    $conn = mysqli_connect($sname, $uname, $db_password, $db_name, 3307);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username already exists
        echo "Username already taken. Please choose a different one.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (user_name, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);

        if ($stmt->execute()) {
            echo "Registration successful! <a href='index.html'>Click here to login</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
