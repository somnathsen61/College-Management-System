<?php
session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"multiusercontrol");
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Page</title>
    <link rel="stylesheet" href="teacher_teaching.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        a{
            text-decoration:none;
        }
    </style>
</head>

<body>
    <section id="title">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="teacher_page.php">Teacher Page</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav me-2">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="teacher_page.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="teacher_notification.php">Notifictation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="teacher_teaching.php">Teaching</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="teacher_student.php">Student</a>
                        </li>
                    </ul>
                </div>
                <form form action="logout.php" method="post"  class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        </nav>
    </section>

    <section id="content">

    <?php
        $query = "select ut.*,uts.* from userteacher ut, teachersubject uts where ut.email = uts.email AND ut.email = '$_SESSION[email]'";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)) 
        {
	?>
        <div class="container-fluid row teacher-body">
            <div class="card left">
                <!-- <img src="" class="card-img-top" alt="..."> -->
                <div class="teacher-title">
                    <i class="fas fa-user teacher-img"></i>
                    <h5 class="card-title teacher-name"><?php echo $row['name']?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                    <p><b><?php echo $row['position']?></b></p>
                    <p><b><?php echo $row['department']?></b></p>
                    <p><i class="fas fa-phone"></i><?php echo $row['phone']?></p>
                    <p><i class="fas fa-envelope"></i>  <?php echo $row['email']?></p>
                    </p>
                </div>
            </div>
            <div class="card right">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i>  Teaching</h3><br>
                    <table>
                        <tr>
                            <th>PG Courses</th>
                            <th>UG Courses</th>
                        </tr>

                        <tr>
                            <td>
                                <ol>
                                    <?php if (!empty($row['pgSubject1'])): ?>
                                        <li><a href=""><?php echo $row['pgSubject1']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if (!empty($row['pgSubject2'])): ?>
                                        <li><a href=""><?php echo $row['pgSubject2']; ?></a></li>
                                    <?php endif; ?>
                                </ol>
                            </td>
                            <td>
                                <ol>
                                    <!-- <li><?php echo "<a href='student_marks.php?ugSubject=$row[ugSubject1]'>$row[ugSubject1]</a>"; ?></li> -->
                                    
                                    <li>
                                        <?php
                                            $subject = $row['ugSubject1'];
                                            $url = '';

                                            if ($subject == 'Design and Analysis of Algorithm' || $subject == 'Programming Paradigms' || $subject == 'Theory of Computation' || $subject == 'Computer Architecture and Organization - I' || $subject == 'Introduction to Data Science') {
                                                $url = 'student_marks_4th_CST.php';
                                            } 
                                            elseif ($subject == 'Operating Systems' || $subject == 'Data Communication and Computer Network' || $subject == 'Software Engineering' || $subject == 'Information Security and Cryptography' || $subject == 'Nature Inspired Algorithm') {
                                                $url = 'student_marks_6th_CST.php';
                                            }
                                            echo "<a href='$url?ugSubject=$subject'>$subject</a>";
                                        ?>
                                    </li>

                                    <!-- <li><a href=""><?php echo $row['ugSubject2']; ?></a></li> -->
                                    <li>
                                        <?php
                                            $subject = $row['ugSubject2'];
                                            $url = '';

                                            if ($subject == 'Design and Analysis of Algorithm' || $subject == 'Programming Paradigms' || $subject == 'Theory of Computation' || $subject == 'Computer Architecture and Organization - I' || $subject == 'Introduction to Data Science') {
                                                $url = 'student_marks_4th_CST.php';
                                            } 
                                            elseif ($subject == 'Operating Systems' || $subject == 'Data Communication and Computer Network' || $subject == 'Software Engineering' || $subject == 'Information Security and Cryptography' || $subject == 'Nature Inspired Algorithm') {
                                                $url = 'student_marks_6th_CST.php';
                                            }
                                            echo "<a href='$url?ugSubject=$subject'>$subject</a>";
                                        ?>
                                    </li>

                                    <?php if (!empty($row['ugSubject3'])): ?>
                                        <li><a href=""><?php echo $row['ugSubject3']; ?></a></li>
                                    <?php endif; ?>
                                </ol>
                            </td>
                        </tr>

                    </table>
                    <br><br>
                    <p>Click on the subject to enter the marks of the students of that perticular subject</p>
                    </p>
                </div>
            </div>
        </div>

    <?php
        }	
    ?>
    </section>


</body>