<?php

include 'header.php';










require 'mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

                   

$mail->setFrom('song07121987@gmail.com', 'Web-report');
if (isset($_POST['email'])) {
    $rows = $_POST['email'];
    foreach ($rows as $row) {
        $mail->addAddress($row);

        $query = "select * from `contacts` where email='$row' ";

        $rows = sqlfetchs($query);
        if ($rows != "") {
            $website = $rows['website'];
            $query = "INSERT INTO `emails`(`website`) VALUES ('$website')";
            mysql_query($query);
        }
    }
}
// Add a recipient
             // Name is optional
             $mail->addReplyTo('song07121987@gmail.com', 'Web-report');
             //$mail->addCC('santo@live.in');
//$mail->addBCC('bcc@example.com');

$mail->addAttachment('report.pdf');         // Add attachments

$mail->isHTML(true);                                  // Set email format to HTML
$query = "select * from `mailcontent` where id=1";
$rows = sqlfetchs($query);
if ($rows != "") {
    $array = $rows;
    include 'santo/arraynames.php';
}
$mail->Subject = $mailsubject;
$mail->Body = $mailcontent;
$mail->AltBody = $mailsubject;

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script> alert("Message has been sent"); </script>';
}
include 'footer.php';
?>