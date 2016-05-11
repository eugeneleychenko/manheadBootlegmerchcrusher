<?php

$keys = array_keys($_GET);
if(isset($keys[0]))
{
$keypage=$keys[0] . '.php';
 if(file_exists($keypage) )
 { $i = 1;
    include $keypage;
 }
}
if (!isset($i)) include 'dashboard.php';
?>
