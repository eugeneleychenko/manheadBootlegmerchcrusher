<?php include 'header.php'; ?>
<!-- Middle Content Start -->
    
<!-- MAIN PANEL -->
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
                    Statistics
                    <span>>
                        
                    </span>
                </h1>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
                <ul id="sparks" class="">
                    
                    
                </ul>
            </div>
        </div>

        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
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
                            <h2>Counters</h2>

                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->
                            <table id="table_fixed_column" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th data-hide="phone">Website</th>
                                        <th data-class="expand">Total products</th>
                                        
                                        <th data-hide="phone">Emails sent</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr><td>Etsy</td><td><?php echo getcount("select * from datas where website='etsy'"); ?></td><td><?php echo getcount("select * from emails where website='etsy'"); ?></td></tr>
                                    <tr><td>redbubble</td><td><?php echo getcount("select * from datas where website='redbubble'"); ?></td><td><?php echo getcount("select * from emails where website='redbubble'"); ?></td></tr>



                                </tbody>
                            </table>

                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                    <!-- Widget ID (each widget will need unique ID)-->
                    
                    <!-- end widget -->

                    <!-- Widget ID (each widget will need unique ID)-->
                    
                    <!-- end widget -->

                    <!-- Widget ID (each widget will need unique ID)-->
                    
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->

            </div>

            <!-- end row -->

            <!-- end row -->

        </section>
        <!-- end widget grid -->

        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
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
                            <h2>Custom list</h2>

                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->
                            <form action="search.php" method="post" class="smart-form" >
                                

                           
                            <fieldset>
                                <section>
                                    <label class="label">Brands</label>
                                    <div class="row">
                                        <?php
                                        
                                        $rows[] = "panic+at+the+disco";
                                        $rows[] = "fall+out+boy";
                                        $rows[] = "30+seconds+to+mars";
if ($rows != "") {
                                            foreach ($rows as $row) {
                                                echo '<div class="col col-4">
                                            <label class="checkbox state-error"><input type="radio" value ="' . $row . '"name="brand[]"><i></i>' . str_replace("+", " ", $row) . '</label>
                                            
                                        </div>';
                                            }
                                        }
                                        ?>
                                        
                                        
                                    </div>
                                    <div class="note note-error">You must select an Band.</div>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <label class="label">Websites</label>
                                    <div class="row">
                                        
                                        
                                        <?php
                                        unset($rows);
                                        $rows[] = "etsy";
                                     
                                        $rows[] = "redbubble";

if ($rows != "") {
                                            foreach ($rows as $row) {
                                                echo '<div class="col col-4">
                                            <label class="checkbox state-error"><input type="radio" value ="' . $row . '" name="website[]"><i></i>' . str_replace("+", " ", $row) . '</label>

                                        </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="note note-error">You must select an option.</div>
                                </section>
                            </fieldset>
                                <footer class="center" >
                                    <button type="submit" class="btn btn-primary " >Go</button>

                            </footer>
                            </form>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                    <!-- Widget ID (each widget will need unique ID)-->

                    <!-- end widget -->

                    <!-- Widget ID (each widget will need unique ID)-->

                    <!-- end widget -->

                    <!-- Widget ID (each widget will need unique ID)-->

                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->

            </div>

            <!-- end row -->

            <!-- end row -->

        </section>
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->






<!-- Footer Start -->
<?php include 'footer.php'; ?>