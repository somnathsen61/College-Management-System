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
        *{
            padding: 0;
            margin: 0;
            font-family: 'Poppins', sans-serif;
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
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "multiusercontrol";

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

if(isset($_POST['search']))
{
    $search = $_POST['search'];
    $sql = "SELECT * FROM `multiusercontrol`.`userstudent` WHERE CONCAT(`name`,`enrollment`) LIKE '%".$search."%'";
    $result = filterTable($sql);
    
}
else{
    $sql = "SELECT * FROM `multiusercontrol`.`userstudent` WHERE branch='Computer Science and Technology(CST)'";
    $result = filterTable($sql);
}

function filterTable($sql)
{
    $connect = mysqli_connect("localhost", "root", "", "multiusercontrol");
    $filter_Result = mysqli_query($connect, $sql);
    return $filter_Result;
}

if ($result->num_rows > 0) {
?>
    <h3>Details of All Students</h3>
    <form action="teacher_student.php" method="post">
        <div class="search">
            <div class="col-md-4" style="margin-left: auto; margin-right: 0;">
                
                    <div class="input-group mb-3">
                        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search by Name or Enrollment No" >
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                
            </div>
        </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Enrollment No</th>
                <th>Program</th>
                <th>Branch</th>
                <th>Section</th>
                <th>Semester</th>
                <th>SID</th>
                <th>Phone</th>
                <th>Email</th>
            </tr> 

            <?php

            while($row = $result->fetch_assoc()){
                    echo "<tr><td>". $row['name']. "</td><td>". $row['enrollment']."</td><td>". $row['program']. "</td><td>". $row['branch']. "</td><td>". $row['section'].  "</td><td>". $row['semester']. "</td><td>". $row['sid']. "</td><td>". $row['phone']. "</td><td>". $row['email']."</td></tr>";
                }
                echo "</table>";

                $num = mysqli_num_rows($result);
                echo"<h3>&nbsp;&nbsp;Total ". $num;
                echo " records found in the DataBase</h3><br>";  
            ?>

        </table> 
    </form>  

<?php
} else {
  echo "0 results";
}

// $conn->close();
?>

</body>
</html>