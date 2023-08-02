<?php
    if(isset($_POST['marks'])){
        $server="localhost";   
        $username="root";
        $password="";

        $con=mysqli_connect($server,$username,$password);
        if(!$con){
            die("Connection to the dats base is failed due to" . mqsqli_connect_error());
        }

        $marks=$_POST['marks'];
        $subject1 = $_POST['ugSubject'];
        $enrollment=$_POST['enrollment'];


        if($subject1 == "Operating Systems"){
            $sql="UPDATE `multiusercontrol`.`sixthsemcst`SET `os`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Data Communication and Computer Network"){
            $sql="UPDATE `multiusercontrol`.`sixthsemcst`SET `cn`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Software Engineering"){
            $sql="UPDATE `multiusercontrol`.`sixthsemcst`SET `swe`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Information Security and Cryptography"){
            $sql="UPDATE `multiusercontrol`.`sixthsemcst`SET `crypto`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Nature Inspired Algorithm"){
            $sql="UPDATE `multiusercontrol`.`sixthsemcst`SET `nia`='$marks' WHERE enrollment='$enrollment'";
        }
        else{
            echo "Error.";
            exit;
        }

        if($con->query($sql) == true){
            // echo"Succesfully inserted";
            $insert = true;
        }
        else{
            echo "ERROR: $sql <br> $con->error";
        }
        $con->close();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<style>
        * {
            padding: 0;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .divTable{
            margin-top:30px;
            margin-left:150px;
            margin-right:60px;
        }
        h4{
            margin-bottom:30px;
        }
        table{
            border:2px solid black;
            border-collapse:collapse;
            width:90%;
            font-family: 'Ubuntu', sans-serif;
            font-size: 25px;
            text-align:left;
            margin-left:15px;
        }
        th{
            background-color: lightblue;
            border:2px solid black;
        }
        td{
            border:2px solid black;
        }
        tr:nth-child(odd){
            background-color: lightblue;
        }
        .button{
            position: relative;
            left:0px;
            background-color:red;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius:15px;
        }
        .search{
            margin-top: 20px;
        }
        .enterMarks{
            width:18%;
        }
    </style>
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


    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "multiusercontrol";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    if(!isset($_POST['marks'])){
        $subject1 = $_GET['ugSubject'];
    }

    $subject2 =$subject1." Lab";

    $subjectMarks="";

    if($subject1 == "Operating Systems"){
        $subjectMarks='os';
    }
    else if($subject1 == "Data Communication and Computer Network"){
        $subjectMarks='cn';
    }
    else if($subject1 == "Software Engineering"){
        $subjectMarks='swe';
    }
    else if($subject1 == "Information Security and Cryptography"){
        $subjectMarks='crypto';
    }
    else if($subject1 == "Nature Inspired Algorithm"){
        $subjectMarks='nia';
    }
    else{
        echo "Got Some Error.";
        exit;
    }

    $sql = "SELECT * FROM `multiusercontrol`.`sixthsemcst`";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
    <h4>&nbsp;&nbsp;To Enter <?php echo $subject1 ?> Lab marks <a <?php echo " href='student_marks_lab_6th_CST.php?ugSubject=$subject2'" ?>>Click Here</a> </h4>
            <div class="divTable">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Enrollment No</th>
                    <th>Subject</th>
                    <th>Enter Marks</th>
                </tr> 

                <?php

                while($row = $result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['enrollment'] ?></td>
                        <td><?php echo $subject1 ?></td>
                    <td class="enterMarks"> 
                    <form action="student_marks_6th_CST.php?ugSubject=<?php echo $subject1 ?>" method="post">
                        <div class="col-md" style="margin-left: auto; margin-right: auto;">
                            <div class="input-group">
                                <input type="text" name="marks" value="<?php echo $row[$subjectMarks] ?>" class="form-control" required>
                                <input type="hidden" name="enrollment" value="<?php echo $row['enrollment']; ?>"/>
                                <input type="hidden" name="ugSubject" value="<?php echo $subject1 ?>"/>
                                <span class="input-group-text">/100</span>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Enter</button>
                                </div>
                                <div class="search">
                            </div>
                        </div>
                        </form>   
                        </td>
                    </tr>
                    
                <?php
                    }

                    echo "</table>";

                    $num = mysqli_num_rows($result);
                    echo"<h4>&nbsp;&nbsp;Total ". $num;
                    echo " records found in the DataBase</h4><br>";  
                ?>

            </table> 
            </div>
    <?php
    } else {
    echo "0 results";
    }

    $conn->close();
    ?>

</body>
</html>
