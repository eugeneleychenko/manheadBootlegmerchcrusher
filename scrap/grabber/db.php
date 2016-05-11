<?php include 'connection.php'; ?>



<?php 
include 'santo/functions.php';

$properties = array(

  array("319" , "Commercial" , "Platanias Main Road" , 1200000 , 1200000 , "Tourist complex"),

  array("338" , "Residential" , "Megas Yialos/Kalivia" , 220000 , 220000 , "House"),

  array("693" , "Land & Sites" , "Myrovili" , "" , "" , "Land"),

  array("373" , "Land & Sites" , "Pounta" , 300000 , 300000 , "Land"),

  array("442" , "Land & Sites" , "Vasilia" , 3000000 , 3000000 , "Land"),

  array("444" , "Land & Sites" , "Pounta" , 90000 , 90000 , "Land"),

  array("456" , "Land & Sites" , "Kolios" , 180000 , 180000 , "Land"),

  array("460" , "Residential" , "Kolios" , 280000 , 280000 , "Apartment"),

  array("468" , "Residential" , "Kalamaki Peninsular" , 285000 , 285000 , "Villa"),

  array("476" , "Commercial-residential" , "Troulos" , 1000000 , 1000000 , "Tourist complex"),

  array("478" , "Residential" , "Kalivia" , 500000 , 500000 , "Villa with swimming pool"),

  array("483" , "Land & Sites" , "Aselinos Valley" , 3500000 , 3500000 , "Former Camp Site"),

  array("484" , "Residential" , "Katigiorgis, Pelion" , 170000 , 170000 , "Apartment"),

  array("511" , "Land & Sites" , "Korakafolia" , "" , "" , "Land"),

  array("512" , "Commercial" , "Platanias" , 450000 , 450000 , "Mezonette"),

  array("513" , "Commercial" , "Troulos" , 900000 , 900000 , "Apartment House"),

  array("514" , "Commercial" , "Troulos" , 325000 , 325000 , "Studio complex"),

  array("534" , "Land & Sites" , "Skiathos Town" , 1200000 , 1200000 , "Building plot"),

  array("566" , "Residential" , "Aghios Apostolos" , "" , "" , "Villa"),

  array("568" , "Residential" , "Skiathos Town - Plakes" , 199000 , 199000 , "Town House"),

  array("581" , "Commercial-residential" , "Vigles" , "" , "" , "Villa with swimming pool"),

  array("585" , "Commercial-residential" , "Skiathos Town" , 600000 , 600000 , "Apartment House"),

  array("592" , "Commercial" , "Megali Ammos" , 1500000 , 1500000 , "Hotel"),

  array("594" , "Residential" , "Skiathos Town" , 130000 , 130000 , "Apartment"),

  array("626" , "Land & Sites" , "Kalivia" , 150000 , 150000 , "Land"),

  array("631" , "Commercial-residential" , "Skiathos Town - New Harbo" , 550000 , 550000 , "Town house with premises"),

  array("634" , "Land & Sites" , "Katsarou" , 190000 , 190000 , "Land"),

  array("635" , "Land & Sites" , "Zorbathes" , 350000 , 350000 , "Land"),

  array("646" , "Commercial" , "Skiathos Town" , 650000 , 650000 , "Commercial Premises"),

  array("651" , "Commercial" , "Skiathos Town" , 2500000 , 2500000 , "Hotel"),

  array("655" , "Commercial" , "Skiathos Town" , 350000 , 350000 , "Tourist accommodation"),

  array("660" , "Residential" , "Near Volos" , 190000 , 190000 , "House"),

  array("662" , "Residential" , "Skiathos Town - Old Harbo" , 120000 , 120000 , "Town House"),

  array("676" , "Residential" , "Skiathos Town" , 130000 , 130000 , "Town House"),

  array("677" , "Residential" , "Skopelos" , 580000 , 580000 , "Villa"),

  array("683" , "Residential" , "Megali Ammos" , 225000 , 225000 , "Apartment"),

  array("684" , "Land & Sites" , "Vasilia" , 1100000 , 1100000 , "Building plot"),

  array("686" , "Commercial" , "Troulos" , 950000 , 950000 , "Studio complex"),

  array("689" , "Long term rentals" , "Zorbathes" , "" , "" , "Villa"),

  array("691" , "Commercial-residential" , "Achladies" , 1600000 , 1600000 , "Villa + rental units"),

  array("704" , "Residential" , "Pounta" , 400000 , 400000 , "Villa with swimming pool"),

  array("709" , "Residential" , "Skiathos Town" , 160000 , 160000 , "Town House"),

  array("713" , "Commercial-residential" , "Skiathos Town" , 600000 , 600000 , "Tourist accommodation"),

  array("719" , "Residential" , "Platanias" , 780000 , 780000 , "Villa with swimming pool"),

  array("721" , "Land & Sites" , "Kechria" , 130000 , 130000 , "Land"),

  array("727" , "" , "Skiathos Town" , 120000 , 120000 , "Land"),

  array("768" , "Residential" , "Skiathos Town - Center" , 275000 , 275000 , "Town House"),

  array("770" , "Commercial-residential" , "Steeles" , 450000 , 450000 , "Apartment House"),

  array("775" , "Residential" , "Katsarou" , 700000 , 700000 , "Villa with swimming pool"),

  array("777" , "" , "Troulos" , 370000 , 370000 , ""),

  array("788" , "Commercial" , "Skiathos Town - New Harbo" , 700000 , 700000 , "Hotel"),

  array("789" , "Land & Sites" , "Aghios Apostolos" , 200000 , 200000 , "Land"),

  array("793" , "Residential" , "Alonissos Island" , 350000 , 350000 , "Villa with swimming pool"),

  array("794" , "Residential" , "Alonissos Island" , 350000 , 350000 , "Villa with swimming pool"),

  array("795" , "Land & Sites" , "Alonissos Island" , 80000 , 80000 , "Land"),

  array("1018" , "Residential" , "Skiathos Town" , 280000 , 280000 , "Town House"),

  array("1017" , "Commercial" , "Kvouli" , 1500000 , 1500000 , "Apartment House"),

  array("1016" , "Residential" , "Skiathos Town" , 150000 , 150000 , "Town House"),

  array("1015" , "Residential" , "Pounta" , 425000 , 425000 , "Villa with swimming pool"),

  array("1012" , "Residential" , "Kalivia" , 550000 , 550000 , "Villa with studios"),

  array("811" , "Commercial for rent" , "Skiathos Town" , "" , "" , "Retail Outlet"),

  array("812" , "Commercial-residential" , "Skiathos Town" , "" , "" , "Office"),

  array("813" , "Commercial-residential" , "Skiathos Town" , "" , "" , "Retail & Office Premises"),

  array("815" , "Land & Sites" , "Skiathos Town" , 120000 , 120000 , "Building plot"),

  array("1011" , "Residential" , "Aghios Spiridon/Kalivia" , 250000 , 250000 , "Cottage"),

  array("1010" , "Residential" , "Skiathos Town - Center" , 125000 , 125000 , "Town House"),

  array("819" , "Residential" , "Megas Yialos/Kalivia" , 450000 , 450000 , "House"),

  array("825" , "Residential" , "Skiathos Town - New Harbo" , 125000 , 125000 , "Apartment"),

  array("1009" , "Residential" , "Skiathos Town" , 100000 , 100000 , "Town House"),

  array("830" , "Land & Sites" , "Kastania nr Kalivia" , 200000 , 200000 , "Land"),

  array("1008" , "Commercial-residential" , "Skiathos Town - Old Harbo" , 590000 , 590000 , "Town House"),

  array("1007" , "Commercial" , "Skiathos Town - Old Harbo" , 590000 , 590000 , "Town House"),

  array("1006" , "Commercial for rent" , "Skiathos Town" , 200000 , 200000 , "Premises"),

  array("850" , "Residential" , "Sklithri" , 375000 , 375000 , "Villa"),

  array("866" , "Residential" , "Skiathos Town - Plakes" , 250000 , 250000 , "Town House"),

  array("867" , "Residential" , "Pounta" , 400000 , 400000 , "Villa"),

  array("869" , "Residential" , "Skiathos Town - Agia Tria" , 65000 , 65000 , "Apartment"),

  array("870" , "Land & Sites" , "Pefkoraki" , 150000 , 150000 , "Land"),

  array("871" , "Land & Sites" , "Katsarou" , 250000 , 250000 , "Land"),

  array("874" , "Land & Sites" , "Xanemos" , 180000 , 180000 , "Land + building licence"),

  array("877" , "Commercial for rent" , "Skiathos Town - Old Harbo" , 135000 , 135000 , "Bar"),

  array("887" , "Land & Sites" , "" , 500000 , 500000 , "Land"),

  array("1001" , "Land & Sites" , "Koukounaries" , 600000 , 600000 , "Land"),

  array("889" , "Residential" , "Kolios" , 105000 , 105000 , "Studio"),

  array("1000" , "Residential" , "Pounta" , 475000 , 475000 , "Villa with swimming pool"),

  array("893" , "Residential" , "Pefkoraki" , 850000 , 850000 , "Villa"),

  array("894" , "Residential" , "Skiathos Town - Agia Tria" , 160000 , 160000 , "Apartment"),

  array("999" , "Residential" , "Pounta" , 595000 , 595000 , "Villa with swimming pool"),

  array("906" , "Residential" , "Aghios Taxiarchis" , 475000 , 475000 , "Villa with swimming pool"),

  array("909" , "Residential" , "Achladies" , 140000 , 140000 , "Apartment"),

  array("998" , "Residential" , "Pounta" , 550000 , 550000 , "Villa with swimming pool"),

  array("915" , "Land & Sites" , "Keraies" , 180000 , 180000 , "Land"),

  array("918" , "Residential" , "Platanias" , 350000 , 350000 , "Villa with studios"),

  array("920" , "Residential" , "Vigles" , 230000 , 230000 , "Detached house"),

  array("923" , "Land & Sites" , "Koumaroraki" , 500000 , 500000 , "Land + building licence"),

  array("996" , "Residential" , "Kalamaki Peninsular" , 800000 , 800000 , "Villa"),

  array("929" , "Commercial-residential" , "Skiathos Town" , 220000 , 220000 , "Town house with premises"),

  array("934" , "Residential" , "Skiathos" , 70000 , 70000 , "Town House"),

  array("939" , "Residential" , "Plakes" , 230000 , 230000 , "Town House"),

  array("942" , "Land & Sites" , "Skiathos Town - Ringroad" , "" , "" , "Building plot"),

  array("954" , "Land & Sites" , "Aghios Spiridon/Kalivia" , 110000 , 110000 , "Land"),

  array("959" , "Commercial-residential" , "Skiathos Town - Old Harbo" , 300000 , 300000 , "Studio complex"),

  array("963" , "Residential" , "Near Volos" , 160000 , 160000 , "House"),

  array("973" , "Land & Sites" , "Kechria" , 120000 , 120000 , "Land"),

  array("975" , "Residential" , "Pounta" , 635000 , 635000 , "Villa with swimming pool"),

  array("977" , "Commercial" , "Kolios" , 800000 , 800000 , "Studio complex"),

  array("980" , "Residential" , "Skiathos Town - Old Harbo" , 590000 , 590000 , "Town House"),

  array("985" , "Residential" , "Kalivia" , "" , "" , "Villa with swimming pool"),

  array("986" , "Land & Sites" , "Kopanes" , 180000 , 180000 , "Land + building licence"),

  array("988" , "Commercial" , "Skiathos Town - Center" , 290000 , 290000 , "Bar with freehold"),

  array("989" , "Residential" , "Korakafolia" , 230000 , 230000 , "House and apartment"),

  array("992" , "Residential" , "Tsirmokokalo" , "" , "" , "Villa with Guest Houses"),

  array("993" , "Residential" , "Sklithri" , 220000 , 220000 , "House"),

  array("994" , "Commercial-residential" , "Skiathos Town - Ringroad" , 370000 , 370000 , "Apartment House"),

  array("995" , "Land & Sites" , "Katsarou" , 275000 , 275000 , "Land")

);
$i=0;
$columns=array("id" , "category" , "location" , "minprice" , "maxprice" , "type");
foreach ($properties as $row) {
    
    
  if(sqlinsert("property", $columns, $row))
    
    $i++;
    
}


echo $i;









?>