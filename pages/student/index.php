<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h5>Students</h5>
            </div>
            <div>
                <a href="index.php?page=student/create" class="btn btn-primary float-right">
                    Create New Student
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
                    <th>Student Name</th>
                    <th>Student ID</th>                   
                    <th>Action</th>
                </tr>
            </thead>
                <?php
                    include 'Student.php';
                    $student = new Student();
                    $students = $student->getAllStudents();
                    $student->closeConnection();
                ?>
            <tbody>
                <?php foreach ($students as $index => $student): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $student['student_name']; ?></td>
                        <td><?php echo $student['student_id']; ?></td>                  
                        <td><a href="index.php?page=student/edit&id=<?php echo $student['id']?>" class="btn btn-primary">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        </div>             
    </main>            