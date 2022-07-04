<?php

$con=mysqli_connect('localhost','root','','multiusercontrol');
$enrollmentNo=$_GET['enrollment'];
$showquery = "SELECT * FROM userstudent WHERE enrollment='$enrollmentNo'";
$showdata = mysqli_query($con,$showquery) or die( mysqli_error($con));;
$row =  mysqli_fetch_assoc($showdata);
$email=$row['email'];

$to          = $email; // addresses to email pdf to
$from        = "somnath@gmail.com"; // address message is sent from
$subject     = "4th Semester Marksheet"; // email subject
$body        = "<p>Dear Student,</p><p>Your fourth Semester marksheet is attach below.Kindly look into it.<p>"; // email body
$pdfLocation = "./certificate/".$enrollmentNo.".pdf"; // file location
$pdfName     = $enrollmentNo.".pdf"; // pdf file name recipient will get
$filetype    = "application/pdf"; // type

// create headers and mime boundry
$eol = PHP_EOL;
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers       = "From: $from$eol" .
  "MIME-Version: 1.0$eol" .
  "Content-Type: multipart/mixed;$eol" .
  " boundary=\"$mime_boundary\"";

// add html message body
  $message = "--$mime_boundary$eol" .
  "Content-Type: text/html; charset=\"iso-8859-1\"$eol" .
  "Content-Transfer-Encoding: 7bit$eol$eol" .
  $body . $eol;

// fetch pdf
$file = fopen($pdfLocation, 'rb');
$data = fread($file, filesize($pdfLocation));
fclose($file);
$pdf = chunk_split(base64_encode($data));

// attach pdf to email
$message .= "--$mime_boundary$eol" .
  "Content-Type: $filetype;$eol" .
  " name=\"$pdfName\"$eol" .
  "Content-Disposition: attachment;$eol" .
  " filename=\"$pdfName\"$eol" .
  "Content-Transfer-Encoding: base64$eol$eol" .
  $pdf . $eol .
  "--$mime_boundary--";

// Send the email
if(mail($to, $subject, $message, $headers)) {
  echo "The email sent successfully.";
}
else {
  echo "There was an error sending the mail.";
}
?>