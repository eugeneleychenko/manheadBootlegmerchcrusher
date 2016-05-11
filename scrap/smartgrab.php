<?php



function getbetween($string, $from, $to) {
    

    $content = explode($from, $string);

    //print_r($content);
    $seccontent = explode($to, $content[1]);


    return $seccontent[0];
}

$terms = $_POST['brand'];
$website = $_POST['website'];


if (in_array("etsy", $website))
    foreach ($terms as $term) {
    


$j = 1;

while ($j >= 1) {
    $url = "https://www.etsy.com/search/search?q=" . $term . "&page=" . $j;
    $html = file_get_contents($url);




    $rows = explode('block-grid-item listing-card position-relative', $html);
$i = 1;
foreach ($rows as $row) {
    if ($i > 1)
    {
        $link = getbetween($row, '<a href="', '"');
        $img = getbetween($row, '<img src="', '"');
        $title = getbetween($row, 'title="', '"');
      echo $seller = getbetween($row, 'card-shop-name card-meta-row-item text-truncate overflow-hidden', '</a>');
      $seller = str_replace(" ", "", $seller);
                    $seller = str_replace('">', "", $seller);
                    $date = date('Y-m-d');
        $website = "etsy";
                $brand = str_replace("-", " ", $term);

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
                    $columns[] = "seller";

                    $values[] = "'" . $link . "'";
                    $values[] = "'" . $img . "'";
                    $values[] = "'" . $title . "'";
                    $values[] = "'" . $website . "'";
                    $values[] = "'" . $date . "'";
                    $values[] = "'" . $brand . "'";
                    $values[] = "'" . $seller . "'";
                        sqlinsert("datas", $columns, $values);
                    unset($columns);
                    unset($values);
                }
            }
            $i++;
}
$j++;

if (issubstring("https://www.etsy.com/search/search?q=" . $term . "&page=" . $j, $html)) {
        
    } else {
        $j = 0;
    }
}
}






if (in_array("grindstore", $website))
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
                if ($i > 1) {
                    $link = "http://www.grindstore.com" . getbetween($row, '<a href="', '"');
                    $img = getbetween($row, 'img src="', '"');
                    $title = getbetween($row, 'description"><p>', '</p>');
                    $date = date('Y-m-d');
                    $website = "grindstore";
                    $brand = str_replace("-", " ", $term);

                    $query = "select * from `datas` where link='$link'";

                    $rows = sqlfetch($query);
                    if ($rows != "") {

                    } else {

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
if (in_array("impericon", $website))
    foreach ($terms as $term) {



        $j = 1;

        while ($j >= 1) {
            $url = "http://www.impericon.com/de/catalogsearch/result/index/?p=" . $j . "&q=" . $term;
            $html = file_get_contents($url);
            $html = explode('class="result-count"', $html);
            $html = $html[1];


            $rows = explode('class="item', $html);
            $i = 1;
            foreach ($rows as $row) {
                if ($i > 1) {
                    $link = getbetween($row, '<a href="', '"');
                    $img = getbetween($row, '<img src="', '"');
                    $title = getbetween($row, 'title="', '"');
                    $date = date('Y-m-d');
                    $website = "impericon";
                    $brand = str_replace("-", " ", $term);

                    $query = "select * from `datas` where link='$link'";

                    $rows = sqlfetch($query);
                    if ($rows != "") {

                    } else {

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

            if (issubstring("result/index/?p=" . $j, $html)) {

            } else {
                $j = 0;
            }
        }
    }

if (in_array("redbubble", $website))
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
                if ($i > 1) {
                    if (issubstring("grid-item hover", $row)) {
                        $link = "http://www.redbubble.com" . getbetween($row, '"', '"');
                        $img = getbetween($row, 'src="', '"');
                        $title = getbetween($row, 'title="', '"');
                        $date = date('Y-m-d');
                        $website = "redbubble";
                        $brand = str_replace("-", " ", $term);

                        $query = "select * from `datas` where link='$link'";

                        $rows = sqlfetch($query);
                        if ($rows != "") {

                        } else {

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


include 'grabetsy.php';
?>