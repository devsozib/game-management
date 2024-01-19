<?php
include __DIR__ .'/../student/Student.php';
include __DIR__ .'/../game/Game.php';
include __DIR__ .'/Slot.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id =  $_POST["id"];
    $game_id = $_POST["game"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $student_id = trim($student_id);
    $timestamp = strtotime($date);
    $date = date("d-m-Y", $timestamp);
    $student_db = new Student();
    $game_db = new Game();
    $slot_db = new Slot();

    $student = $student_db->getStudentByStudentId($student_id);
    if(!$student){
        $message = "Student not found";
        header("Location: ../../index.php?page=slot/index&message=" . urlencode($message));
        exit();
    }
    $game = $game_db->getGameById($game_id);

    if(!$game){
        $message = "Game not found";
        header("Location: ../../index.php?page=slot/index&message=" . urlencode($message));
        exit();
    }

    $bookingsInfo = $slot_db->getSlotBookingsInfo($game_id,$date,$time);
    foreach($bookingsInfo as $info){
        if($info['student_id'] == $student_id){
            $message = "You are Already booked this slot for this game";
            header("Location: ../../index.php?page=slot/index&error=" . urlencode($message));
            exit();
        }
    }

    if($game['max_players']  >  count($bookingsInfo)){
        $result = $slot_db->bookedSlot($game_id,$student_id,$date,$time);
        if($result){
            $message = "Slot booked successfully";
            header("Location: ../../index.php?page=slot/index&message=" . urlencode($message));
            exit();
        }else{
            $message = "Invalid Operation";
            header("Location: ../../index.php?page=slot/index&error=" . urlencode($message));
            exit();
        }
    }else{
        $message = "Another student has already booked the same slot";
        header("Location: ../../index.php?page=slot/index&error=" . urlencode($message));
        exit();
    }

    $student_db->closeConnection();
    $game_db->closeConnection();
    $slot_db->closeConnection();
} else {
    header("Location: index.php");
    exit();
}
?>