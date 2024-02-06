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
    $game_db = new Game();
    $student_db = new Student();
   if(isset($_GET['function']) && $_GET['function'] == "getSlotBookingDetails"){
       $games =  $game_db->getAllGames();
       $students =  $student_db->getAllStudents();
       $tempStudents = [];
       foreach($students as $item){
            $tempStudents[$item['student_id']] = $item['student_name'];
       }
       $tempGames = [];
       foreach($games as $item){
            $tempGames[$item['id']] = $item['game_name'];
       }
        $jsonResponse = getSlotBookingDetails();
        $html = "";
        foreach ($jsonResponse as $index => $game) {
            $html .= "<tr>
                        <td>" . ($index + 1) . "</td>
                        <td>" . (isset($tempGames[$game['game_id']]) ? $tempGames[$game['game_id']] : '') . "</td>
                        <td>" . (isset($tempStudents[$game['student_id']]) ? $tempStudents[$game['student_id']] : '') . "</td>
                    </tr>";
        }
        echo $html;
        exit();
    }
    header("Location: index.php");
}
function getSlotBookingDetails () {
    
    $gameId = ($_GET['gameId']);
    $timestamp = strtotime($_GET['date']);
    $date = date("d-m-Y",$timestamp);   
    $time = ($_GET['time']);
    $slot = new Slot();
    // print_r([$date, $time, $date]);
   return $slot->getSlotBookingsInfo($gameId, $date, $time);

}

?>