<?php
   $insert = false;
   $server="localhost";   
   $username="root";
   $password="";
   $database="multiusercontrol";

   $con = mysqli_connect($server,$username,$password,$database);
   if(!$con){
       die("Connection to the database is failed due to" . mqsqli_connect_error());
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="register_student.css">
</head>

<body>
    <form method="post" class="form-horizontal front-page">
        <h1>Update Subject Details</h1>
        <?php
            if($insert == true){
            echo "<p class='submitted'>Your details are successfully Updated.</p>";
            }
        ?>

        <?php
            $idNo=$_GET['id'];
            $showquery = "SELECT * FROM teachersubject WHERE id='$idNo'";
            $showdata = mysqli_query($con,$showquery) or die( mysqli_error($con));;
            $row =  mysqli_fetch_assoc($showdata);

        if(isset($_POST['ugSubject1'])){
            $id= $_GET['id'];
            $pgSubject1=$_POST['pgSubject1'];
            $pgSubject2=$_POST['pgSubject2'];
            $ugSubject1=$_POST['ugSubject1'];
            $ugSubject2=$_POST['ugSubject2'];
            $ugSubject3=$_POST['ugSubject3'];

        $sql= "UPDATE `multiusercontrol`.`teacherSubject` SET `pgSubject1`='$pgSubject1',`pgSubject2`='$pgSubject2', `ugSubject1`='$ugSubject1', `ugSubject2`='$ugSubject2',`ugSubject3`='$ugSubject3' WHERE id='$id'";
        
        if($con->query($sql) == true){
            echo "<p style='color:green; text-align:center;'>Successfully Updated</p>";
            $insert = true;
        }
        else{
            echo "ERROR: $sql <br> $con->error";
        }
        $con->close();
        }
        ?>
        
        <div class="form-group">
            <label class="col-sm control-label">Teacher Name</label>
            <div class="col-sm">
                <input type="text" name="name" class="form-control" placeholder="Enter student name" value="<?php echo $row['name']; ?>" required disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm control-label">ID</label>
            <div class="col-sm">
                <input type="text" name="id" class="form-control" placeholder="Enter ID no" value="<?php echo $row['id']?>" required disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm control-label">Email</label>
            <div class="col-sm">
                <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $row['email']?>" required disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm control-label">PG Subject 1</label>
            <div class="col-sm">
                <input type="text" name="pgSubject1" class="form-control" placeholder="Enter pgSubject1" value="<?php echo $row['pgSubject1']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm control-label">pgSubject2</label>
            <div class="col-sm">
                <input type="text" name="pgSubject2" class="form-control" placeholder="Enter pgSubject2" value="<?php echo $row['pgSubject2']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm control-label">ugSubject1</label>
            <div class="col-sm">
                <input type="text" name="ugSubject1" class="form-control" placeholder="Enter ugSubject1" value="<?php echo $row['ugSubject1']?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm control-label">ugSubject2</label>
            <div class="col-sm">
                <input type="text" name="ugSubject2" class="form-control" placeholder="Enter ugSubject2" value="<?php echo $row['ugSubject2']?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm control-label">ugSubject3</label>
            <div class="col-sm">
                <input type="text" name="ugSubject3" class="form-control" placeholder="Enter ugSubject3" value="<?php echo $row['ugSubject3']?>" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <input type="submit" name="btn_update" class="btn btn-primary" value="Update">
                <a class="btn btn-warning" href="table_subject.php" role="button">Back</a>
            </div>
        </div>
        <br>
    </form>
</body>

</html>

