<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h5>Slot booking details</h5>
            </div>
            <div>
                <a href="index.php?page=slot/index" class="btn btn-primary float-right">
                    Booking slot
                </a>
            </div>
        </div>                                 
        </div>
        <div class="card-body">
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">  
                <div class="row">
                    <?php   
                        include __DIR__ .'/../game/Game.php';
                        $game = new Game();
                        $games = $game->getAllGames();
                        $game->closeConnection();
                    ?>
                    <div class="col-3">
                        <select class="form-select" id="game" aria-label="Default select example">
                            <option selected>--Select Game--</option>
                            <?php foreach($games as $game): ?>
                                    <option value="<?php echo $game['id'] ?>"><?php echo $game['game_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" id="date" value="">
                    </div>
                    <div class="col-3" >                                          
                        <select name="time" id="time" class="form-control">
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
                    <div class="col-3" >
                        <input type="button" class="btn btn-primary" value="Display" onclick="getBookingDetails()">
                    </div>
                </div>                  
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Game</th>
                            <th>Student</th>                                                       
                        </tr>
                    </thead>
                    
                    <tbody id="bookingDetailsTB">
                        
                    </tbody>
                </table>             
            </div>
        </div>
    </div>
        </div>
        </div>             
    </main>            
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function getBookingDetails () {
            var gameId = document.getElementById('game').value;
            var date = document.getElementById('date').value;
            var time = document.getElementById('time').value;
            // console.log(gameId, date, time);
            $.ajax({
                method: "get",
                url: 'pages/slot/handleLogic.php',
                data: {
                    function: "getSlotBookingDetails",
                    gameId:gameId,
                    date:date,
                    time:time
                }
            })
            .done(function(response) {
                console.log(response);
                document.getElementById('bookingDetailsTB').innerHTML = response;
            });
            
        }
    </script>