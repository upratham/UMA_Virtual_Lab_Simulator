<?php
session_start();

$sname = "localhost";
$uname = "root";
$db_password = "Captain@56";
$db_name = "virtual_lab_sim";
$db_port = 3307;

// Create a connection
$conn = mysqli_connect($sname, $uname, $db_password, $db_name, $db_port);
if (!$conn) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . mysqli_connect_error()]));
}

// Get data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);
$studentName = $data['student_name'];
$subjectName = $data['subject_name'];
$marks = $data['marks'];

// Check if the record exists
$sql = "SELECT * FROM stud_name WHERE student_name = ? AND subject_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $studentName, $subjectName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing record
    $updateQuery = "UPDATE stud_name SET 
        question_1_marks = ?, question_2_marks = ?, question_3_marks = ?, 
        question_4_marks = ?, question_5_marks = ?, question_6_marks = ?, 
        question_7_marks = ?, question_8_marks = ?, question_9_marks = ?, 
        question_10_marks = ? WHERE student_name = ? AND subject_name = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param(
        "ddddddddddss",
        $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], 
        $marks[5], $marks[6], $marks[7], $marks[8], $marks[9],
        $studentName, $subjectName
    );
    $stmt->execute();
    echo json_encode(["status" => "success", "message" => "Marks updated successfully."]);
} else {
    // Insert new record
    $insertQuery = "INSERT INTO stud_name 
        (student_name, subject_name, question_1_marks, question_2_marks, question_3_marks, 
        question_4_marks, question_5_marks, question_6_marks, question_7_marks, 
        question_8_marks, question_9_marks, question_10_marks) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param(
        "ssdddddddddd",
        $studentName, $subjectName, $marks[0], $marks[1], $marks[2], $marks[3], 
        $marks[4], $marks[5], $marks[6], $marks[7], $marks[8], $marks[9]
    );
    $stmt->execute();
    echo json_encode(["status" => "success", "message" => "Marks inserted successfully."]);
}

$stmt->close();
$conn->close();
?>
