<?php
$con = mysqli_connect("localhost", "root", "", "multiusercontrol");
if (!$con) {
    die('Could not Connect My Sql:' . mysqli_error());
}

$id = $_GET['id'];
$data = mysqli_query($con, "DELETE FROM `multiusercontrol`.`userteacher` WHERE id = '$id'");
?>

<script type="text/javascript" >
    window.location="table_teacher.php";
</script>

