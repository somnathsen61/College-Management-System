<?php
require('vendor/autoload.php');
$con=mysqli_connect('localhost','root','','multiusercontrol');
// $res=mysqli_query($con,"select * from fourthsemres where enrollment='2020CSB094'");
// $enrollment=$_GET['enrollment'];
$enrollmentNo=$_GET['enrollment'];
$showquery = "SELECT * FROM fourthsemres WHERE enrollment='$enrollmentNo'";
$showdata = mysqli_query($con,$showquery) or die( mysqli_error($con));;
$row =  mysqli_fetch_assoc($showdata);

// while($row = mysqli_fetch_assoc($result)){
//     echo "<tr><td>". $row['name']. "</td><td>". $row['enrollment']."</td><td>". $row['algo']. "</td><td>". $row['pp']. "</td><td>". $row['toc'].  "</td><td>". $row['at1']. "</td><td>". $row['ds']. "</td><td>". $row['algoLab']. "</td><td>". $row['ppLab']. "</td><td>". $row['at1Lab']."</td><td>". $row['ppLab']."</td><td><a class='button' href='update1.php?enrollment=$row[enrollment]'>Update"."</td><td><a class='button' href='delete1.php?enrollment=$row[enrollment]'>Delete</td></tr>";
// }

function getCredit($marks){
    if($marks>=50 && $marks<=59){
        return 6;
    }
    else if($marks>=60 && $marks<=69){
        return 7;
    }
    else if($marks>=70 && $marks<=79){
        return 8;
    }
    else if($marks>=80 && $marks<=89){
        return 9;
    }
    else if($marks>=90 && $marks<=100){
        return 10;
    }
}

function getCreditLab($marks){
    $marks=(2*$marks);
    if($marks>=50 && $marks<=59){
        return 6;
    }
    else if($marks>=60 && $marks<=69){
        return 7;
    }
    else if($marks>=70 && $marks<=79){
        return 8;
    }
    else if($marks>=80 && $marks<=89){
        return 9;
    }
    else if($marks>=90 && $marks<=100){
        return 10;
    }
}

function letterGrade($marks){
    if($marks>=50 && $marks<=59){
        return 'D';
    }
    else if($marks>=60 && $marks<=69){
        return 'C';
    }
    else if($marks>=70 && $marks<=79){
        return 'B';
    }
    else if($marks>=80 && $marks<=89){
        return 'A';
    }
    else if($marks>=90 && $marks<=100){
        return 'A+';
    }
    else{
        return 'F';
    }
}

function letterGradeLab($marks){
    if($marks>=10 && $marks<=19){
        return 'C';
    }
    else if($marks>=20 && $marks<=29){
        return 'B';
    }
    else if($marks>=30 && $marks<=39){
        return 'A';
    }
    else if($marks>=40 && $marks<=50){
        return 'A+';
    }
    else{
        return 'F';
    }
}


$totalPoint=(3*getCredit($row['algo']))+(3*getCredit($row['at1']))+(3*getCredit($row['pp']))+(3*getCredit($row['toc']))+(3*getCredit($row['ds']))+(2*getCreditLab($row['algoLab']))+(2*getCreditLab($row['at1Lab']))+(2*getCreditLab($row['ppLab']))+(2*getCreditLab($row['project']));
$cgpa=($totalPoint/240)*10;

