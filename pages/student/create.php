<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h5>Students</h5>
            </div>
            <div>
                <a href="index.php?page=student/index" class="btn btn-primary float-right">
                    Student List
                </a>
            </div>
        </div>                                 
        </div>
        <div class="card-body">
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h6>Registration New Student</h6>
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
                 <form action="pages/student/handleLogic.php" method="post">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="student_name">Student Name:</label>
                            <input type="text" id="student_name" class="form-control" name="student_name" placeholder="Student Name" required><br>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="student_id">Student ID:</label>
                            <input type="text" id="student_id" class="form-control" name="student_id" placeholder="Student ID" required><br>
                        </div>                                             
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Register Student</button>
                        </div>
                    </div>
                </form>

               
            </div>
        </div>
    </div>
        </div>
        </div>             
    </main>            