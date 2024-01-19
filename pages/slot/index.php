<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h5>Slot Booking</h5>
            </div>
            <div>
            </div>
        </div>                                 
        </div>
        <div class="card-body">
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h6>Slot Booking</h6>
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

                <?php   
                    include __DIR__ .'/../game/Game.php';
                    $game = new Game();
                    $games = $game->getAllGames();
                    $game->closeConnection();
                ?>
                <form action="pages/slot/handleLogic.php" method="post">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="game_name">Select ID:</label>
                            <input type="text" id="id" name="id" class="form-control" placeholder="Enter student ID" required>
                        </div>                       
                                                
                        <div class="col-md-12 mb-3">
                            <label for="max_players">Select Game:</label><br>
                            <select name="game" id="" class="form-control">
                                <option value="">-- Select Game --</option>
                                <?php foreach($games as $game): ?>
                                    <option value="<?php echo $game['id'] ?>"><?php echo $game['game_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="max_players">Booking Date:</label><br>
                            <input name="date" type="date" class="form-control" value="<?php echo (new DateTime())->format('Y-m-d'); ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="max_players">Slot Time:</label><br>
                            <select name="time" id="" class="form-control">
                                <option value="<?php echo 12?>am"><?php echo 12?>am</option>
                                <?php for($i=1;$i<=11; $i++):?>
                                    <option value="<?php echo $i?>am"><?php echo $i?>am</option>
                                <?php endfor;?>
                                
                                <?php for($i=1;$i<=11; $i++):?>
                                    <option value="<?php echo $i?>pm"><?php echo $i?>pm</option>
                                <?php endfor;?>
                                <option value="<?php echo 12?>pm"><?php echo 12?>pm</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Booking</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
        </div>             
    </main>            