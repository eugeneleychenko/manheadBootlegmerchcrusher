<?php

ob_start();
session_start();

$server_name = 'localhost';
//$user_name = '';
//$password = '';
//$db_name = 'selected';
$user_name = 'root';
$password = '';
$db_name = 'rowsport';
$conn = mysql_connect($server_name, $user_name, $password);
mysql_select_db($db_name, $conn);
?>