if(mysqli_num_rows($showdata)>0){
    $html="<h1 <style>h1{font-size:20px; text-align:center;font-family:Georgia;margin-top:20px;}</style>>Indian Institute of Engineering Science and Technology, Shibpur</h1>";
    $html.="<h4 <style>h4{text-align:center;}</style>>Bachelor of Technology</h4>";
    $html.="<h5 <style>h5{text-align:center;}</style>>[Four-Year Degree Course]</h5>";
    $html.="<h5 <style>h5{text-align:center;}</style>>Fourth Semester Examination,2022</h5>";
    $html.="<h2 <style>h2{font-size:15px;text-align:center;}</style>><ins>Computer Science and Technology<ins></h2>";
    $html.="<br><p <style>p{}</style>>Student Name: ".$row['name']."</p>";
    $html.="<p <style>p{}</style>>Examination Roll No: ".$row['enrollment']."</p>";
    $html.="<p <style>p{}</style>>Registration No: ".$row['enrollment']."</p>";
    $html.="<p <style>p{font-size:12px;}</style>>The following is the statement of Grades obtained by the student in the Fourth Semester of the Academic session 2021-2022 for which the examination was held in May,2022.</p><hr>";

    $html.="<table <style>table{font-size:12px;border-collapse: collapse;}</style>>";
    $html.="<tr><th>Subject Code</th><th class='subName'>Subject Name</th><th>Credit</th><th>Letter Grade</th><th>Total Grade Point Earned</th></tr>";

    $html.="<tr><td>CS2201</td><td class='subName'>Design and Analysis of Algorithm</td><td>3</td><td>".letterGrade($row['algo'])."</td><td>".(3*getCredit($row['algo']))."</td></tr>";

    $html.="<tr><td>CS2202</td><td class='subName'>Computer Architecture and Organization - I</td><td>3</td><td>".letterGrade($row['at1'])."</td><td>".(3*getCredit($row['at1']))."</td></tr>";

    $html.="<tr><td>CS2203</td><td class='subName'>Programming Paradigms</td><td>3</td><td>".letterGrade($row['pp'])."</td><td>".(3*getCredit($row['pp']))."</td></tr>";

    $html.="<tr><td>CS2204</td><td class='subName'>Theory of Computation</td><td>4</td><td>".letterGrade($row['toc'])."</td><td>".(3*getCredit($row['toc']))."</td></tr>";

    $html.="<tr><td>CS2205</td><td class='subName'>Introduction to Data Science</td><td>3</td><td>".letterGrade($row['ds'])."</td><td>".(3*getCredit($row['ds']))."</td></tr>";

    $html.="<tr <style>.blankRow{height:60px ;background-color: #FFFFFF;}</style> class='blankRow'><td colspan='5'>&nbsp;</td></tr>";

    $html.="<tr><td>CS2271</td><td class='subName'>Algorithm Laboratory</td><td>2</td><td>".letterGradeLab($row['algoLab'])."</td><td>".(2*getCreditLab($row['algoLab']))."</td></tr>";

    $html.="<tr><td>CS2272</td><td class='subName'> Computer Architecture and Organization Laboratory</td><td>2</td><td>".letterGradeLab($row['at1Lab'])."</td><td>".(2*getCreditLab($row['at1Lab']))."</td></tr>";

    $html.="<tr><td>CS2273</td><td class='subName'>Programming Paradigms Laboratory</td><td>2</td><td>".letterGradeLab($row['ppLab'])."</td><td>".(2*getCreditLab($row['ppLab']))."</td></tr>";

    $html.="<tr <style>.blankRow{height:30px ;background-color: #FFFFFF;border:0.5px solid white;}</style> class='blankRow'><td colspan='8'>&nbsp;</td></tr>";

    $html.="<tr><td <style>td,th{  border: 0.8px solid black;text-align: center;padding: 5px;}</style>>CS2206</td><td <style>.subName{text-align:left;}</style>class='subName'>Mini Project</td><td>2</td><td>".letterGradeLab($row['project'])."</td><td>".(2*getCreditLab($row['project']))."</td></tr>";

    $html.="</table>";

    $html.="<h3 <style>h3{font-size:12px;text-align:right;margin-right:45px;}</style>>Total:&nbsp;&nbsp;&nbsp;&nbsp;24 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$totalPoint."</h3>";
    $html.="<h6 <style>h6{}</style>>SGPA:&nbsp; ".number_format((float) $cgpa, 2, '.', '')."</h6>";
    $html.="<h6 <style>h6{}</style>>Remark:&nbsp;&nbsp;Pass</h6>";


}
else{
    $html="data not found";
}
// echo $html;
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file=$enrollmentNo.'.pdf';
$mpdf->output($file,'I');
?>
