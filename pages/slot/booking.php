<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h5>My Booking Slot</h5>
            </div>
            <div>
                <a href="index.php?page=slot_booking/index" class="btn btn-primary float-right">
                    
                </a>
            </div>
        </div>                                 
        </div>
        <div class="card-body">
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h6>Registration New Game</h6>
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
                <form action="pages/game/handleLogic.php" method="post">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="game_name">Game Name:</label>
                            <input type="text" id="game_name" name="game_name" class="form-control" placeholder="Enter game name" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="game_type">Game Type:</label>
                            <input type="text" id="game_type" name="game_type" class="form-control" placeholder="Enter game type" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="board_number">Board Number:</label>
                            <input type="number" id="board_number" name="board_number" class="form-control" placeholder="Enter board number" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="max_players">Max Players:</label>
                            <input type="number" id="max_players" name="max_players" class="form-control" placeholder="Enter max players" required>
                        </div>

                        <!-- Add other relevant fields as needed -->

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Register Game</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
        </div>             
    </main>            