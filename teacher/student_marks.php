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
        $subject1 = $_POST['ugSubject1'];
        $enrollment=$_POST['enrollment'];


        if($subject1 == "Design and Analysis of Algorithm"){
            $sql="UPDATE `multiusercontrol`.`fourthsemres`SET `algo`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Programming Paradigms"){
            $sql="UPDATE `multiusercontrol`.`fourthsemres`SET `pp`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Theory of Computation"){
            $sql="UPDATE `multiusercontrol`.`fourthsemres`SET `toc`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Computer Architecture and Organization - I"){
            $sql="UPDATE `multiusercontrol`.`fourthsemres`SET `at1`='$marks' WHERE enrollment='$enrollment'";
        }
        else if($subject1 == "Introduction to Data Science"){
            $sql="UPDATE `multiusercontrol`.`fourthsemres`SET `ds`='$marks' WHERE enrollment='$enrollment'";
        }
        else{
            $sql="UPDATE `multiusercontrol`.`fourthsemres` SET `algo`='$marks' WHERE ugSubject1=$subject1 AND enrollment=$enrollment";
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
        body{
            margin-top:15px;
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
    $subject1 = $_GET['ugSubject1'];
}
$subject2 =$subject1." Lab";

$subjectMarks="";

if($subject1 == "Design and Analysis of Algorithm"){
    $sql = "SELECT * FROM `multiusercontrol`.`fourthsemres`";
    $subjectMarks='algo';
}
else if($subject1 == "Programming Paradigms"){
    $sql = "SELECT * FROM `multiusercontrol`.`fourthsemres`";
    $subjectMarks='pp';
}
else if($subject1 == "Theory of Computation"){
    $sql = "SELECT * FROM `multiusercontrol`.`fourthsemres`";
    $subjectMarks='toc';
}
else if($subject1 == "Computer Architecture and Organization - I"){
    $sql = "SELECT * FROM `multiusercontrol`.`fourthsemres`";
    $subjectMarks='at1';
}
else if($subject1 == "Introduction to Data Science"){
    $sql = "SELECT * FROM `multiusercontrol`.`fourthsemres`";
    $subjectMarks='ds';
}
else if($subject1 == "Mini Project"){
    header("Location: student_marks2.php?ugSubject1=$subject1");
    exit;
}
else{
    echo "There is no Lab for this perticular subject";
    exit;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
<h4>&nbsp;&nbsp;To Enter <?php echo $subject1 ?> Lab marks <a <?php echo " href='student_marks2.php?ugSubject1=$subject2'" ?>>Click Here</a> </h4>
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
                    <!-- echo "<tr><td>". $row['name']."</td><td>". $row['program']. "</td><td>". $row['section']. "</td><td>". $row['enrollment']."</td><td>".$subject1."</td><td><a class='button' href='update1.php?id=$row[id]'>Update"."</td></tr>"; -->
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['enrollment'] ?></td>
                    <td><?php echo $subject1 ?></td>
                   <td class="enterMarks"> 
                   <form  action="student_marks.php" method="post">
                    <div class="col-md" style="margin-left: auto; margin-right: auto;">
                        <div class="input-group">
                            <input type="text" name="marks" value="<?php echo $row[$subjectMarks] ?>" class="form-control" required>
                            <input type="hidden" name="enrollment" value="<?php echo $row['enrollment']; ?>"/>
                            <input type="hidden" name="ugSubject1" value="<?php echo $subject1 ?>"/>
                            <span class="input-group-text">/100</span>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Enter</button>
                            </div>
                            <!-- <a <?php echo "class='btn btn-primary' href='submit_result.php?enrollment=$row[enrollment]&ugSubject1=$subject1' role='button'" ?>>Enter</a> -->
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
<?php
} else {
  echo "0 results";
}

$conn->close();
?>

</body>
</html>
