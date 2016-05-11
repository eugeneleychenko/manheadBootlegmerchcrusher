<?php


error_reporting(0);
echo 'xxx';
session_start();




$server_name = 'localhost';



$user_name = 'newteci3_scrap';

$password = 'vOsPByI}!N6-';

$db_name = 'newteci3_scrap';



$conn = mysql_connect($server_name, $user_name, $password) or die("error");

mysql_select_db($db_name, $conn) or die("error");
?>