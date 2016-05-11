<?php

$keys = array_keys($_POST);


foreach ($keys as $value) {

    if (isset($_POST[$value]))
            if ($_POST[$value] != "") {
            $column[] = $value;

            $column[] = "'" . $_POST[$value] . "'";
        }
}
?>
