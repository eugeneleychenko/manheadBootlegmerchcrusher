<?php

$keys = array_keys($_FILES);
$i = 0;

foreach ($keys as $value) {

    if (isfileset($value)) {
        $nameoftheimage = uploadfile($value, $value . "/" . $iname);
        $columns[] = $value;
        $values[] = "'" . $nameoftheimage . "'";
     }
}
?>
