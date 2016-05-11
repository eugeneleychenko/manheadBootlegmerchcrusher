<?php
include 'header.php';
if (isset($_POST['website'])) {
    $query = "DELETE FROM `datas` WHERE 1";
mysql_query($query);
include 'smartgrab.php';
    echo '<script> window.location.href = "search.php"; </script>';
}
if (isset($_POST['remove'])) {

    $rows = $_POST['items'];
    $bquery = "";
    $i = 1;
    foreach ($rows as $row) {
        $query = "select * from `datas` where id=$row ";
        $rowss = sqlfetch($query);
        if ($rowss != "") {
            $url = $rowss['link'];
            $website = $rowss['website'];
            $query = "INSERT INTO `deleted`(`website`,`url`) VALUES ('$website','$url')";
            mysql_query($query);
        }






        if ($i > 1)
            $bquery = $bquery . " or";
        $bquery = $bquery . " id='" . $row . "'";
        $i++;
    }
    
    $query = "delete  from `datas` where  ". $bquery ;

    mysql_query($query);
}

?>



<!-- Middle Content Start -->
<?php


    

    



  $query = "select * from `datas`";







?>
<!-- MAIN PANEL -->
<input type="hidden" name="query" id="query" value="<?php echo $query; ?>">
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment">
            <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span>
        </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>		</ol>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i>
                    Search results

                    <span>>
                        
                    </span>
                </h1>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
                <ul id="sparks" class="">
                    
                    <li id="makepdf"> <button class="btn btn-success" onclick="makepdf();">Generate pdf</button> </li>
                    <li id="emailclient"> <span id="processing"></span><span id="counter"></span> <span id="counter11"></span></li>
                    <li id="downloadpdf"> </li>
                    <li id="emailexcelclient"> <span id="processingexcel"></span><span id="counterexcel"></span> <span id="counterexcel11"></span></li>
                    <li id="downloadexcel"> </li>
                </ul>
                <script>
/**
* Comment
*/
function makepdf() {

var cont= document.getElementById("query").value;
var numb = <?php echo getcount($query); ?>;
var settme = numb*5;

var dataString = {'query':cont};
      $.ajax({
                      type: "POST",
                      url: "pdf.php",
                      data:dataString,
                      cache: false,
                      beforeSend: function()
                      {

                          var counter = 1;
document.getElementById("processing").innerHTML="Processing ";

setInterval(function(){

    document.getElementById("counter11").innerHTML="%..";
        document.getElementById("counter").innerHTML=counter;

if(counter<100)
counter++;
}, settme);
                      },
                      success: function(response)
                      {
document.getElementById("makepdf").innerHTML="";
                     document.getElementById("emailexcelclient").innerHTML='<a href="email.php"><button class="btn btn-success" >Email Client</button> </a>';
                     document.getElementById("downloadpdf").innerHTML='<a class="btn btn-success" href="report.pdf" download>Download pdf</button>';
                      }
                 });
}
/**
 * Comment
 */

function makeexcel() {

var cont= document.getElementById("query").value;
var numb = <?php echo getcount($query); ?>;
var settme = numb*5;

var dataString = {'query':cont};
      $.ajax({
                      type: "POST",
                      url: "excel.php",
                      data:dataString,
                      cache: false,
                      beforeSend: function()
                      {

                          var counter = 1;
document.getElementById("processingexcel").innerHTML="Processing ";

setInterval(function(){

    document.getElementById("counterexcel11").innerHTML="%..";
        document.getElementById("counterexcel").innerHTML=counter;

if(counter<100)
counter++;
}, settme);
                      },
                      success: function(response)
                      {
document.getElementById("makeexcel").innerHTML="";
                     document.getElementById("emailexcelclient").innerHTML='<a href="sendexcelto.php"><button class="btn btn-success" >Email Client</button> </a>';
                     document.getElementById("downloadexcel").innerHTML='<a class="btn btn-success" href="report.xls" download>Download excel</button>';
                      }
                 });
}



function emailclient() {
    var dataString = {'website':"search"};
        $.ajax({
                        type: "POST",
                        url: "mail.php",
                        data:dataString,
                        cache: false,
                        beforeSend: function()
                        {

                        },
                        success: function(response)
                        {

                        alert("email Has been sent to  lawyers");
                        }
                   });

}


/**
 * Comment
 */
function selectalll() {

    for(var i=1; i<2000;i++)
    {
var j = i.toString();
        var seleid = "checkboxx"+j;
        var myElem = document.getElementById(seleid);
if (myElem === null)
{
    }
    else
document.getElementById(seleid).checked = true;



}

document.getElementById("checkbutton").innerHTML='<button type="button" class="btn btn-info" name="select all" onclick="unselectalll()">De-Select all</button>';

}

function unselectalll() {

    for(var i=1; i<2000;i++)
    {
var j = i.toString();
        var seleid = "checkboxx"+j;

document.getElementById(seleid).checked = false;



}

document.getElementById("checkbutton").innerHTML='<button type="button" class="btn btn-info" name="select all" onclick="selectalll()">Select all</button>';

}


                </script>
            </div>
        </div>

        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    
                    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2" data-widget-editbutton="false">
                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->
                        <div id="checkbutton"><button type="button" class="btn btn-info" name="select all" onclick="selectalll()">Select all</button></div>
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2>Search results</h2>

                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->
                            
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <form action="" enctype="multipart/form-data" method="post" >
                                   

                                
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>
                                        
                                        <tr>
                                            
                                            <th><button type="submit" class="btn btn-success" name="remove">Remove</button></th>
                                            <th style="width: 50px;">Website</th>
                                            <th style="width: 120px;">Title</th>
                                            <th style="max-width: 140px; overflow: hidden;">Link</th>
                                            <th>Image</th>

                                            <th>Band</th>
                                            <th>Seller</th>
                                            <th>Date</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $rows = sqlfetch($query);
                                        if ($rows != "") {
                                            foreach ($rows as $row) {

                                                $array = $row;
                                                include 'santo/arraynames.php';


                                                echo '<tr><td><input type="checkbox" name="items[]" value="' . $id . '" id="checkboxx' . $i . '"></td><td>' . $website . '</td><td>' . $title . '</td><td>' . $link . '</td><td><a href="'. $image .'" class="search-list-image"><img class="" src = "' . $image . '" alt = "" width = "100"></a></td><td>' . str_replace("+", " ", $brand) . '</td><td>' . $seller . '</td><td>' . $date . '</td></tr>';
        $i++;
    }
}
                                        ?>
                                    </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success" name="remove">Remove selected</button>
                                </form>
                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->

            </div>

            <!-- end row -->

            <!-- end row -->

        </section>
        <!-- end widget grid -->


    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- Footer Start -->
<?php include 'footer.php'; ?>