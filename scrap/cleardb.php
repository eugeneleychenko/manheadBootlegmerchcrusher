<?php

include 'header.php';
ini_set('max_execution_time', 3000);

$query = "DELETE FROM `datas` WHERE 1";
mysql_query($query);


include 'footer.php';
?>