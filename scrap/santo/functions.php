<?php

//1
function isfileset($filename) {
    if (file_exists($_FILES[$filename]['tmp_name']) || is_uploaded_file($_FILES[$filename]['tmp_name'])) {


        return(1);
    } else {

        return(0);
    }
}

//2
function uploadimg($filename, $name) {

    $allowed_file_types = array('.jpg', '.JPG', '.JPEG', '.jpeg', '.gif',
        '.GIF', '.png', '.PNG');
    $file_ext = substr($_FILES[$filename]["name"],
            strripos($_FILES[$filename]["name"], '.'));
    if (!in_array($file_ext, $allowed_file_types)) {
        echo $_SESSION['err'] = 'Only (jpg,jpeg,gif,png)these file typs are allowed for upload: !!';
        return(0);

// file type error
    } elseif (move_uploaded_file($_FILES[$filename]["tmp_name"],
                    $name . $file_ext)) {
        return($name . $file_ext);
    }
}

//3
function uploadfile($filename, $name) {


    $file_ext = substr($_FILES[$filename]["name"],
            strripos($_FILES[$filename]["name"], '.'));
    if (move_uploaded_file($_FILES[$filename]["tmp_name"], $name . $file_ext)) {
        return($name . $file_ext);
    }
}

//4
function getmaxid($table) {

    $sql = mysql_query("SELECT * from $table ORDER BY `id` DESC LIMIT 1");
    $list = mysql_fetch_array($sql);
    $id = $list['id'] + 1;
    return($id);
}

//5
function sqlfetch($query) {

    $sql = mysql_query($query);
    if (mysql_num_rows($sql) > 0) {
        while ($list = mysql_fetch_array($sql)) {
            $rows[] = $list;
        }
        return($rows);
    } else return ("");
}

//6

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


function processform() {

    $keys = array_keys($_POST);
    foreach ($keys as $value) {

        if (isset($_POST[$value]) and ( $value != "table") and ( $value != "action")and ( $value != "id")) {
            if (is_array($_POST[$value])) {
                $columns[] = $value;
                $vall = "";

                $key1 = array_keys($_POST[$value]);
                foreach ($key1 as $val) {

                    $vall = $vall . mysql_real_escape_string($_POST[$value][$val]) . ",";
                }
                $values[] = "'" . $vall . "'";
            } elseif ($_POST[$value] != "") {

                $columns[] = $value;
                $values[] = "'" . mysql_real_escape_string($_POST[$value]) . "'";
            }
        }
    }

    if ($_POST['action'] == "insert") {
        
    $table = $_POST['table'];
        if (sqlinsert($table, $columns, $values)) {
            return(1);
        } else {
            return 0;
        }
    }

    if ($_POST['action'] == "update") {

        $table = $_POST['table'];
        $id = $_POST['id'];

       if (sizeof($columns) == sizeof($values)) {

        for ($i = 0; $i < sizeof($columns); $i++) {
                $col[] = $columns[$i];
                $col[] = $values[$i];
            }
        }
        if (sqlupdate($table, $col, "id=$id")) {
            return(1);
        } else {
            return 0;
        }
    }
}

//7
function postint($value) {
    return(substr_count($value, "lsint"));
}

//8
function issubstring($substring, $string) {

    return(substr_count($string, $substring));
}

//9
function adddate($date, $string) {
    $date = strtotime($date . $string);
    return (date('Y-m-d', $date));
}
function adddateym($date, $string) {
 $date = strtotime($date . $string);
 $date=date('Y-m-d', $date);
 $var=explode("-", $date);
 $var1=$var[0].'-'.$var[1];
    return ($var1);
}

//1000000000000000000000000000000000
function datediff($prev, $next) {

    $date1 = date_create($prev);
    $date2 = date_create($next);
    $diff = date_diff($date1, $date2);
    $result = $diff->format("%R%a");

    return($result);
}

//1111111111111111111111111111111111
function sqlupdate($table, $column, $condition) {
    $i = 0;
    $db = "";
    foreach ($column as $value) {
        if (($i % 2) == 0) {
            $db = $db . "`" . $value . "`";


            $db = $db . " = ";
        } else {
            $db = $db . $value;

            if ($i < (sizeof($column) - 1)) {
                $db = $db . ",";
            }
        }
        $i = $i + 1;
    }



    $slquery = "UPDATE `$table` SET $db WHERE $condition";
    return(mysql_query($slquery));
}

//12222222222222222222222222222222222222222222222222222222
function sqlfetchs($query) {


    $sql = mysql_query($query);
    if ($sql) {
        if (mysql_num_rows($sql) > 0) {
            $list = mysql_fetch_array($sql);


            return($list);
        } else return ("");
    } else return ("");
}

//133333333333333333333333333333333333333
function getlast($table, $col) {

    $sql = mysql_query("SELECT * from $table ORDER BY `id` DESC LIMIT 1");
    $list = mysql_fetch_array($sql);
    $value = $list[$col];
    return($value);
}

//144444444444444444444444444444444444444444444
function getlastrows($table, $limit) {

    $query = "SELECT * from $table ORDER BY `id` DESC LIMIT $limit";
    $sql = mysql_query($query);
    if (mysql_num_rows($sql) > 0) {
        while ($list = mysql_fetch_array($sql)) {
            $rows[] = $list;
        }
        return($rows);
    } else return ("");
}

