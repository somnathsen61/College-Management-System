<?php
$con=mysqli_connect("localhost","root","","multiusercontrol");
if(!$con){
    die('Could not Connect My Sql:' .mysql_error());
}
   
$enrollment=$_GET['enrollment'];
$data= mysqli_query($con, "DELETE FROM userstudent WHERE enrollment = '$enrollment'");

?>
<script type="text/javascript" >
    window.location="table_student.php";

</script>


