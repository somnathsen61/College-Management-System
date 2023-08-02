<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require '../config.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$con=mysqli_connect('localhost','root','','multiusercontrol');
$enrollmentNo=$_GET['enrollment'];
$showquery = "SELECT * FROM userstudent WHERE enrollment='$enrollmentNo'";
$showdata = mysqli_query($con,$showquery) or die( mysqli_error($con));;
$row =  mysqli_fetch_assoc($showdata);
$email=$row['email'];
$semester = $row['semester'];

function addSuffix($number) {
    switch ($number) {
        case 1:
            return $number . 'st';
        case 2:
            return $number . 'nd';
        case 3:
            return $number . 'rd';
        default:
            return $number . 'th';
    }
}



try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = GMAIL_USERNAME;                     //SMTP username
    $mail->Password   = GMAIL_PASSWORD;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(GMAIL_USERNAME, 'Somnath Sen');
    $mail->addAddress($email);               //Name is optional
    $mail->addReplyTo(GMAIL_USERNAME, 'Somnath Sen');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    
    //Attachments
    $mail->addAttachment("./certificate/".$enrollmentNo.".pdf");         //Add attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject =  addSuffix($semester) . " Semester Marksheet";
    $mail->Body    = "<p>Dear Student,</p><p>Your ". addSuffix($semester) ." Semester marksheet is attach below.Kindly look into it.<p>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}