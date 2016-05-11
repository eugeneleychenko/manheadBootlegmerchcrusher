<?php



 $query = "select * from `datas`";
$rows = sqlfetch($query);
if ($rows != "") {
    foreach ($rows as $row) {
        $seller = "";
        $url = $row['link'];
        $id = $row['id'];


        if ($url != "")
            $html = file_get_contents($url);
       
        if ($row['website'] == "redbubble") {
            $sellers = explode('rel="author"', $html);
            $seller = getbetween($sellers[1], '>', '<');
            $query = "UPDATE datas SET seller='$seller' WHERE id=$id";
            mysql_query($query);
        }

      
    }
}






?>