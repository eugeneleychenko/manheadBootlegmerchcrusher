<?php

include 'header.php';




echo '<div style="margin-left:20%; margin-right:30px;">';





require 'mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

                   

$mail->setFrom('administrator@new-techsoft.com', 'Web-report');

$query = "select * from `datas`";
$rows = sqlfetchs($query);
if ($rows != "") {
    $website = $rows['website'];
    $brand = $rows['brand'];
}
$query = "select * from `contacts` where website='$website'";
$rowss = sqlfetch($query);
if ($rowss != "") {
    foreach ($rowss as $row) {
        $rows[] = $row['email'];
    }
}
 $mail->addAddress($rows[0]);
foreach ($rows as $row) {
        $mail->addCC($row);
            $query = "INSERT INTO `emails`(`website`) VALUES ('$website')";
            mysql_query($query);
        
    }

// Add a recipient
             // Name is optional
             $mail->addReplyTo('administrator@new-techsoft.com', 'Web-report');
             //$mail->addCC('santo@live.in');
//$mail->addBCC('bcc@example.com');

$mail->addAttachment('report.pdf');         // Add attachments

$mail->isHTML(true);

if ($website == "etsy" and $brand == "fall+out+boy")
    $id = 1;
if ($website == "etsy" and $brand == "panic+at+the+disco")
       $id = 3;
if ($website == "etsy" and $brand == "30+seconds+to+mars")
       $id = 2;
if ($website == "redbubble" and $brand == "fall+out+boy")
  $id = 6;
if ($website == "redbubble" and $brand == "panic+at+the+disco")
    $id = 4;
if ($website == "redbubble" and $brand == "30+seconds+to+mars")
    $id = 5;




// Set email format to HTML
$query = "select * from `mailcontent` where id=$id";
$rows = sqlfetchs($query);
if ($rows != "") {
    $array = $rows;
    include 'santo/arraynames.php';
}
$etsy = 'https://www.etsy.com/search/search?q=' . $brand;
$redb = "http://www.redbubble.com/shop/" . $brand;
$brand = str_replace("+", " ", $brand);
$mailcontent = "<b>" . $mailcontent;
$signature = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$signature = str_replace("email.php", "", $signature);
$mailcontent = str_replace("ddddd", date('Y-m-d'), $mailcontent);
$mailcontent = str_replace("sssss", '<img src="' . $signature . 'foot-logo.png" alt="" >', $mailcontent);
$mailcontent = str_replace("To whom it may concern:", "</b>To whom it may concern:", $mailcontent);
if ($website == "etsy")
    $mailcontent = str_replace("URLL.", $etsy, $mailcontent);
if ($website == "redbubble")
    $mailcontent = str_replace("URLL.", $redb, $mailcontent);


echo $hdr = '<html><body style="min-height:1200px;"><h2><b>Scott H. Bradford </b></h2>
<h3>Attorney at Law</h3>
<div style = "width:100%;" align = "right">

14622 VENTURA BLVD., UNIT #2026 SHERMAN OAKS, CA 91403 <br>
        P - 818.847.0357 / F – 818.232.9159 / SCOTT@SCOTTBRADFORDLAW.COM

</div>
        <hr>
        ' . nl2br($mailcontent) . '
</body></html >';
        $mail->Subject = $mailsubject;
        $mail->Body = $hdr;
$mail->AltBody = $mailsubject;
if (isset($_POST['send'])) {
    if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script> alert("Message has been sent"); </script>';
}
} else {
    ?>


<form action="" enctype="multipart/form-data" method="post"  align="center">
    <input type="Submit" name="send" Value="Send Email">
    

</form>
        <?php
}
echo '</div>';
include 'footer.php';
?>