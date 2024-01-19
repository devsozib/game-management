<?php
class Student {
    private $conn;

    public function __construct() {
        include __DIR__ . '/../../include/db_connection.php';
        $this->conn = $conn;
    }

    public function insertStudent($name, $student_id) {
        $sql = "INSERT INTO students (student_name, student_id) VALUES ('$name', '$student_id')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    public function getAllStudents() {
        $result = $this->conn->query("SELECT * FROM students");
        $students = [];

        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }

        return $students;
    }
    public function getStudentById($id) {
        $result = $this->conn->query("SELECT * FROM students WHERE id=$id");

        if ($result) {
            $student = $result->fetch_assoc();
            $result->free();
    
            return $student;
        } else {
            echo "Error: " . $this->conn->error;
            return null;
        }
    }
    public function getStudentByStudentId($id) {
        $result = $this->conn->query("SELECT * FROM students WHERE student_id=$id");
        if ($result) {
            $student = $result->fetch_assoc();
            $result->free();
    
            return $student;
        } else {
            echo "Error: " . $this->conn->error;
            return null;
        }
    }
    public function updateStudent($student_id, $student_name, $id) {
        $sql = "UPDATE students SET student_name='$student_name', student_id='$student_id' WHERE id=$id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error updating record: " . $this->conn->error;
            return false;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
