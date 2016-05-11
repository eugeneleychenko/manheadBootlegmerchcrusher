<?php



  $url = "http://justfirstrowsports.com/";
$html=file_get_contents($url);

//echo $html;
$html2 = explode("Today Videos", $html);
$livehtml = $html2[0];
$todayhtml = $html2[0];


$lives = explode("ui-corner-all", $livehtml);

$i = 0;
foreach ($lives as $live) {
    $title = explode('title="', $live);
    if (isset($title[1])) {
        echo $i;
        echo "---";
        $title = explode('"></div>', $title[1]);
        echo $title = $title[0];
        echo "---";
        $link = explode('href="', $live);
$link = explode('" target=', $link[1]);
echo $link = $link[0];
echo "---";

        $starttime = explode('realtimeh">', $live);
$starttime = explode('</div>', $starttime[1]);
echo $starttime = $starttime[0];
echo "---";
        $endtime = explode('realtimeh">', $live);
$endtime = explode('</div>', $endtime[2]);
echo $endtime = $endtime[0];
echo "---";
        $name = explode('</span>', $live);
        $name = explode(' </a>', $name[1]);
   echo $name = $name[0];
        echo "---";
        $i++;
        echo '<br>';
    }
}

?>