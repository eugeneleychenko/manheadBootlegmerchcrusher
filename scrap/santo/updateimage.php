<?php

$keys = array_keys($_FILES);
$i = 0;

foreach ($keys as $value) {

    if (isfileset($value)) {
      $nameoftheimage = uploadimg($value, $value . "/" . $id);
        $columns[] = $value;
        $columns[] = "'" . $nameoftheimage . "'";
    }
}
?>
