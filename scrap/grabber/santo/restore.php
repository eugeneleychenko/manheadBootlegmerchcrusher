<?php
 include "connection.php";
 ?>
<form method="post" action="" enctype="multipart/form-data" class="form-group"> 
                     
                     <div class="col-md-6">
<input type="file" name="file">
</div>
                     <div class="col-md-6">

<input type="submit" value="submit" name="submit" class="btn btn-success">
</div>
</form>





<?php

ini_set('memory_limit','128M'); // set memory limit here
set_time_limit(60);


if(isset($_POST['submit']))
{
$temp_name= ($_FILES["file"]["tmp_name"]);
$name= basename($_FILES["file"]["name"]);
$extension=pathinfo($name,PATHINFO_EXTENSION);

if($extension=="sql" || $extension=="SQL")
{
$fp = fopen ($temp_name, 'r' );
$fetchData = fread ( $fp, filesize ($temp_name) );
$sqlInfo = explode ( ";\n", $fetchData); // explode dump sql as a array data

foreach ($sqlInfo AS $sqlData )
{
mysql_query ($sqlData);
}

echo 'Done';
header( "Refresh:2; url=index.php"); 

}
else
{
	echo "Please Select sql File";
}

}



?>
