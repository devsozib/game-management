<?php
include 'Game.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_id = isset($_POST["game_id"]) ? $_POST["game_id"] : null;
    $game_name = $_POST["game_name"];
    $game_type = $_POST["game_type"];
    $board_number = $_POST["board_number"];
    $max_players = $_POST["max_players"];

    $db = new Game();

    if ($game_id) {
        if ($db->updateGame($game_id, $game_name, $game_type, $board_number, $max_players)) {
            $message = "Game Update Successful";
            header("Location: ../../index.php?page=game/index&message=" . urlencode($message));
            exit();
        } else {
            $message = "Error: Unable to update the game.";
            header("Location: ../../index.php?page=game/edit&game_id=$game_id&message=" . urlencode($message));
            exit();
        }
    } else {
        if ($db->insertGame($game_name, $game_type, $board_number, $max_players)) {
            $message = "Game Registration Successful";
            header("Location: ../../index.php?page=game/index&message=" . urlencode($message));
            exit();
        } else {
            $message = "Error: Unable to register the game.";
            header("Location: ../../index.php?page=game/create&message=" . urlencode($message));
            exit();
        }
    }

    $db->closeConnection();
} else {
    header("Location: index.php");
    exit();
}
?>
