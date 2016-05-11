<?php
if (isset($_POST['query'])) {
    ini_set('max_execution_time', 30000);

//Beginning Buffer to save PHP variables and HTML tags



include 'connection.php';
include 'santo/functions.php';


$html = '<table >

                        <tr>
                            <td>title</td>
                            <td>Link</td>
                            <td>Image</td>
                            <td>Brand</td>
                            <td>Date</td>
                        </tr>


';
$query = $_POST['query'];
$rows = sqlfetch($query);
if ($rows != "") {
    foreach ($rows as $row) {

        $array = $row;
        include 'santo/arraynames.php';


        $html .= '<tr><td>' . $title . '</td><td>' . $link . '</td><td><img src = "' . $image . '"></td><td>' . str_replace("+", " ", $brand) . '</td><td>' . $date . '</td></tr>';
    }
}


$html .= '</table>';







//header('Content-type: application/excel');
    $filename = 'report.xls';
//header('Content-Disposition: attachment; filename=' . $filename);

    $data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Sheet 1</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>

<body>
   ' . $html . '
</body></html>';



$myfile = fopen("report.xls", "w") or die("Unable to open file!");

    fwrite($myfile, $data);



//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);


//$mpdf->Output($filename, 'I');
} else {
    ?>
        <form action="" enctype="multipart/form-data" method="post" >
            <input type="text" name="query">
                <input type="submit" value="Submit">

    </form>
<?php }
?>