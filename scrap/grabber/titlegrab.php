<?php
header("content-type: text/html;charset=windows-1253");
include 'connection.php';
include 'santo/functions.php';
$query = "select id from `property`";
$rows = sqlfetch($query);
 if ($rows != "") 
      {
     $i=0;
     foreach ($rows as $row) {
         $id= $row['id'];
  $url="search_property".$id.".html";
$html=file_get_contents($url);

$new=  explode('document.write("Plot Area:")', $html);
$new=explode('<td valign="top"><span class="property_fact">', $new[1]);
$new=explode('</span></td>', $new[1]);

$title = str_replace("<br />","\r\n",$new[0]);



$columns= array("status",$title);
if(sqlupdate("property", $columns, "id= $id"))
$i++;
 }
     

}
echo $i;











?>