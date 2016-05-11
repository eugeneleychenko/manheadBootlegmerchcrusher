<?php

$keys = array_keys($_POST);


foreach ($keys as $value) {

   if (isset($_POST[$value]) and ($value!="table") and ($value!="action")and ($value!="id") )
    {   
        
        if(is_array($_POST[$value]))
        
       { $columns[] = $value;
       $vall="";
     
        $key1 = array_keys($_POST[$value]);
       foreach ($key1 as $val) {
           
           $vall= $vall.$_POST[$value][$val].",";
           
           
       }
         $columns[]="'".$vall."'";
        
        
       }
        elseif ($_POST[$value] != "") 
    {     
         
            $columns[] = $value;
            $columns[] = "'" . $_POST[$value] . "'";
           
        
    }
    }
    
}
?>
