<?php

$keys = array_keys($_POST);
foreach ($keys as $value) 
    {

    if (isset($_POST[$value]))
            if ($_POST[$value] != "") 
                
                if (in_array($value, $select))
                {
            $columns[] = $value;
            
                $values[] = "'" . $_POST[$value] . "'";
          
        }
}
?>
