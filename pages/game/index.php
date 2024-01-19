
<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h5>Games</h5>
            </div>
            <div>
                <a href="index.php?page=game/create" class="btn btn-primary float-right">
                    Create New Game
                </a>
            </div>
        </div>                                 
        </div>
        <div class="card-body">
        <?php
            $message = isset($_GET['message']) ? urldecode($_GET['message']) : '';
            $error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
            if ($message) {
            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
                            $message
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            } elseif ($error) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            $error
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Game Name</th>
                    <th>Game Type</th>
                    <th>Board Number</th>
                    <th>Max Players</th>
                    <th>Action</th>
                </tr>
            </thead>
                <?php
                    include 'Game.php';
                    $game = new Game();
                    $games = $game->getAllGames();
                    $game->closeConnection();
                ?>
            <tbody>
                <?php foreach ($games as $index => $game): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $game['game_name']; ?></td>
                        <td><?php echo $game['game_type']; ?></td>
                        <td><?php echo $game['board_number']; ?></td>
                        <td><?php echo $game['max_players']; ?></td>
                        <td><a href="index.php?page=game/edit&game_id=<?php echo $game['id']?>" class="btn btn-primary">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        </div>             
    </main>            