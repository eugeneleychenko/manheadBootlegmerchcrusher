<?php

$keys = array_keys($array);


foreach ($keys as $value) {

    if (isset($array[$value]))
       {
       $$value=$array[$value];
        
        }
}
?>

 