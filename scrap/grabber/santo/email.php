<?php
ob_start("ob_gzhandler");
?>

<?php
include "../connection.php";
$email_from = "admin@renugaautofin.com"; // The email you are sending from (example)
$email_subject = "renugaautofin.com"; // The Subject of the email
$email_txt = "Sent from renugaautofin.com, Please find the attachment"; // Message that the email has in it
$fileatt = "../mpdf/pdf.pdf"; // Path to the file (example)
$fileatt_type = "application/pdf"; // File Type
$fileatt_name =  "pdf.pdf"; // Filename that will be used for the file as the attachment
$file = fopen($fileatt,'rb');
$data = fread($file,filesize($fileatt));
fclose($file);
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers="From: $email_from"; // Who the email is from (example)
$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";
$email_message .= "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $email_txt;
$email_message .= "\n\n";
$data = chunk_split(base64_encode($data));
$email_message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"--{$mime_boundary}--\n";

$query = mysql_query("select * from `accounts` where a_id=1");
if(mysql_num_rows($query)>0)
{
$rows = mysql_fetch_array($query);
for($i=0;$i<6;$i++)
{
$email_to = $rows[$i]; // The email you are sending to (example)

if(mail($email_to,$email_subject,$email_message,$headers))
{
	echo "mail send to". $rows[$i]."<br>";
}
else
{
	echo "try again<br>";
}
}
?>
<a href="../home.php">Back To Home</a>
<?php
}
?>