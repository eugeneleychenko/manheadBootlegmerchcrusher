<?php

$keys = array_keys($_GET);


foreach ($keys as $value) {

    if (isset($_GET[$value]))
            if ($_GET[$value] != "") {
            $$value = $_GET[$value];
        }
}
?>
