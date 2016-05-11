<?php

include("pdf/mpdf.php"); //Include mPDF Class
ini_set('max_execution_time', 30000);
$mpdf = new mPDF(); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags



include 'connection.php';
include 'santo/functions.php';

$html = '<table >
                      <thead>
                        <tr>
                            <th style="width:300px;">title</th>
                            <th style="width:300px;">Link</th>
                            <th style="width:200px;">Image</th>

                            <th style="width:200px;">Brand</th>
                            <th style="width:200px;">Seller</th>
                            <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
';
$query = $_POST['query'];
$rows = sqlfetch($query);
if ($rows != "") {
    foreach ($rows as $row) {

        $array = $row;
        include 'santo/arraynames.php';


        $html .= '<tr><td>' . $title . '</td><td>' . $link . '</td><td><img src = "' . $image . '" alt = "" width = "100"></td><td>' . str_replace("+", " ", $brand) . '</td><td>' . $seller . '</td><td>' . $date . '</td></tr>';
    }
}


$html .= '</tbody>
                    </table>';




//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));

$content = $mpdf->Output('report.pdf', 'F');

//$mpdf->Output($filename, 'I');
echo 'Pdf File created ';
?>