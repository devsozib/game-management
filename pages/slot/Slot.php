<?php
class Slot {
    private $conn;

    public function __construct() {
        include __DIR__ . '/../../include/db_connection.php';
        $this->conn = $conn;
    }

    public function getSlotBookingsInfo($game_id, $date, $time){
        $result = $this->conn->query("SELECT * FROM slots WHERE game_id=$game_id and date='$date' and time='$time'");
        $slots = [];

        while ($row = $result->fetch_assoc()) {
            $slots[] = $row;
        }

        return $slots;
    }

    public function bookedSlot($game_id, $student_id, $date, $time){
        $sql = "INSERT INTO slots (game_id, student_id, date, time) VALUES ('$game_id', '$student_id', '$date', '$time')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
