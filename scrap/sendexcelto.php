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

        

        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            

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
                            <h2>    select contacts</h2>

                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->
                            <form action="emailexcel.php" method="post" class="smart-form" >


                           
                            <fieldset>
                                <section>
                                    <label class="label">Contacts</label>
                                    <div class="row">
                                        <?php
                                        

                                        $query = "select * from `contacts`";
$rows = sqlfetch($query);
                                        if ($rows != "") {
                                            foreach ($rows as $row) {
                                                echo '<div class="col col-4">
                                            <label class="checkbox state-error"><input type="checkbox" value ="' . $row['email'] . '"name="email[]"><i></i>' . $row['name'] . ' (' . $row['website'] . ')</label>
                                            
                                        </div>';
                                            }
                                        }
                                        ?>
                                        
                                        
                                    </div>
                                    <div class="note note-error">You must select at least one option.</div>
                                </section>
                            </fieldset>
                            <fieldset>
                                
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