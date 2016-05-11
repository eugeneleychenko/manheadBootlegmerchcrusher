<?php
if (isset($_POST['website'])) {
    include 'connection.php';
    include 'santo/functions.php';
    include 'santo/post.php';
    sqlinsert("emails", $columns, $values);
}





require 'mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

                   

$mail->setFrom('administrator@new-techsoft.com', 'Web-report');
$mail->addAddress('administrator@new-techsoft.com');     // Add a recipient
//$mail->addAddress('santo@live.in');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('santo@live.in');
//$mail->addBCC('bcc@example.com');

$mail->addAttachment('report.pdf');         // Add attachments

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Please find the attachment';
$mail->Body = 'Please find the attachment';
$mail->AltBody = 'Please find the attachment';

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>