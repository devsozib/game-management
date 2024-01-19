<?php
include 'Student.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $student_name = $_POST["student_name"];
    $student_id = $_POST["student_id"];
    $student_db = new Student();

    if ($id) {
        if ($student_db->updateStudent($student_id, $student_name, $id)) {
            $message = "Student Update Successful";
            header("Location: ../../index.php?page=student/index&message=" . urlencode($message));
            exit();
        } else {
            $message = "Error: Unable to update the student.";
            header("Location: ../../index.php?page=student/edit&student_id=$student_id&message=" . urlencode($message));
            exit();
        }
    } else {
        if ($student_db->insertStudent($student_name, $student_id)) {
            $message = "Student Registration Successful";
            header("Location: ../../index.php?page=student/index&message=" . urlencode($message));
            exit();
        } else {
            $message = "Error: Unable to register the student.";
            header("Location: ../../index.php?page=student/register&message=" . urlencode($message));
            exit();
        }
    }

    $student_db->closeConnection();
} else {
    header("Location: index.php");
    exit();
}
?>