//1555555555555555555555555555555555555555555555555555555
function getlastrow($table) {

    $sql = mysql_query("SELECT * from $table ORDER BY `id` DESC LIMIT 1");
    $list = mysql_fetch_array($sql);
    $value = $list;
    return($value);
}

//166666666666666666666666666666666666666666666666666666666666666666
function mail_attachment($filename, $mailto, $from_mail, $from_name, $replyto,$subject, $message) {
    $file = $filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
    $header .= "Reply-To: " . $replyto . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message . "\r\n\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
    $header .= $content . "\r\n\r\n";
    $header .= "--" . $uid . "--";
    if (mail($mailto, $subject, "", $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}
////////////////////////////////////////////////


function mail_attachments($filename, $mailto, $from_mail, $from_name, $replyto,$subject, $message) 
                {
$fileatt_type = "application/pdf"; // File Type
$fileatt_name = $filename; // Filename that will be used for the file as the attachment
$file = fopen($filename,'rb');
$data = fread($file,filesize($filename));
fclose($file);
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers="From: $from_mail"; // Who the email is from (example)
$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";
$email_message .= "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $message;
$email_message .= "\n\n";
$data = chunk_split(base64_encode($data));
$email_message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"--{$mime_boundary}--\n";


 // The email you are sending to (example)

if(mail($mailto,$subject,$email_message,$headers))
{
	echo "mail send to". $rows[$i]."<br>";
}
else
{
	echo "try again<br>";
}

}


//////////////////////////////////////////////////////////////177777777777777777
function curl_post($url, $post) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

//18888888888888888888888888888888888888888888888888888888888888888888888888888

function sourcecode($url) {
    $lines = file($url);

    foreach ($lines as $line_num => $line) {

// loop thru each line and prepend line numbers

        echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "

\n";
    }
}

//19999999999999999999999999999999999999999999999999999999999999

function youtubethumb($url) {

    $key = explode("=", $url);
    echo' http://img.youtube.com/vi/' . $key[1] . '/0.jpg';
}
//2000000000000000000000000000000000000000000000000000000000
function sqldelete($table, $condition) {
    $query = "DELETE FROM `$table` WHERE $condition";
    if (mysql_query($query)) return(1);
    else {
        return(0);
    }
}

//2000000000000000000000000000000000000000000000000000000000
function blockip($array) {


    if (in_array($_SERVER['REMOTE_ADDR'], $array)) {
        header("location: index.php");
        exit();
    }
}

//21111111111111111111111111111111111111111111111111111111111111
function login($table, $username, $password) {

    // username and password sent from form
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysql_real_escape_string($myusername);
    $mypassword = mysql_real_escape_string($mypassword);
    $sql = "SELECT * FROM `$table` WHERE `username`='$myusername' and `password`='$mypassword'";
    $result = mysql_query($sql);
$r =  mysql_fetch_array($result);
// Mysql_num_row is counting table row
    $count = mysql_num_rows($result);

    if ($count == 1) {

        return($r['id']);
    } else {
        return(0);
    }
}

//22222222222222222222222222222222222222222222222222222222
function sqldate($date, $format) {

    if ($format == "mdy") {
        $string1 = explode("/", $date);
        $date = $string1[2] . "-" . $string1[0] . "-" . $string1[1];
        return($date);
    }
    if ($format == "dmy") {
        $string1 = explode("/", $date);
        $date = $string1[2] . "-" . $string1[1] . "-" . $string1[0];
        return($date);
    }
}

//23333333333333333333333333333333333333333333333333333333333333333333333333
function getpostupdate($select) {
    $keys = array_keys($_POST);


    foreach ($keys as $value) {

        if (isset($_POST[$value]))
                if ($_POST[$value] != "")
                    if (in_array($value, $select)) {
                    $column[] = $value;

                    $column[] = "'" . $_POST[$value] . "'";
                }
        return ($column);
    }
}

//24444444444444444444444444444444444444444444444444444444444444444444
function ajaxvalue($url, $data, $showid) {
    echo' var dataString = "' . $data . '";
	$.ajax({
			type: "POST",
			url: "' . $url . '",
			data:dataString,
			cache: false,
			beforeSend: function()
			{

			},
			success: function(response)
			{

			document.getElementById("' . $showid . '").value=response;
			}
		   });';
}

//255555555555555555555555555555555555555555555555555555555555555555
function getsqlfields($table) {

    $sql = mysql_query("DESCRIBE $table");
    while ($list = mysql_fetch_array($sql)) {
        $fields[] = $list['Field'];
    }
    $value = $fields;
    return($value);
}

//26666666666666666666666666666666666666666666666666666666666666666
function getsqlint($table) {

    $sql = mysql_query("DESCRIBE $table");
    while ($list = mysql_fetch_array($sql)) {
        if (issubstring("int", $list['Type']) > 0) $fields[] = $list['Field'];
        if (issubstring("float", $list['Type']) > 0) $fields[] = $list['Field'];
    }
    $value = $fields;
    return($value);
}


function getcount($query) {

    $result = mysql_query($query);
// Mysql_num_row is counting table row
    $count = mysql_num_rows($result);
    
    
    return( $count);
}



?>




