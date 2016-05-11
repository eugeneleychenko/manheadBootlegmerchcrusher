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

$rows=  explode('document.write("Bathrooms:")', $html);

if (isset($rows[1]))
{
    $lis= explode('<td valign="top"><span class="property_fact">', $rows[1]);
    $li=  explode('</span>', $lis[1]);
   $features=$li[0];
$columns= array("bathroom",$features);
if(sqlupdate("property", $columns, "id= $id"))
$i++;
}


 }
     

}
echo $i;











?>