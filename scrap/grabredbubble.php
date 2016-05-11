<?php

include 'header.php';
ini_set('max_execution_time', 3000);

function getbetween($string, $from, $to) {
    

    $content = explode($from, $string);

    //print_r($content);
    $seccontent = explode($to, $content[1]);


    return $seccontent[0];
}

$terms[] = "panic+at+the+disco";
$terms[] = "fall+out+boy";
$terms[] = "30+seconds+to+mars";

foreach ($terms as $term) {
    


$j = 1;

while ($j >= 1) {
    $url = "http://www.redbubble.com/shop/" . $term . "?page=" . $j;
        $html = file_get_contents($url);
        $html = explode("data-rb-product-search-results", $html);
        $html = $html[1];


        $rows = explode('<a href=', $html);
        $i = 1;
foreach ($rows as $row) {
    if ($i > 1)
    {
                if (issubstring("grid-item hover", $row)) {
                    $link = "http://www.redbubble.com" . getbetween($row, '"', '"');
                $img = getbetween($row, 'src="', '"');
                $title = getbetween($row, 'title="', '"');
                $date = date('Y-m-d');
        $website = "redbubble";
                $brand = str_replace("-"," ", $term);

                $query = "select * from `datas` where link='$link'";

                $rows = sqlfetch($query);
                if ($rows != "") {

                }




                else {
                    
                    $columns[] = "link";
                    $columns[] = "image";
                    $columns[] = "title";
                    $columns[] = "website";
                    $columns[] = "date";
                    $columns[] = "brand";

                    $values[] = "'" . $link . "'";
                    $values[] = "'" . $img . "'";
                    $values[] = "'" . $title . "'";
                    $values[] = "'" . $website . "'";
                    $values[] = "'" . $date . "'";
                    $values[] = "'" . $brand . "'";
                    sqlinsert("datas", $columns, $values);
                    unset($columns);
                    unset($values);
                }
            }
            }
            $i++;
}
$j++;

if (issubstring("shop/" . $term . "?page=" . $j, $html)) {
            
        } else {
        $j = 0;
    }
}
}
include 'footer.php';
?>