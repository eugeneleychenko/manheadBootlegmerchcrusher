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
    $url = "http://www.grindstore.com/search/?q=" . $term . "&sortby=7&page=" . $j;
        $html = file_get_contents($url);
        $html = explode("cat-pagination", $html);
        $html = $html[1];


        $rows = explode('product-block', $html);
        $i = 1;
foreach ($rows as $row) {
    if ($i > 1)
    {
        $link = "http://www.grindstore.com" . getbetween($row, '<a href="', '"');
                $img = getbetween($row, 'img src="', '"');
                $title = getbetween($row, 'description"><p>', '</p>');
                $date = date('Y-m-d');
        $website = "grindstore";
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
            $i++;
}
$j++;

if (issubstring("search/?q=" . $term . "&sortby=7&page=" . $j, $html)) {
            
        } else {
        $j = 0;
    }
}
}
include 'footer.php';
?>