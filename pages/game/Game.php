<?php
class Game {
    private $conn;

    public function __construct() {
        include __DIR__ . '/../../include/db_connection.php';
        $this->conn = $conn;
    }

    public function insertGame($game_name, $game_type, $board_number, $max_players) {
        $sql = "INSERT INTO games (game_name, game_type, board_number, max_players) VALUES ('$game_name', '$game_type', $board_number, $max_players)";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    public function getAllGames() {
        $result = $this->conn->query("SELECT * FROM games");
        $games = [];

        while ($row = $result->fetch_assoc()) {
            $games[] = $row;
        }

        return $games;
    }

    public function getGameById($id) {
        $result = $this->conn->query("SELECT * FROM games WHERE id=$id");
        if ($result) {
            $game = $result->fetch_assoc();
            $result->free();
    
            return $game;
        } else {
            echo "Error: " . $this->conn->error;
            return null;
        }
    }
    
    public function updateGame($id, $game_name, $game_type, $board_number, $max_players) {
        $sql = "UPDATE games SET 
                game_name = '$game_name',
                game_type = '$game_type',
                board_number = $board_number,
                max_players = $max_players
                WHERE id = $id";
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
