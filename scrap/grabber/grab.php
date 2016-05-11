<?php

$server_name = 'localhost';
//$user_name = '';
//$password = '';
//$db_name = 'selected';
$user_name = 'root';
$password = '';
$db_name = 'rowsport';
$conn = mysql_connect($server_name, $user_name, $password);
mysql_select_db($db_name, $conn);
function sqlfetchs($query) {


    $sql = mysql_query($query);
    if ($sql) {
        if (mysql_num_rows($sql) > 0) {
            $list = mysql_fetch_array($sql);


            return($list);
        } else
            return ("");
    } else
        return ("");
}

function sqlinsert($table, $column, $dbvalues) {

    if (sizeof($column) == sizeof($dbvalues)) {

        $i = 0;
        $db = "";
        foreach ($column as $value) {
            $db = $db . "`" . $value . "`";
            $i = $i + 1;
            if ($i < (sizeof($column))) {
                $db = $db . " , ";
            }
        }

        $i = 0;
        $fields = "";
        foreach ($dbvalues as $value) {


            $fields = $fields . $value;




            $i = $i + 1;
            if ($i < (sizeof($dbvalues))) {
                $fields = $fields . " , ";
            }
        }
        $slquery = "INSERT INTO `$table` ($db) VALUES ($fields)";
        if (mysql_query($slquery)) {

            return(1);
        } else {

            return(0);
        }
    } else {

        return(0);
    }
}

function geticon($name) {
   $name = strtolower($name);
    if (strpos($name, 'soccer') !== false) {
            return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Soccer-icon.png";
        }
    elseif (strpos($name, 'football') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/American-Football-icon.png";
    }
    elseif (strpos($name, 'rugby') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/American-Football-icon.png";
    }
    elseif (strpos($name, 'basketball') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Basketball-icon.png";
    }
    elseif (strpos($name, 'olleyball') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Volleyball-icon.png";
    }
    elseif (strpos($name, 'ennis') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Tennis-icon.png";
    }
    elseif (strpos($name, 'hockey') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Hockey-icon.png";
    }
    elseif (strpos($name, 'bowling') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Bowling-icon.png";
    }
    elseif (strpos($name, 'golf') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Golf-icon.png";
    }
    elseif (strpos($name, 'baseball') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Baseball-icon.png
";
    }
   elseif (strpos($name, 'adminton') !== false) {
        return "http://icons.iconarchive.com/icons/kevin-andersson/sportset/128/Badminton-icon.png
";
    } else
        return "http://icons.iconarchive.com/icons/martz90/circle-addon1/128/ct-sport-icon.png";
}

$url = "http://justfirstrowsports.com/";
$html=file_get_contents($url);

//echo $html;
$html2 = explode("Today Videos", $html);
$livehtml = $html2[0];
$todayhtml = $html2[1];


$lives = explode("ui-corner-all", $livehtml);
$todays = explode("ui-corner-all", $todayhtml);
$i = 0;
foreach ($lives as $live) {
    $title = explode('title="', $live);
    if (isset($title[1])) {
        $title = explode('"></div>', $title[1]);
 $title = $title[0];
        $title = geticon($title);
        $link = explode('href="', $live);
$link = explode('" target=', $link[1]);
$link = $link[0];


$starttime = explode('realtimeh">', $live);
$starttime = explode('</div>', $starttime[1]);
$starttime = $starttime[0];
        $starttime = explode(":", $starttime);
        $starttime[0] = ($starttime[0] + 6);
        if ($starttime[0] > 23)
            $starttime[0] = $starttime[0] - 24;
        $starttime = implode(":", $starttime);

        $endtime = explode('realtimeh">', $live);
$endtime = explode('</div>', $endtime[2]);
$endtime = $endtime[0];
        $endtime = explode(":", $endtime);
        $endtime[0] = ($endtime[0] + 6);
        $endtime = implode(":", $endtime);
           if ($endtime[0] > 23)
            $endtime[0] = $endtime[0] - 24;
        $name = explode('</span>', $live);
        $name = explode(' </a>', $name[1]);
        $name = $name[0];

        $columns[] = "code";
        $columns[] = "start";
        $columns[] = "end";
        $columns[] = "icon";
        $columns[] = "team";
        $columns[] = "date";

        $values[] = "'" . $link . "'";
        $values[] = "'" . $starttime . "'";
        $values[] = "'" . $endtime . "'";
        $values[] = "'" . $title . "'";
        $values[] = "'" . $name . "'";
        $values[] = "'" . date('Y-m-d') . "'";
        $date = date('Y-m-d');
        $query = "select * from `stream` where date='$date' and team='$name' and start='$starttime'";
        $rows = sqlfetchs($query);
        if ($rows != "") {

        }

 else
            sqlinsert("stream", $columns, $values);
        $i++;
        unset($values);
        unset($columns);
    }
}




foreach ($todays as $live) {
    $title = explode('title="', $live);
    if (isset($title[1])) {
        $title = explode('"></div>', $title[1]);
        $title = $title[0];
        $title = geticon($title);
        $link = explode('href="', $live);
        $link = explode('" target=', $link[1]);
        $link = $link[0];


        $starttime = explode('realtimeh">', $live);
        $starttime = explode('</div>', $starttime[1]);
        $starttime = $starttime[0];
        $starttime = explode(":", $starttime);
        $starttime[0] = ($starttime[0] + 6);
        if ($starttime[0] > 23)
            $starttime[0] = $starttime[0] - 24;
        $starttime = implode(":", $starttime);

        $endtime = explode('realtimeh">', $live);
        $endtime = explode('</div>', $endtime[2]);
        $endtime = $endtime[0];
        $endtime = explode(":", $endtime);
        $endtime[0] = ($endtime[0] + 6);
        if ($endtime[0] > 23)
            $endtime[0] = $endtime[0] - 24;
        $endtime = implode(":", $endtime);

        $name = explode('</span>', $live);
        $name = explode(' </a>', $name[1]);
        $name = $name[0];

        $columns[] = "code";
        $columns[] = "start";
        $columns[] = "end";
        $columns[] = "icon";
        $columns[] = "team";
        $columns[] = "date";

        $values[] = "'" . $link . "'";
        $values[] = "'" . $starttime . "'";
        $values[] = "'" . $endtime . "'";
        $values[] = "'" . $title . "'";
        $values[] = "'" . $name . "'";
        $values[] = "'" . date('Y-m-d') . "'";
        $date = date('Y-m-d');
        $query = "select * from `stream` where date='$date' and team='$name' and start='$starttime'";
        $rows = sqlfetchs($query);
        if ($rows != "") {

        } else
            sqlinsert("stream", $columns, $values);
        $i++;
        unset($values);
        unset($columns);
    }
}
?>