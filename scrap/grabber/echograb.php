<?php
header("content-type: text/html;charset=windows-1253");
include 'connection.php';
include 'santo/functions.php';
$query = "select grk from `property` limit 5";
$rows = sqlfetch($query);
 if ($rows != "") 
      {
     $i=0;
     foreach ($rows as $row) {
        
         echo $row['grk']."<br><br><br>";
         
     }
     

}












?>