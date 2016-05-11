<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$url = "http://www.grindstore.com/search/?q=fall+out+boy&sortby=7&page=2";
$html = file_get_contents($url);
echo $html;
?>