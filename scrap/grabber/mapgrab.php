<?php

  $url="search_property".$id.".html";
$html=file_get_contents($url);

$rows=  explode('<td align="left" width="34%" class="property_feature">', $html);

if (isset($rows[2]))
{
    $lis= explode('<li class="property_feature">', $rows[2]);
    $features= "";
    unset($lis[0]);
    foreach ($lis as $li)
    {$name=explode('</li>', $li);
       $features = $features.",". $name[0];
    }
   
$columns= array("inclusions",$features);
if(sqlupdate("property", $columns, "id= $id"))
$i++;
}


 }
     

}
echo $i;











?>