<?php include 'header.php'; ?>
<!-- Middle Content Start -->
<?php
$query = "select * from `datas` where website='etsy'";
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
                    etsy
                    <span>>
                        Data
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
                     document.getElementById("emailexcelclient").innerHTML='<a href="sendto.php"><button class="btn btn-success" >Email Client</button> </a>';
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
        document.getElementById("counterexcel").innerHTML = counter;

                                    if (counter < 100)
                                        counter++;
                                }, settme);
                            },
                            success: function (response)
                            {
                                document.getElementById("makeexcel").innerHTML = "";
                                document.getElementById("emailexcelclient").innerHTML = '<a href="sendexcelto.php"><button class="btn btn-success" >Email Client</button> </a>';
                                document.getElementById("downloadexcel").innerHTML = '<a class="btn btn-success" href="report.xls" download>Download excel</button>';
                            }
                        });
                    }



                    function emailclient() {
                        var dataString = {'website': "search"};
                        $.ajax({
                            type: "POST",
                            url: "mail.php",
                            data: dataString,
                            cache: false,
                            beforeSend: function ()
                            {

                            },
                            success: function (response)
                            {

                                alert("email Has been sent to  lawyers");
                            }
                        });

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
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2>Products from etsy</h2>

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

                                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        
                                        <tr>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Image</th>

                                            <th>Band</th>
                                            <th>Date</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $rows = sqlfetch($query);
                                        if ($rows != "") {
                                            foreach ($rows as $row) {

                                                $array = $row;
                                                include 'santo/arraynames.php';


                                                echo '<tr><td>' . $title . '</td><td>' . $link . '</td><td><img src = "' . $image . '" alt = "" width = "100"></td><td>' . str_replace("+", " ", $brand) . '</td><td>' . $date . '</td></tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

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