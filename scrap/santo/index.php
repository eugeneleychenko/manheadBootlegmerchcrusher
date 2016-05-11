<script src="js.js"></script>
<script>
var data= ajaxdata("hi","hello","howare you","20");
alert(data);
function myfin(id)
{
	if(id=="show")
ajaxalert('test.php',data,'show');
}
</script>



<?php 
include "connection.php";
include "functions.php";
$select=getsqlfields("note");
$integerarray= getsqlint("note");



?>


 <!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<title>Title of the document</title>
</head>

<body>
The content of the document......
 <div id="show" onClick="myfin(this.id)" >previous content</div>
</body>

</html> 
